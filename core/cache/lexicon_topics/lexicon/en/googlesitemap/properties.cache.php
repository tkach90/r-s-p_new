<?php  return array (
  'prop_gsm.allowedtemplates_desc' => 'A comma-separated list of Template IDs to filter by. Will only filter if a value is set.',
  'prop_gsm.context_desc' => 'Limit to the specified Context(s). If empty, will grab Resources from current Context. Defaults to empty, can support a comma-separated list.',
  'prop_gsm.maxdepth_desc' => 'The depth down the tree to grab Resources. If set to empty or 0, will grab all depths.',
  'prop_gsm.excluderesources_desc' => 'Optional. A comma-separated list of Resources to skip.',
  'prop_gsm.excludechildrenof_desc' => 'Optional. A comma-separated list of Resources whose children to skip.',
  'prop_gsm.hidedeleted_desc' => 'If true, will show only nondeleted Resources.',
  'prop_gsm.showhidden_desc' => 'If true, will show Resources hidden from menus.',
  'prop_gsm.googleschema_desc' => 'The location of the GoogleSiteMap schema.',
  'prop_gsm.published_desc' => 'If true, will only show published resources.',
  'prop_gsm.searchable_desc' => 'If true, will only show searchable resources.',
  'prop_gsm.sortby_desc' => 'The field to sort the results by.',
  'prop_gsm.sortbyalias_desc' => 'The class to use as the alias for the sortBy property.',
  'prop_gsm.sortdir_desc' => 'The direction to sort in.',
  'prop_gsm.startid_desc' => 'Optional. The ID of a Resource to start the sitemap from. 0 will do the entire site.',
  'prop_gsm.templatefilter_desc' => 'The modTemplate column to filter by.',
  'prop_gsm.itemtpl_desc' => 'The Chunk to use for each result item.',
  'prop_gsm.containertpl_desc' => 'The Chunk to use for the output container.',
  'prop_gsm.where_desc' => 'Optional. A JSON object of parameters to pass into the where statement.',
  'prop_gsm.prioritytv_desc' => 'Optional. The name or ID of a TV to use to override the priority for a page.',
  'prop_gsm.cacheprefix_desc' => 'Optional. Default: "googlesitemap". Prefix for cache file(s).',
  'prop_gsm.cachepartition_desc' => 'Optional. Default: "googlesitemap". Folder under core/cache/ for cache file(s).',
  'prop_gsm.cacheexpires_desc' => 'Optional. Default: 86400. Time to expire cache. Default is 1 day.',
  'prop_gsm.legacyprops_desc' => 'Only modify this if you really know what you are doing. Properties in this list will trigger the execution of the legacy GoogleSiteMap Snippet.',
  'prop_gsm.legacysnippet_desc' => 'Only modify this if you really know what you are doing. This snippet will be called if a legacy property is passed to the call to GoogleSiteMap',
);