<?php require("header.html") ?>
    <div id="rightTop">
        <p><?php echo $lang['host_list']?></p>
        <ul class="subnav">
            <li>
                <a href="index.php?app=server&act=addServer" class="btn4"><?php echo $lang['add_host']?></a>
            </li>
        </ul>
    </div>

    <div class="mrightTop">
        <div class="fontl">

            <form method="GET" id="form">
                <div class="left line-h">
                    <input type="hidden" name="app" value="server" />
                    <input type="hidden" name="act" value="index" />
                    <!--            发布时间：<input class="queryInput" type="text" value="" id="start_time" name="start_time" class="pick_date" />-->
                    <!--            至 <input class="queryInput" type="text" value="" id="end_time" name="end_time" class="pick_date" />&nbsp;&nbsp;-->
                    <!---->
                    <!--            状态:-->
                    <!--            <select name="state"><option value=" ">全部</option><option value="2">隐藏</option></select>&nbsp;&nbsp;&nbsp;-->
                    <?php echo $lang['belong_platform']?>：
                    <select name="platform_id">
                        <option value="0"><?php echo $lang['all']?></option>
<!--                        遍历平台名称及id -->
                        <?php foreach($platforms as $key => $val):?>
                            <?php if( isset($id) && $val['id'] == $id ):?>
                                <option value="<?php echo $val['id'];?>" selected="selected">
                                    <?php echo $val['name'];?></option>
                            <?php else:?>
                                <option value="<?php echo $val['id'];?>"><?php echo $val['platform_name'];?></option>
                            <?php endif;?>
                        <?php endforeach;?>

                    </select>&nbsp;&nbsp;&nbsp;
                    &nbsp;<input type="submit"  style="cursor:pointer" class="formbtn" value="<?php echo $lang['search']?>" />
                    &nbsp;&nbsp;
                    <input type="button" onclick="window.location='/index.php?app=server'" id="goBack"
                           style="cursor:pointer;display: none" class="formbtn" value="<?php echo $lang['cancel_search']?>" />
                </div>
            </form>
        </div>
    </div>

    <div class="tdare">
        <table width="100%" cellspacing="0" class="dataTable">
            <thead>
            <tr class="tatr1">
                <td width="6%" class="firstCell">
                    <input type="checkbox" class="checkall" />&nbsp;</td>
                <td width="8%"><?php echo $lang['belong_platform']?></td>
                <td width="8%"><?php echo $lang['serverID']?></td>
                <td width="8%"><?php echo $lang['server_name']?></td>
                <td width="9%"><?php echo $lang['in_ip']?></td>
                <td width="9%"><?php echo $lang['in_nic_name']?></td>
                <td width="8%"><?php echo $lang['out_ip']?></td>
                <td width="9%"><?php echo $lang['out_nic_name']?></td>
                <td width="8%"><?php echo $lang['server_desc']?></td>
                <td width="6%"><?php echo $lang['status']?></td>
                <td><?php echo $lang['handle']?></td>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($server) ):?>
                <?php foreach( $server as $key=>$val):?>
                    <tr class="tatr2">
                        <td class="firstCell">
                            <input type="checkbox" class="checkitem" value="<?php echo $val['id'];?>"/>
                                                        <?php echo $val['id'];?>
                        </td>
                        <td><?php echo $val['platform_name'] ;?></td>
                        <td><?php echo $val['server_id'] ;?></td>
                        <td><?php echo $val['server_name'] ;?></td>
                        <td><?php echo $val['in_ip'] ;?></td>
                        <td><?php echo $val['in_nic_name'] ;?></td>
                        <td><?php echo $val['out_ip'] ;?></td>
                        <td><?php echo $val['out_nic_name'] ;?></td>
                        <td><?php echo str_cut($val['desc'], 28 ); ?></td>
                        <td><?php echo $val['status'] ? $lang['server_type_label'][0]:$lang['server_type_label'][1];?></td>
                        <td >
                            <!--            <a href="javascript:;" onclick="toggle_state('--><?php //echo $val['id'];?><!--',this)">隐藏</a>-->
                            <a href="index.php?app=server&act=editServer&id=<?php echo $val['id'] ?>"><?php echo $lang['edit']?></a>
                            &nbsp;|&nbsp;
                            <a href="javascript:drop_confirm('<?php echo $lang['deletion']?>','index.php?app=server&aim=server&amp;act=drop&amp;id=<?php echo $val['id'];?>');"><?php echo $lang['delete']?></a>
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
                <input class="formbtn batchButton"
                       type="button" value="<?php echo $lang['delete']?>"
                       name="id"
                       uri="index.php?app=server&act=drop&aim=server"
                       presubmit="confirm('<?php echo $lang['deletion']?>');" />
            </div>
            <div class="pageLinks">

                <?php include 'page.bottom.html'; ?>

            </div>
        </div>
        <div class="clear"></div>
    </div>

    <script type="text/javascript">

        $(document).ready(function(){

            var platform_id = '<?php echo isset($_GET['platform_id']) ? $_GET['platform_id'] : 0 ?>';
            if(platform_id){
                $("select[name='platform_id']").val(platform_id);
            }

            if(platform_id > 0 ){
                $("#goBack").show();
            }
        })


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