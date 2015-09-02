<?php require("header.html") ?>
    <div id="rightTop">
        <p><?php echo $lang['platform_list']?></p>
        <ul class="subnav">
            <li>
                <a href="index.php?app=server&act=addPlatform" class="btn4"><?php echo $lang['add_platform']?></a>
            </li>
        </ul>
    </div>

    <div class="mrightTop">
        <div class="fontl">
        </div>
    </div>

    <div class="tdare">
        <table width="100%" cellspacing="0" class="dataTable">
            <thead>
            <tr class="tatr1">
                <td width="8%" class="firstCell">
                    <input type="checkbox" class="checkall" />&nbsp;</td>
                <td width="10%"><?php echo $lang['platformID']?></td>
                <td width="10%"><?php echo $lang['platform_name']?></td>
<!--                <td width="10%">--><?php //echo $lang['platform_servers']?><!--</td>-->
                <td width="12%"><?php echo $lang['official_site']?></td>
<!--                <td width="10%">--><?php //echo $lang['platform_divide']?><!--</td>-->
<!--                <td width="10%">--><?php //echo $lang['platform_type']?><!--</td>-->
<!--                <td width="10%">--><?php //echo $lang['game_operator']?><!--</td>-->
<!--                <td width="7%">--><?php //echo $lang['order']?><!--</td>-->
                <td width="7%"><?php echo $lang['status']?></td>
                <td><?php echo $lang['handle']?></td>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($platform) ):?>
                <?php foreach( $platform as $key=>$val):?>
                    <tr class="tatr2">
                        <td class="firstCell">
                            <input type="checkbox" class="checkitem" value="<?php echo $val['id'];?>"/>
                            <!--                            --><?php //echo $val['id'];?>
                        </td>
                        <td><?php echo $val['platform_id'] ;?></td>
                        <td><?php echo $val['platform_name'] ;?></td>
<!--                        <td>--><?php //echo isset($val['num']) ? $val['num'] : 1 ;?><!--</td>-->
                        <td><?php echo str_cut($val['official_site'],32) ;?></td>
<!--                        <td >--><?php //echo $val['sort'] ;?><!--</td>-->
                        <td><?php echo $val['status'] ? $lang['server_type_label'][0]:$lang['server_type_label'][1];?></td>
                        <td >
                            <!--            <a href="javascript:;" onclick="toggle_state('--><?php //echo $val['id'];?><!--',this)">隐藏</a>-->
                            <a href="index.php?app=server&act=editPlatform&id=<?php echo $val['id'] ?>"><?php echo $lang['edit'] ;?></a>
                            &nbsp;|&nbsp;
                            <a href="javascript:drop_confirm('<?php echo $lang['deletion'] ;?>','index.php?app=server&aim=platform&amp;act=drop&amp;id=<?php echo $val['id'];?>');"><?php echo $lang['delete'] ;?></a>
                        </td>

                    </tr>
                <?php endforeach;?>
            <?php else:?>
                <tr>
                    <td colspan="7"><?php echo $lang['no_result'] ;?></td>
                </tr>
            <?php endif;?>
            </tbody>
        </table>

        <div id="dataFuncs">
            <div id="batchAction" class="left paddingT15">
                <input class="formbtn batchButton"
                       type="button" value="<?php echo $lang['delete'] ;?>"
                       name="id"
                       uri="index.php?app=server&act=drop&aim=platform"
                       presubmit="confirm('<?php echo $lang['deletion'] ;?>');" />
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
            if(!confirm('<?php echo $lang['erform_operation'] ;?>')){
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