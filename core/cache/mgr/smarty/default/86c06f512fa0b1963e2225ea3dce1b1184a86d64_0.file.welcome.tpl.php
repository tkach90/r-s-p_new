<?php /* Smarty version 3.1.27, created on 2017-01-23 12:17:58
         compiled from "/home/geoyar/domains/geo-yar.ru/public_html/manager/templates/default/welcome.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:5892704615885ca4672e4e4_84799045%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '86c06f512fa0b1963e2225ea3dce1b1184a86d64' => 
    array (
      0 => '/home/geoyar/domains/geo-yar.ru/public_html/manager/templates/default/welcome.tpl',
      1 => 1485159866,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5892704615885ca4672e4e4_84799045',
  'variables' => 
  array (
    'dashboard' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5885ca46731377_61866055',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5885ca46731377_61866055')) {
function content_5885ca46731377_61866055 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '5892704615885ca4672e4e4_84799045';
?>
<div id="modx-panel-welcome-div"></div>

<div id="modx-dashboard" class="dashboard">
<?php echo $_smarty_tpl->tpl_vars['dashboard']->value;?>

</div><?php }
}
?>