$(function(){
    /* 全选 */
    $('.checkall').click(function(){
        var _self = this;
        $('.checkitem').each(function(){
            if (!this.disabled)
            {
                $(this).attr('checked', _self.checked);
            }
        });
        $('.checkall').attr('checked', this.checked);
    });
	
	/* syl 加 */
    $('.checkitem').click(function() {

        if ($('.checkitem').length == $('.checkitem:checked').length) {
            $('.checkall').attr("checked", "checked");
        } else {
            $('.checkall').removeAttr("checked");
        }
    });

    /* 批量操作按钮 */
    if($('#batchAction').length == 1){
        $('.batchButton').click(function(){
										 
            /* 是否有选择 */
            if($('.checkitem:checked').length == 0){    //没有选择
                alert("请在需要操作的项前打钩");
                return false;
            }
            /* 运行presubmit */
            if($(this).attr('presubmit')){
                if(!eval($(this).attr('presubmit'))){
                    return false;
                }
            }
            /* 获取选中的项 */
            var items = '';
            $('.checkitem:checked').each(function(){
                items += this.value + ',';
            });
            items = items.substr(0, (items.length - 1));
            /* 将选中的项通过GET方式提交给指定的URI */
            var uri = $(this).attr('uri');
            window.location = uri + '&' + $(this).attr('name') + '=' + items;
        });
    }

    /* 缩小大图片 */
    $('.makesmall').each(function(){
        if(this.complete){
            makesmall(this, $(this).attr('max_width'), $(this).attr('max_height'));
        }else{
            $(this).load(function(){
                makesmall(this, $(this).attr('max_width'), $(this).attr('max_height'));
            });
        }
    });
});
function drop_confirm(msg, url){
    if(confirm(msg)){
        if(url == undefined){
            return true;
        }
        window.location = url;
    }else{
        if(url == undefined){
            return false;
        }
    }
}
function makesmall(obj,w,h){
    srcImage=obj;
    var srcW=srcImage.width;
    var srcH=srcImage.height;
    if (srcW==0)
    {
        obj.src=srcImage.src;
        srcImage.src=obj.src;
        var srcW=srcImage.width;
        var srcH=srcImage.height;
    }
    if (srcH==0)
    {
        obj.src=srcImage.src;
        srcImage.src=obj.src;
        var srcW=srcImage.width;
        var srcH=srcImage.height;
    }

    if(srcW>srcH){
        if(srcW>w){
            obj.width=newW=w;
            obj.height=newH=(w/srcW)*srcH;
        }else{
            obj.width=newW=srcW;
            obj.height=newH=srcH;
        }
    }else{
        if(srcH>h){
            obj.height=newH=h;
            obj.width=newW=(h/srcH)*srcW;
        }else{
            obj.width=newW=srcW;
            obj.height=newH=srcH;
        }
    }
    if(newW>w){
        obj.width=w;
        obj.height=newH*(w/newW);
    }else if(newH>h){
        obj.height=h;
        obj.width=newW*(h/newH);
    }
}

/*-= honghong 2013/10/08 =-*/
function heightLight( value ) {
	return '<font color="red"><b>'+ value +'</b></font>'
}

//输出折扣
function writeDiscount( retailPrice, wholeSalePrice ) {
	var discountStr = 0;
	if( retailPrice != 0 && wholeSalePrice != 0 ) {
		discountStr = ( wholeSalePrice / retailPrice * 10 ).toFixed( 2 );	
		if( discountStr > 7 ) {
			discountStr = '<font color="red"><b>'+ heightLight( discountStr ) +'</b></font>';
		} 
	}
	document.write( discountStr );
};

//输出当前折到的淘宝价格
function writeCurrTBPrice( curr, prev ) {
	var priceStr = '';
	if( curr == -1 ) {
		curr = 0;
	}
	if( prev == -1 ) {
		prev = 0;
	}
	
	curr = parseFloat( curr );
	prev = parseFloat( prev );
	
	if( prev == 0 ) {
		if( curr != 0 ) {
		   priceStr = heightLight( curr );	
		}
	} else {
		if( curr != 0 ) {
			if( curr != prev ) {
				priceStr = heightLight( curr );	
			} else {
				priceStr = curr;
			}
		}
 	}
	document.write( priceStr );
}

//输出状态
function writeState( type, subType ) {
	var stateStr = '';
	if( type == 0 ) {
		stateStr = '无数据';
	} else {
		if( subType == 0 ) {
			stateStr = '未同步';
		} else {
			stateStr = '已同步';
		}	
	}
	document.write( stateStr );
}

//输出操作按扭
function writeControlButton( goodsID, type, subType ) {
	var controlStr = '';
	if( type == 0 ) {
		controlStr = '无法进行操作';
	}  else {
		if( subType == 0 ) {
			controlStr = '<span style="cursor:pointer; color:blue;" type="update" goods_id="'+ goodsID +'">更新</span>';
		} else {
			controlStr = '<span style="cursor:pointer; color:blue;" type="reset" goods_id="'+ goodsID +'">取消更新</span>';
		}
	}
	document.write( controlStr );
}

//计算门店价折扣
function getWholesaleDiscount( retailPrice, wholesalePrice ) {
	return ( wholesalePrice / retailPrice * 10 ).toFixed( 2 );
}
