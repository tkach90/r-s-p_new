<?php /* Smarty version 3.1.27, created on 2017-01-20 18:15:50
         compiled from "/home/geoyar/domains/geo-yar.ru/public_html/manager/templates/default/resource/staticresource/create.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1682725360588229a6b0c1d7_90558832%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c192d7939a736cd5c2aa4896dfdb8e4817beb16e' => 
    array (
      0 => '/home/geoyar/domains/geo-yar.ru/public_html/manager/templates/default/resource/staticresource/create.tpl',
      1 => 1484919905,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1682725360588229a6b0c1d7_90558832',
  'variables' => 
  array (
    'tvOutput' => 0,
    'onDocFormPrerender' => 0,
    'resource' => 0,
    '_config' => 0,
    'onRichTextEditorInit' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_588229a6b1bc37_44294845',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_588229a6b1bc37_44294845')) {
function content_588229a6b1bc37_44294845 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1682725360588229a6b0c1d7_90558832';
?>
<div id="modx-panel-static-div"></div>
<div id="modx-resource-tvs-div" class="modx-resource-tab x-form-label-left x-panel"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['tvOutput']->value)===null||$tmp==='' ? '' : $tmp);?>
</div>

<?php echo $_smarty_tpl->tpl_vars['onDocFormPrerender']->value;?>

<?php if ($_smarty_tpl->tpl_vars['resource']->value->richtext && $_smarty_tpl->tpl_vars['_config']->value['use_editor']) {?>
    <?php echo $_smarty_tpl->tpl_vars['onRichTextEditorInit']->value;?>

<?php }

}
}
?>