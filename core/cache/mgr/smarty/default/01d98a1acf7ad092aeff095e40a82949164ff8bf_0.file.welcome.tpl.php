<?php /* Smarty version 3.1.27, created on 2017-01-20 17:02:26
         compiled from "/home/geoyar/domains/geo-yar.ru/public_html/manager/templates/default/welcome.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:8130310758821872a06881_46269685%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '01d98a1acf7ad092aeff095e40a82949164ff8bf' => 
    array (
      0 => '/home/geoyar/domains/geo-yar.ru/public_html/manager/templates/default/welcome.tpl',
      1 => 1484919848,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8130310758821872a06881_46269685',
  'variables' => 
  array (
    'dashboard' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_58821872a08ad5_07519143',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_58821872a08ad5_07519143')) {
function content_58821872a08ad5_07519143 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '8130310758821872a06881_46269685';
?>
<div id="modx-panel-welcome-div"></div>

<div id="modx-dashboard" class="dashboard">
<?php echo $_smarty_tpl->tpl_vars['dashboard']->value;?>

</div><?php }
}
?>