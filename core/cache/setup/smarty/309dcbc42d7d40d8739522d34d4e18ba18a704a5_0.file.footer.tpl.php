<?php /* Smarty version 3.1.27, created on 2017-01-20 17:01:51
         compiled from "/home/geoyar/domains/geo-yar.ru/public_html/setup/templates/footer.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:12524022745882184f5f4459_76799484%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '309dcbc42d7d40d8739522d34d4e18ba18a704a5' => 
    array (
      0 => '/home/geoyar/domains/geo-yar.ru/public_html/setup/templates/footer.tpl',
      1 => 1484920005,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12524022745882184f5f4459_76799484',
  'variables' => 
  array (
    '_lang' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5882184f600132_40605608',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5882184f600132_40605608')) {
function content_5882184f600132_40605608 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_replace')) require_once '/home/geoyar/domains/geo-yar.ru/public_html/core/model/smarty/plugins/modifier.replace.php';

$_smarty_tpl->properties['nocache_hash'] = '12524022745882184f5f4459_76799484';
?>
        </div>
        <!-- end content -->
        <div class="clear">&nbsp;</div>
    </div>
</div>

<!-- start footer -->
<div id="footer">
    <div id="footer-inner">
    <div class="container_12">
        <p><?php ob_start();
echo date('Y');
$_tmp1=ob_get_clean();
echo smarty_modifier_replace($_smarty_tpl->tpl_vars['_lang']->value['modx_footer1'],'[[+current_year]]',$_tmp1);?>
</p>
        <p><?php echo $_smarty_tpl->tpl_vars['_lang']->value['modx_footer2'];?>
</p>
    </div>
    </div>
</div>

<div class="post_body">

</div>
<!-- end footer -->
</body>
</html><?php }
}
?>