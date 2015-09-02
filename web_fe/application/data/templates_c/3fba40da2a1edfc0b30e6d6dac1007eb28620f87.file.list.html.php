<?php /* Smarty version Smarty-3.1.8, created on 2014-05-28 17:54:53
         compiled from "application/views\admin\file\list.html" */ ?>
<?php /*%%SmartyHeaderCode:164965385b26d48a4d7-47731288%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3fba40da2a1edfc0b30e6d6dac1007eb28620f87' => 
    array (
      0 => 'application/views\\admin\\file\\list.html',
      1 => 1401162810,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '164965385b26d48a4d7-47731288',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'path' => 0,
    'dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5385b26d668c10_27580094',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5385b26d668c10_27580094')) {function content_5385b26d668c10_27580094($_smarty_tpl) {?><style type="text/css"></style>
<table width="650" height="235" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" colspan="4">位置：<a href="index.php?app=file&act=img_list&up=true&htmlid=<?php echo $_GET['htmlid'];?>
">根目录</a><?php  $_smarty_tpl->tpl_vars['path'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['path']->_loop = false;
 $_smarty_tpl->tpl_vars['dir'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['updir']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['path']->key => $_smarty_tpl->tpl_vars['path']->value){
$_smarty_tpl->tpl_vars['path']->_loop = true;
 $_smarty_tpl->tpl_vars['dir']->value = $_smarty_tpl->tpl_vars['path']->key;
?>/
        <a href="index.php?app=file&act=img_list&up=true&htmlid=<?php echo $_GET['htmlid'];?>
&dir=<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['dir']->value;?>
</a><?php } ?>(数量：<?php echo $_smarty_tpl->tpl_vars['data']->value['total'];?>
)</td>
  </tr>
  <tr style="height:355px;">
    <td colspan="4" align="left" valign="top" id="list">
    </td>
  </tr>
  <tr>
    <td colspan="4" align="right" valign="top"><div id="pagelist" style="overflow:hidden"></div>&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
<script type="text/javascript">
var list = <?php echo $_smarty_tpl->tpl_vars['data']->value['list'];?>
;
var total = <?php echo $_smarty_tpl->tpl_vars['data']->value['total'];?>
;
var path = '<?php echo $_smarty_tpl->tpl_vars['data']->value['path'];?>
';
var dpage = 1;
function page(page, pagesize){
	page = page<1?1:page;
	dpage = page;
	var str = '';
	var offset = (page-1)*pagesize;
	var end = page*pagesize>total?total:page*pagesize;
	for(var i = offset; i<end; i++){
		if(!list[i]['is_dir']){
			str += "<div style=\"width:160px; height:135px; float:left;cursor:pointer\"><img src=\"/public/image/"+path+"/"+list[i]['filename']+"\" title=\""+list[i]['filename']+"("+Math.ceil(list[i]['filesize']/1024)+"KB , "+list[i]['datetime']+")\" style=\"max-width:150px; max-height:112.5px;\" onClick=\"_img_select('"+list[i]['filename']+"')\" /><br><div style='width:140px;overflow:hidden' title='"+list[i]['filename']+"'>"+list[i]['filename']+"</div></div>";
		}else{
			str += "<div style=\"width:160px; height:115px; float:left;cursor:pointer\"><img src=\"/public/admin/images/dir.gif\" title=\"文件夹："+list[i]['filename']+"\" style=\"max-width:150px; max-height:112.5px;\" onClick=\"javascript:location.href='index.php?app=file&act=img_list&up=true&htmlid=<?php echo $_GET['htmlid'];?>
&dir=<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
<?php if ($_smarty_tpl->tpl_vars['path']->value){?>/<?php }?>"+list[i]['filename']+"'\" /><br><div style='width:140px;overflow:hidden' title='"+list[i]['filename']+"'>"+list[i]['filename']+"</div></div>";//dir.gif
		}
	}
	document.getElementById('list').innerHTML = str;
	pagelist(12);
}

function _img_select(file){
	window.opener.document.getElementById('<?php echo $_GET['htmlid'];?>
').value = 'image/'+path+'/'+file;
	window.close();
}

function pagelist(pagesize){
	//首页，尾页，上一页，下一页
	var pagetotal = Math.ceil(total/pagesize);
	var pagestr = '<a href="javascript:void(0);" onClick="page(1,12)">首页</a> ';
	pagestr += '<a href="javascript:void(0);" onClick="page('+(dpage-1)+', 12)">上一页</a> ';
	pagestr += '<a href="javascript:void(0);" onClick="page('+(dpage+1)+', 12)">下一页</a> ';
	pagestr += '<a href="javascript:void(0);" onClick="page('+pagetotal+', 12)">尾页</a>';
	document.getElementById('pagelist').innerHTML = pagestr;
}

page(1, 12);
pagelist(12);
</script>
<?php }} ?>