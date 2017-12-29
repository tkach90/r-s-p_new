<?php /* Smarty version 3.1.27, created on 2017-01-20 17:02:50
         compiled from "/home/geoyar/domains/geo-yar.ru/public_html/manager/templates/default/workspaces/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:4189408635882188a2c1a77_62411004%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6284e78f37a862a53b21b15c67e3c5615bee2c01' => 
    array (
      0 => '/home/geoyar/domains/geo-yar.ru/public_html/manager/templates/default/workspaces/index.tpl',
      1 => 1484919867,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4189408635882188a2c1a77_62411004',
  'variables' => 
  array (
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5882188a2c77e9_18231706',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5882188a2c77e9_18231706')) {
function content_5882188a2c77e9_18231706 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '4189408635882188a2c1a77_62411004';
echo (($tmp = @$_smarty_tpl->tpl_vars['error']->value)===null||$tmp==='' ? '' : $tmp);?>

<div id="modx-panel-workspace-div"></div>
<?php }
}
?>