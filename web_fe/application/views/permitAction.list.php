<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7 charset=utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> <?php echo $lang['manage_center']?> | <?php echo isset($working) ? $working : $lang['manage_back']?></title>
    <link href="/public/admin/css/admin.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        <!--
        body {background: #fcfdff}
        -->
    </style>
    <!--<link href="/public/admin/images/skin.css" rel="stylesheet" type="text/css" />-->
    <script type="text/javascript" src="/public/js/jquery.js"></script>
    <script type="text/javascript" src="/public/admin/js/admin.js"></script>
    <script type="text/javascript" src="/public/admin/js/ecmall.js"></script>
    <body>
    <style type="text/css">
        /*.paddingTop{padding-top:5px;}*/
        /*.line-h{line-height:26px;}*/
        /*.tdare .goodsImg{width:170px;float:left;margin-right:10px}*/
        /*.gray1{color:#999;}*/
    </style>
    <script charset="utf-8" type="text/javascript" src="/public/js/jqtreetable.js" ></script>
    <link rel="stylesheet" type="text/css" href="/public/images/jqtreetable.css"  /></head>
<div id="rightTop">
    <p><?php echo $lang['app_list']?></p>
    <ul class="subnav">
        <li>
            <a href="index.php?app=admin&act=addPermitAction" class="btn4"><?php echo $lang['add_app']?></a>
        </li>
    </ul>
</div>
<div class="mrightTop">
    <div class="fontl">
    </div>
</div>
<div class="tdare">
    <table width="100%" cellspacing="0" class="dataTable">
        <?php if(isset($cates)):?>
            <thead>
            <tr>
                <td class="w30" width="5%">
                    <input type="checkbox" class="checkall" />&nbsp;</td>
                <td width="15%"><?php echo $lang['cate']?>ID</td>
                <td width="29%"><?php echo $lang['cate'].$lang['name']?></td>
<!--                <td width="20%">状态</td>-->
<!--                <td>操作</td>-->
            </tr>
            </thead>
        <?php endif;?>
        <tbody id="treet1">

        <?php if (isset($cates) && $cates ):?>
            <?php foreach( $cates as $key=>$val):?>
                <tr>

                    <td class="align_center w30">
                        <input type="checkbox"
                               class="checkitem" value="<?php echo $val['id'];?>"/>
                    </td>
                    <td><b><?php echo $val['id'] ;?></b></td>

                    <td class="node" ><?php echo str_cut($val['action_name'],48) ;?></td>
<!--                    <td>--><?php //echo $val['status'] ;?><!--</td>-->
                    <td >
&nbsp;
                        <!--            <a href="javascript:;" onclick="toggle_state('--><?php //echo $val['id'];?><!--',this)">隐藏</a>-->
<!--                        <a href="index.php?app=article&act=editAcategory&id=--><?php //echo $val['id'] ?><!--">编辑</a>-->
<!--                        &nbsp;|&nbsp;-->
<!--                        <a href="javascript:drop_confirm('正在执行删除操作！','index.php?app=article&act=delAcategory&aim=acategory&id=--><?php //echo $val['id'];?><!--');">删除</a>-->
                    </td>
                </tr>
            <?php endforeach;?>
        <?php else:?>
            <tr>
                <td colspan="6"><?php echo $lang['no_result']?></td>
            </tr>
        <?php endif;?>
        </tbody>
    </table>


    <div id="dataFuncs">
        <div id="batchAction" class="left paddingT15">
            <!--                <input class="formbtn batchButton"-->
            <!--                       type="button" value="删除"-->
            <!--                       name="id"-->
            <!--                       uri="index.php?app=article&act=drop&aim=acategory"-->
            <!--                       presubmit="confirm('正在执行删除操作！');" />-->
        </div>
        <div class="pageLinks">
        </div>
    </div>
    <div class="clear"></div>
</div>

<script type="text/javascript">
    $(function()
    {
        var map = <?php echo $map;?>;
        if (map.length > 0)
        {
            var option = {openImg: "/public/images/treetable/tv-collapsable.gif",
                shutImg: "/public/images/treetable/tv-expandable.gif",
                leafImg: "/public/images/treetable/tv-item.gif",
                lastOpenImg: "/public/images/treetable/tv-collapsable-last.gif",
                lastShutImg: "/public/images/treetable/tv-expandable-last.gif",
                lastLeafImg: "/public/images/treetable/tv-item-last.gif",
                vertLineImg: "/public/images/treetable/vertline.gif",
                blankImg: "/public/images/treetable/blank.gif",
                collapse: false,
                striped: false,
                highlight: true,
                state:false,
                column: 2
            };
            $("#treet1").jqTreeTable(map, option);
        }
    });
    function toggle_state(id,a)
    {
        if(!confirm('<?php echo $lang['erform_operation']?>')){
            return;
        }
        var ajaxOption = {};
        ajaxOption.url='index.php?app=solid_goods&act=toggle_state';
        ajaxOption.dataType='JSON';
        ajaxOption.type='GET';
        ajaxOption.data = {
            id:id
        };
        ajaxOption.success = function(response){
            if(response == 1){
                location.reload(true);   //强制刷新页面
            }
        }
        $.ajax(ajaxOption);
    }
</script>
<?php require("footer.html")?>