<?php  return array (
  'resourceClass' => 'modDocument',
  'resource' => 
  array (
    'id' => 6,
    'type' => 'document',
    'contentType' => 'text/xml',
    'pagetitle' => 'sitemap',
    'longtitle' => '',
    'description' => '',
    'alias' => 'sitemap',
    'link_attributes' => '',
    'published' => 1,
    'pub_date' => 0,
    'unpub_date' => 0,
    'parent' => 0,
    'isfolder' => 0,
    'introtext' => '',
    'content' => '[[!GoogleSiteMap? <span>&excludeResources=`1,5`</span>]]',
    'richtext' => 1,
    'template' => 0,
    'menuindex' => 5,
    'searchable' => 1,
    'cacheable' => 1,
    'createdby' => 1,
    'createdon' => 1484925511,
    'editedby' => 1,
    'editedon' => 1485173045,
    'deleted' => 0,
    'deletedon' => 0,
    'deletedby' => 0,
    'publishedon' => 1484925480,
    'publishedby' => 1,
    'menutitle' => '',
    'donthit' => 0,
    'privateweb' => 0,
    'privatemgr' => 0,
    'content_dispo' => 0,
    'hidemenu' => 0,
    'class_key' => 'modDocument',
    'context_key' => 'web',
    'content_type' => 2,
    'uri' => 'sitemap.xml',
    'uri_override' => 0,
    'hide_children_in_tree' => 0,
    'show_in_tree' => 1,
    'properties' => NULL,
    '_content' => '[[!GoogleSiteMap? <span>&excludeResources=`1,5`</span>]]',
    '_isForward' => false,
  ),
  'contentType' => 
  array (
    'id' => 2,
    'name' => 'XML',
    'description' => 'XML content',
    'mime_type' => 'text/xml',
    'file_extensions' => '.xml',
    'headers' => NULL,
    'binary' => 0,
  ),
  'policyCache' => 
  array (
  ),
  'sourceCache' => 
  array (
    'modChunk' => 
    array (
    ),
    'modSnippet' => 
    array (
      'GoogleSiteMap' => 
      array (
        'fields' => 
        array (
          'id' => 2,
          'source' => 0,
          'property_preprocess' => false,
          'name' => 'GoogleSiteMap',
          'description' => 'New GoogleSiteMap Snippet—many times faster than Version 1, but with less options. If params are specified that depend on the old version, it will be called.',
          'editor_type' => 0,
          'category' => 1,
          'cache_type' => 0,
          'snippet' => '/**
 * GoogleSiteMap
 *
 * Builds the Google SiteMap XML. 
 * Version 2+ of GoogleSiteMap uses code by Garry Nutting of the MODX Core Team to deliver sitemaps blazingly fast.
 *
 * @author YJ Tso <yj@modx.com>, Garry Nutting <garry@modx.com>
 *
 *
 * GoogleSiteMap is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * GoogleSiteMap is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * GoogleSiteMap; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package googlesitemap
 */

// "300 lives of men I\'ve walked this earth and now I have no time"
ini_set(\'max_execution_time\', 0);

// Set cache options
// set $cacheKey prefix to be appended later
$cacheKey = $modx->getoption(\'cachePrefix\', $scriptProperties, \'googlesitemap\');
// subfolder of core/cache/
$cachePartition = $modx->getoption(\'cachePartition\', $scriptProperties, \'googlesitemap\');
$expires = $modx->getOption(\'cacheExpires\', $scriptProperties, 86400);
$options = array(
  xPDO::OPT_CACHE_KEY => $cachePartition,
);

// Set context(s)
$context = array_filter(array_map(\'trim\', explode(\',\', $modx->getOption(\'context\', $scriptProperties, $modx->context->get(\'key\'), true))));
$cacheKey .= \'.\' . md5($modx->toJSON($scriptProperties));

// Fetch from cache
$output = null;
$output = $modx->cacheManager->get($cacheKey, $options);
if ($output !== null) return $output;

/* Legacy Snippet handling */
$legacyProps = $modx->getOption(\'legacyProps\', $scriptProperties, \'allowedtemplates, excludeResources, excludeChildrenOf, sortByAlias, templateFilter, itemTpl, maxDepth, startId, where\');
$legacyProps = array_flip(array_filter(array_map(\'trim\', explode(\',\', $legacyProps))));
$legacyProps = array_intersect_key($scriptProperties, $legacyProps);
$legacySnippet = $modx->getOption(\'legacySnippet\', $scriptProperties, \'GoogleSiteMapVersion1\');

if (!empty($legacyProps) && $modx->getCount(\'modSnippet\', array(\'name\' => $legacySnippet))) {
    
    $output = $modx->runSnippet($legacySnippet, $scriptProperties);
    if ($output !== null) {
        $modx->cacheManager->set($cacheKey, $output, $expires, $options);
        return $output;
    }
    
}

/* Begin new Snippet scope */
$googleSchema = $modx->getOption(\'googleSchema\',$scriptProperties,\'http://www.sitemaps.org/schemas/sitemap/0.9\');

/* Map specified filter properties to new variables for convenience */
$filters = array();
if ($modx->getOption(\'hideDeleted\', $scriptProperties, true)) $filters[] =  \'s.deleted = 0\';
if (!$modx->getOption(\'showHidden\', $scriptProperties, false)) $filters[] = \'s.hidemenu = 0\';
if ($modx->getOption(\'published\', $scriptProperties, true)) $filters[] = \'s.published = 1\';
if ($modx->getOption(\'searchable\', $scriptProperties, true)) $filters[] = \'s.searchable = 1\';

/* Defaults from legacy snippet */
$sortBy = $modx->getOption(\'sortBy\', $scriptProperties, \'menuindex\');
$sortDir = $modx->getOption(\'sortDir\', $scriptProperties, \'ASC\');
$orderby = \'s.\' . strtolower($sortBy) . \' \' . strtoupper($sortDir);

$containerTpl = $modx->getOption(\'containerTpl\', $scriptProperties, \'gContainer\');
$priorityTV = $modx->getOption(\'priorityTV\', $scriptProperties, \'\');

/* Fetch TV ID if string provided */
if (!is_numeric($priorityTV)) {
    
    $c = $modx->newQuery(\'modTemplateVar\');
    $c->select(\'id\');
    $c->where(array(\'name\' => $priorityTV));
    $priorityTV = $modx->getValue($c->prepare());
    
}

/* Query by Context and set site_url / site_start */
$items = \'\';
// Set today\'s date for homepage lastmod
$today = date(\'Y-m-d\');
foreach ($context as $ctx) {
    
    $siteUrl = \'\';
    // Fetch current context object for site_url
    $currentCtx = $modx->getContext($ctx);
    if ($currentCtx) {
        $siteUrl = $currentCtx->getOption(\'site_url\');
        // Add site_url to output
        $items .= "<url><loc>{$siteUrl}</loc><lastmod>{$today}</lastmod></url>" . PHP_EOL;
    } 
    if (empty($siteUrl)) {
        // We need something to build the links with, even if no context setting
        $siteUrl = $modx->getOption(\'site_url\', null, MODX_SITE_URL);
    }
    
    $tablePrefix = $modx->getOption(\'table_prefix\');
    
    $filters[] = "s.context_key = \'{$ctx}\'";
    $criteria = implode(\' AND \', $filters);
    $tvQuery = \'\';
    if ($priorityTV) $tvQuery = "IFNULL(
        CONCAT(\'<priority>\',(
            SELECT value
            FROM " . $tablePrefix . "site_tmplvar_contentvalues
            USE INDEX (tv_cnt)
            WHERE contentid = s.id AND tmplvarid = " . $priorityTV . "
        ),\'</priority>\'),\'\'),";
        
    // Add all resources that meet criteria
    $stmt = $modx->query("
        SELECT
    	    GROUP_CONCAT(
                \'<url>\',        
                CONCAT(\'<loc>" . $siteUrl . "\',uri,\'</loc>\'),
                CONCAT(\'<lastmod>\',CASE editedon WHEN 0 THEN FROM_UNIXTIME(publishedon, \'%Y-%m-%d\') ELSE FROM_UNIXTIME(editedon, \'%Y-%m-%d\') END,\'</lastmod>\'),
                " . $tvQuery . "
                \'</url>\'
                SEPARATOR \'\'
            ) AS node
        FROM " . $tablePrefix . "site_content AS s
        WHERE " . $criteria . "
        GROUP BY s.id
        ORDER BY " . $orderby . "
    ");

    // Add to output
    if ($stmt) {
        $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $items .= implode(PHP_EOL, $rows);
    }
    
}

/* get container tpl and content */
$output = $modx->getChunk($containerTpl, array(
    \'schema\' => $googleSchema,
    \'items\' => $items,
));

if ($output !== null) {
    $modx->cacheManager->set($cacheKey, $output, $expires, $options);
    return $output;
} else {
    $modx->log(modX::LOG_LEVEL_WARN, \'GoogleSiteMap could not generate nor fetch a sitemap.\');
}',
          'locked' => false,
          'properties' => 
          array (
            'cachePrefix' => 
            array (
              'name' => 'cachePrefix',
              'desc' => 'prop_gsm.cacheprefix_desc',
              'type' => 'textfield',
              'options' => '',
              'value' => 'googlesitemap',
              'lexicon' => 'googlesitemap:properties',
              'area' => '',
              'desc_trans' => 'Optional. Default: "googlesitemap". Prefix for cache file(s).',
              'area_trans' => '',
            ),
            'cachePartition' => 
            array (
              'name' => 'cachePartition',
              'desc' => 'prop_gsm.cachepartition_desc',
              'type' => 'textfield',
              'options' => '',
              'value' => 'googlesitemap',
              'lexicon' => 'googlesitemap:properties',
              'area' => '',
              'desc_trans' => 'Optional. Default: "googlesitemap". Folder under core/cache/ for cache file(s).',
              'area_trans' => '',
            ),
            'cacheExpires' => 
            array (
              'name' => 'cacheExpires',
              'desc' => 'prop_gsm.cacheexpires_desc',
              'type' => 'textfield',
              'options' => '',
              'value' => '86400',
              'lexicon' => 'googlesitemap:properties',
              'area' => '',
              'desc_trans' => 'Optional. Default: 86400. Time to expire cache. Default is 1 day.',
              'area_trans' => '',
            ),
            'context' => 
            array (
              'name' => 'context',
              'desc' => 'prop_gsm.context_desc',
              'type' => 'textfield',
              'options' => '',
              'value' => '',
              'lexicon' => 'googlesitemap:properties',
              'area' => '',
              'desc_trans' => 'Limit to the specified Context(s). If empty, will grab Resources from current Context. Defaults to empty, can support a comma-separated list.',
              'area_trans' => '',
            ),
            'hideDeleted' => 
            array (
              'name' => 'hideDeleted',
              'desc' => 'prop_gsm.hidedeleted_desc',
              'type' => 'combo-boolean',
              'options' => '',
              'value' => true,
              'lexicon' => 'googlesitemap:properties',
              'area' => '',
              'desc_trans' => 'If true, will show only nondeleted Resources.',
              'area_trans' => '',
            ),
            'showHidden' => 
            array (
              'name' => 'showHidden',
              'desc' => 'prop_gsm.showhidden_desc',
              'type' => 'combo-boolean',
              'options' => '',
              'value' => false,
              'lexicon' => 'googlesitemap:properties',
              'area' => '',
              'desc_trans' => 'If true, will show Resources hidden from menus.',
              'area_trans' => '',
            ),
            'googleSchema' => 
            array (
              'name' => 'googleSchema',
              'desc' => 'prop_gsm.googleschema_desc',
              'type' => 'textfield',
              'options' => '',
              'value' => 'http://www.sitemaps.org/schemas/sitemap/0.9',
              'lexicon' => 'googlesitemap:properties',
              'area' => '',
              'desc_trans' => 'The location of the GoogleSiteMap schema.',
              'area_trans' => '',
            ),
            'published' => 
            array (
              'name' => 'published',
              'desc' => 'prop_gsm.published_desc',
              'type' => 'combo-boolean',
              'options' => '',
              'value' => true,
              'lexicon' => 'googlesitemap:properties',
              'area' => '',
              'desc_trans' => 'If true, will only show published resources.',
              'area_trans' => '',
            ),
            'searchable' => 
            array (
              'name' => 'searchable',
              'desc' => 'prop_gsm.searchable_desc',
              'type' => 'combo-boolean',
              'options' => '',
              'value' => true,
              'lexicon' => 'googlesitemap:properties',
              'area' => '',
              'desc_trans' => 'If true, will only show searchable resources.',
              'area_trans' => '',
            ),
            'sortBy' => 
            array (
              'name' => 'sortBy',
              'desc' => 'prop_gsm.sortby_desc',
              'type' => 'textfield',
              'options' => '',
              'value' => 'menuindex',
              'lexicon' => 'googlesitemap:properties',
              'area' => '',
              'desc_trans' => 'The field to sort the results by.',
              'area_trans' => '',
            ),
            'sortDir' => 
            array (
              'name' => 'sortDir',
              'desc' => 'prop_gsm.sortdir_desc',
              'type' => 'textfield',
              'options' => '',
              'value' => 'ASC',
              'lexicon' => 'googlesitemap:properties',
              'area' => '',
              'desc_trans' => 'The direction to sort in.',
              'area_trans' => '',
            ),
            'containerTpl' => 
            array (
              'name' => 'containerTpl',
              'desc' => 'prop_gsm.containertpl_desc',
              'type' => 'textfield',
              'options' => '',
              'value' => 'gContainer',
              'lexicon' => 'googlesitemap:properties',
              'area' => '',
              'desc_trans' => 'The Chunk to use for the output container.',
              'area_trans' => '',
            ),
            'priorityTV' => 
            array (
              'name' => 'priorityTV',
              'desc' => 'prop_gsm.prioritytv_desc',
              'type' => 'textfield',
              'options' => '',
              'value' => '',
              'lexicon' => 'googlesitemap:properties',
              'area' => '',
              'desc_trans' => 'Optional. The name or ID of a TV to use to override the priority for a page.',
              'area_trans' => '',
            ),
            'legacyProps' => 
            array (
              'name' => 'legacyProps',
              'desc' => 'prop_gsm.legacyprops_desc',
              'type' => 'textfield',
              'options' => '',
              'value' => 'allowedtemplates, excludeResources, excludeChildrenOf, sortByAlias, templateFilter, itemTpl, maxDepth, startId, where',
              'lexicon' => 'googlesitemap:properties',
              'area' => '',
              'desc_trans' => 'Only modify this if you really know what you are doing. Properties in this list will trigger the execution of the legacy GoogleSiteMap Snippet.',
              'area_trans' => '',
            ),
            'legacySnippet' => 
            array (
              'name' => 'legacySnippet',
              'desc' => 'prop_gsm.legacysnippet_desc',
              'type' => 'textfield',
              'options' => '',
              'value' => 'GoogleSiteMapVersion1',
              'lexicon' => 'googlesitemap:properties',
              'area' => '',
              'desc_trans' => 'Only modify this if you really know what you are doing. This snippet will be called if a legacy property is passed to the call to GoogleSiteMap',
              'area_trans' => '',
            ),
          ),
          'moduleguid' => '',
          'static' => false,
          'static_file' => '',
          'content' => '/**
 * GoogleSiteMap
 *
 * Builds the Google SiteMap XML. 
 * Version 2+ of GoogleSiteMap uses code by Garry Nutting of the MODX Core Team to deliver sitemaps blazingly fast.
 *
 * @author YJ Tso <yj@modx.com>, Garry Nutting <garry@modx.com>
 *
 *
 * GoogleSiteMap is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * GoogleSiteMap is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * GoogleSiteMap; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package googlesitemap
 */

// "300 lives of men I\'ve walked this earth and now I have no time"
ini_set(\'max_execution_time\', 0);

// Set cache options
// set $cacheKey prefix to be appended later
$cacheKey = $modx->getoption(\'cachePrefix\', $scriptProperties, \'googlesitemap\');
// subfolder of core/cache/
$cachePartition = $modx->getoption(\'cachePartition\', $scriptProperties, \'googlesitemap\');
$expires = $modx->getOption(\'cacheExpires\', $scriptProperties, 86400);
$options = array(
  xPDO::OPT_CACHE_KEY => $cachePartition,
);

// Set context(s)
$context = array_filter(array_map(\'trim\', explode(\',\', $modx->getOption(\'context\', $scriptProperties, $modx->context->get(\'key\'), true))));
$cacheKey .= \'.\' . md5($modx->toJSON($scriptProperties));

// Fetch from cache
$output = null;
$output = $modx->cacheManager->get($cacheKey, $options);
if ($output !== null) return $output;

/* Legacy Snippet handling */
$legacyProps = $modx->getOption(\'legacyProps\', $scriptProperties, \'allowedtemplates, excludeResources, excludeChildrenOf, sortByAlias, templateFilter, itemTpl, maxDepth, startId, where\');
$legacyProps = array_flip(array_filter(array_map(\'trim\', explode(\',\', $legacyProps))));
$legacyProps = array_intersect_key($scriptProperties, $legacyProps);
$legacySnippet = $modx->getOption(\'legacySnippet\', $scriptProperties, \'GoogleSiteMapVersion1\');

if (!empty($legacyProps) && $modx->getCount(\'modSnippet\', array(\'name\' => $legacySnippet))) {
    
    $output = $modx->runSnippet($legacySnippet, $scriptProperties);
    if ($output !== null) {
        $modx->cacheManager->set($cacheKey, $output, $expires, $options);
        return $output;
    }
    
}

/* Begin new Snippet scope */
$googleSchema = $modx->getOption(\'googleSchema\',$scriptProperties,\'http://www.sitemaps.org/schemas/sitemap/0.9\');

/* Map specified filter properties to new variables for convenience */
$filters = array();
if ($modx->getOption(\'hideDeleted\', $scriptProperties, true)) $filters[] =  \'s.deleted = 0\';
if (!$modx->getOption(\'showHidden\', $scriptProperties, false)) $filters[] = \'s.hidemenu = 0\';
if ($modx->getOption(\'published\', $scriptProperties, true)) $filters[] = \'s.published = 1\';
if ($modx->getOption(\'searchable\', $scriptProperties, true)) $filters[] = \'s.searchable = 1\';

/* Defaults from legacy snippet */
$sortBy = $modx->getOption(\'sortBy\', $scriptProperties, \'menuindex\');
$sortDir = $modx->getOption(\'sortDir\', $scriptProperties, \'ASC\');
$orderby = \'s.\' . strtolower($sortBy) . \' \' . strtoupper($sortDir);

$containerTpl = $modx->getOption(\'containerTpl\', $scriptProperties, \'gContainer\');
$priorityTV = $modx->getOption(\'priorityTV\', $scriptProperties, \'\');

/* Fetch TV ID if string provided */
if (!is_numeric($priorityTV)) {
    
    $c = $modx->newQuery(\'modTemplateVar\');
    $c->select(\'id\');
    $c->where(array(\'name\' => $priorityTV));
    $priorityTV = $modx->getValue($c->prepare());
    
}

/* Query by Context and set site_url / site_start */
$items = \'\';
// Set today\'s date for homepage lastmod
$today = date(\'Y-m-d\');
foreach ($context as $ctx) {
    
    $siteUrl = \'\';
    // Fetch current context object for site_url
    $currentCtx = $modx->getContext($ctx);
    if ($currentCtx) {
        $siteUrl = $currentCtx->getOption(\'site_url\');
        // Add site_url to output
        $items .= "<url><loc>{$siteUrl}</loc><lastmod>{$today}</lastmod></url>" . PHP_EOL;
    } 
    if (empty($siteUrl)) {
        // We need something to build the links with, even if no context setting
        $siteUrl = $modx->getOption(\'site_url\', null, MODX_SITE_URL);
    }
    
    $tablePrefix = $modx->getOption(\'table_prefix\');
    
    $filters[] = "s.context_key = \'{$ctx}\'";
    $criteria = implode(\' AND \', $filters);
    $tvQuery = \'\';
    if ($priorityTV) $tvQuery = "IFNULL(
        CONCAT(\'<priority>\',(
            SELECT value
            FROM " . $tablePrefix . "site_tmplvar_contentvalues
            USE INDEX (tv_cnt)
            WHERE contentid = s.id AND tmplvarid = " . $priorityTV . "
        ),\'</priority>\'),\'\'),";
        
    // Add all resources that meet criteria
    $stmt = $modx->query("
        SELECT
    	    GROUP_CONCAT(
                \'<url>\',        
                CONCAT(\'<loc>" . $siteUrl . "\',uri,\'</loc>\'),
                CONCAT(\'<lastmod>\',CASE editedon WHEN 0 THEN FROM_UNIXTIME(publishedon, \'%Y-%m-%d\') ELSE FROM_UNIXTIME(editedon, \'%Y-%m-%d\') END,\'</lastmod>\'),
                " . $tvQuery . "
                \'</url>\'
                SEPARATOR \'\'
            ) AS node
        FROM " . $tablePrefix . "site_content AS s
        WHERE " . $criteria . "
        GROUP BY s.id
        ORDER BY " . $orderby . "
    ");

    // Add to output
    if ($stmt) {
        $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $items .= implode(PHP_EOL, $rows);
    }
    
}

/* get container tpl and content */
$output = $modx->getChunk($containerTpl, array(
    \'schema\' => $googleSchema,
    \'items\' => $items,
));

if ($output !== null) {
    $modx->cacheManager->set($cacheKey, $output, $expires, $options);
    return $output;
} else {
    $modx->log(modX::LOG_LEVEL_WARN, \'GoogleSiteMap could not generate nor fetch a sitemap.\');
}',
        ),
        'policies' => 
        array (
          'web' => 
          array (
          ),
        ),
        'source' => 
        array (
        ),
      ),
    ),
    'modTemplateVar' => 
    array (
    ),
  ),
);