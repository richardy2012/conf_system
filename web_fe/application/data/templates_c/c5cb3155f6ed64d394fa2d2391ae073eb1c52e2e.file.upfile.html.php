<?php /* Smarty version Smarty-3.1.8, created on 2015-01-31 15:55:26
         compiled from "application/views\admin\file\upfile.html" */ ?>
<?php /*%%SmartyHeaderCode:104135385d70ab0a440-17802739%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c5cb3155f6ed64d394fa2d2391ae073eb1c52e2e' => 
    array (
      0 => 'application/views\\admin\\file\\upfile.html',
      1 => 1419926111,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104135385d70ab0a440-17802739',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5385d70abb01e0_23679700',
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5385d70abb01e0_23679700')) {function content_5385d70abb01e0_23679700($_smarty_tpl) {?><form action="<?php echo $_smarty_tpl->tpl_vars['data']->value['form_url'];?>
" method="POST" enctype="multipart/form-data">
  <table width="400" border="0" cellpadding="0" cellspacing="1">
    <tr>
      <td colspan="3" align="center"><?php echo $_smarty_tpl->tpl_vars['data']->value['upload_avatar'];?>
</td>
    </tr>
    <tr>
      <td align="right"><?php echo $_smarty_tpl->tpl_vars['data']->value['file'];?>
：</td>
      <td colspan="2">
      <input type="file" name="fileField" id="fileField" /></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input type="submit" name="submit" id="submit" value="上传" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form><?php }} ?>