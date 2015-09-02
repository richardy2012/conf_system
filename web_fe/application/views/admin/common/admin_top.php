<html>
<head>
    <title>后台管理页面</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/public/admin/images/skin.css" rel="stylesheet" type="text/css">
    <style>
        .field { border:solid 1px #d3cfc7; background:#fff; padding:2px; }
        .field { -moz-border-radius:4px; -webkit-border-radius:4px; }
        a.langBtn{width:66px;height:20px;line-height:18px;color:#B8D3EB;font-weight:bold;text-align:center;display:inline-block;background:url('/public/admin/images/lang_bg.gif')}
    	.loginout{position:relative;top:7px}
    </style>
    <script type="text/javascript" src="/public/js/jquery-1.8.2.js"></script>
    <script type="text/javascript" src="/public/js/public.js"></script>
</head>
<body leftmargin="0" topmargin="0">
<table width="100%" height="90" border="0" cellpadding="0" cellspacing="0" class="admin_topbg">
    <tr>
        <td width="1%" height="90">
        <td width="39%" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td height="68" class="admin_txt">
                        <?php echo $lang['Administrator']?>：<b><?php echo isset($userInfo['user_name']) ? $userInfo['user_name'] : 'admin' ?>
                        </b>  &nbsp;<?php echo $lang['welcome']?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                    <td width="120px">
                    	<a class="langBtn black" data="Vietnamese" href="javascript:;">越南版</a>
                    	<script>
                    		var lang = '<?php echo LANG;?>';
                            if( lang == 'English' ){
                            	$('.langBtn').attr('data', 'Chinese');
                            	$('.langBtn').text('<?php echo $lang['Chinese']?>');
                            }else{                	
                            	$('.langBtn').attr('data', 'English');
                            	$('.langBtn').text('<?php echo $lang['English']?>');
                            }           				
                    	</script>
                        <a class="loginout" href="index.php?app=welcome&act=loginout" target="_parent">
                            <img src="/public/admin/images/out.gif" alt="安全退出" width="46" height="20" border="0"></a>
                    </td>
                    <td width="30px">&nbsp;</td>
                </tr>
                <tr>
                    <td height="19" colspan="3">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
