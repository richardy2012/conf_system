<html>
<head>
<title>魂斗三国管理中心</title>
<meta http-equiv=Content-Type content=text/html;charset=utf-8>
</head>
<frameset rows="84,*"  frameborder="NO" border="0" framespacing="0">
	<frame src="index.php?app=welcome&act=header" noresize="noresize" frameborder="NO" name="topFrame" scrolling="no" marginwidth="0" marginheight="0" target="main" />
  <frameset cols="200,*"  rows="960,*" id="frame">
	<frame src="index.php?app=welcome&act=left" name="leftFrame" noresize="noresize" marginwidth="0" marginheight="0" frameborder="0" scrolling="no" target="main" />
<!--      <frame src="index.php?app=platform&act=addPlatform" name="main" marginwidth="0" marginheight="0" frameborder="0" scrolling="auto" target="_self" />-->
	<frame src="<?php echo isset($refreshLink['link']) && $refreshLink['link'] ? $refreshLink['link'] : 'index.php?app=welcome&act=right';?>" id="mainright" name="main" marginwidth="0" marginheight="0" frameborder="0" scrolling="auto" target="_self" />
  </frameset>
<noframes>
  <body>
  </body>
    </noframes>
</html>
