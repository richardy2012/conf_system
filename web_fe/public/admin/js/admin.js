function admin_open_url(url, top, left, width, height){
	if(!top) top=200;
	if(!left) left=200;
	if(!width) width=650;
	if(!height) height=450;
    console.log()
	window.open(url,'datetime',"Scrollbars=no,Toolbar=no,Location=no,Direction=no,Resizeable=no,width="+width+" ,height="+height+",top="+top+",left="+left);
}

function map(){
	var x = $('#map_x').val();
	var y = $('#map_y').val();
	var city = $('#city').find('option:selected').text();
	if(city == '' || city == '请选择所在城市'){
		alert('请先选择城市');
		$('#city').focus();
		return false;
	}
	
	admin_open_url('index.php?app=scenic&act=map&x='+x+'&y='+y+'&city='+city, 200, 200, 700, 500);
}
