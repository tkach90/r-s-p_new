<?php /* Smarty version 3.1.27, created on 2017-01-20 17:08:53
         compiled from "/home/geoyar/domains/geo-yar.ru/public_html/manager/templates/default/element/chunk/create.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1096429950588219f5bb4c85_79329346%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd532de8632ca0cd1cd23d0123946a1d2867063d0' => 
    array (
      0 => '/home/geoyar/domains/geo-yar.ru/public_html/manager/templates/default/element/chunk/create.tpl',
      1 => 1484919897,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1096429950588219f5bb4c85_79329346',
  'variables' => 
  array (
    'onChunkFormPrerender' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_588219f5bb6932_27801135',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_588219f5bb6932_27801135')) {
function content_588219f5bb6932_27801135 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1096429950588219f5bb4c85_79329346';
?>
<div id="modx-panel-chunk-div"></div>
<?php echo $_smarty_tpl->tpl_vars['onChunkFormPrerender']->value;

}
}
?>