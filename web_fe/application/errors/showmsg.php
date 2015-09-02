<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>提示信息</title>
<style type="text/css">
body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}
a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}
h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 18px;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}
#container {
	font-family:microsoft yahei;
	margin: 160px auto;
	border: 1px solid #D0D0D0;
	width:500px;
	padding:5px;
}
p {
	margin:15px
}
.back {
	text-align:right;
	font-size:16px;
}
.back a {
	text-decoration:none;
	color:#aaa
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if(!empty($link)){?>
<meta http-equiv="refresh" content="<?php echo $second;?>;URL=<?php echo $link[0]['link_url'];?>" />
<?php }?>
</head>
<body>
<div id="container">
  <h1>提示信息：</h1>
  <p style="margin-left:25px; font-size:14px"><?php echo $msg;?></p>
  <p style="margin-left:25px; font-size:14px">
    <?php 
	if(!empty($link)){ 
		foreach($link as $key=>$val){
	?>
    <a href="<?php echo $val['link_url'];?>"> <?php echo $val['link_name'];?></a> &nbsp;
    <?php }}else{?>
    <a href="javascript:void(0);" onClick="history.back(-1);">返回上一页</a>
   <?php }?>
  </p>
</div>
<script type="text/javascript">
var second = <?php  echo $second;?>;
function second_url(){
	if(second < 1){
		<?php if(empty($link)){ echo "history.back(-1);";}?>
	}
	second--;
}
setTimeout('second_url()', 5000);
</script>
</body>
</html>
