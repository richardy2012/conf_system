<?php require("header.html")?>
    <div id="rightTop">
        <p><?php echo $lang['user_list']?></p>
        <ul class="subnav">
            <li>
                <a href="index.php?app=admin&act=addAdmin" class="btn1"><?php echo $lang['add_user']?></a>
            </li>
        </ul>
    </div>

    <div class="mrightTop">
        <div class="fontl">
            <!--<form method="get" id="form">-->
            <!--<div class="left line-h">-->
            <!--<input type="hidden" name="app" value="solid_goods" />-->
            <!--<input type="hidden" name="act" value="index" />-->
            <!--发布时间：<input class="queryInput" type="text" value="" id="start_time" name="start_time" class="pick_date" />-->
            <!--至 <input class="queryInput" type="text" value="" id="end_time" name="end_time" class="pick_date" />&nbsp;&nbsp;-->

            <!--状态:-->
            <!--<select name="state"><option value=" ">全部</option><option value="2">隐藏</option></select>&nbsp;&nbsp;&nbsp;-->

            <!--&nbsp;<input type="submit"  style="cursor:pointer" class="formbtn" value="查询" />-->
            <!--</div>-->
            <!--</form>-->

            <!--</div>-->

            <!--<div class="fontr"><div class="page">-->
            <!--<div class="flip_over">翻页: </div>-->
            <!--<span class="formerNull"></span>-->
            <!--<a class="down" href="index.php?app=solid_goods&amp;page=2">下一页</a>-->
            <!--</div>-->
        </div>
    </div>

    <div class="tdare">
        <table width="100%" cellspacing="0" class="dataTable">
            <thead>
            <tr class="tatr1">
                <td width="8%" class="firstCell">
                    <input type="checkbox" class="checkall" />&nbsp;
                    <?php echo $lang['select_all']?></td>
                <td width="10%"><?php echo $lang['user_name']?></td>
                <td width="10%"><?php echo $lang['nick_name']?></td>
                <td width="10%"><?php echo $lang['role']?></td>
                <td width="13%"><?php echo $lang['role_manage_list']?></td>
                <td width="9%"><?php echo $lang['gender']?></td>
                <td width="10%"><?php echo $lang['phone']?></td>
                <td width="10%"><?php echo $lang['create_time']?></td>
                <td width="8%"><?php echo $lang['status']?></td>
                <td><?php echo $lang['handle']?></td>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($admin) ):?>
                <?php foreach( $admin as $key=>$val):?>
                    <tr class="tatr2">
                        <td class="firstCell">
                            <input type="checkbox" class="checkitem" value="<?php echo $val['id'];?>"/>
                            <?php echo $val['id'];?>
                        </td>
                        <td><?php echo $val['username'] ;?></td>
                        <td><?php echo $val['nickname'] ;?></td>
                        <td><?php echo $val['role_name'] ;?></td>
                        <td><?php echo $val['platform_id'] ;?></td>
                        <td><?php echo $val['sex'] ? $lang['male']:$lang['female'] ;?></td>
                        <td><?php echo $val['telphone'] ;?></td>
                        <td><?php echo date('Y-m-d',$val['dateline']) ;?></td>
                        <td><?php echo $val['status'] ? $lang['normal']:$lang['forbid'] ;?></td>
                        <td >
                            <!--            <a href="javascript:;" onclick="toggle_state('--><?php //echo $val['id'];?><!--',this)">隐藏</a>-->
                            <a href="index.php?app=admin&act=editAdmin&id=<?php echo $val['id'] ?>"><?php echo $lang['edit']?></a>
                            &nbsp;|&nbsp;
                            <a href="javascript:drop_confirm('<?php echo $lang['deletion']?>','index.php?app=admin&aim=admin&amp;act=drop&amp;id=<?php echo $val['id'];?>');"><?php echo $lang['delete']?></a>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php else:?>
                <tr>
                    <td colspan="7"><?php echo $lang['no_result']?></td>
                </tr>
            <?php endif;?>
            </tbody>
        </table>

        <div id="dataFuncs">
            <div id="batchAction" class="left paddingT15">
<!--                <input class="formbtn batchButton"-->
<!--                       type="button" value="删除"-->
<!--                       name="id"-->
<!--                       uri="index.php?app=home&act=drop&aim=link"-->
<!--                       presubmit="confirm('正在执行删除操作！');" />-->
            </div>
            <div class="pageLinks">
                <?php include 'page.bottom.html'; ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <script type="text/javascript">
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