<?php require("header.html") ?>
    <style>
        .info th {
            width: 200px;
        }

        .btnF {
            width: 89px;
            height: 26px;
            line-height: 24px;
            color: #fff;
            background-color: #4Eacf1;
            font-weight: bolder;
            text-align: center;
            text-decoration: none
        }

        .btnS {
            display: block;
            width: 144px;
            height: 20px;
            line-height: 20px;
            color: #fff;
            background-color: #4Eacf1;
            font-weight: bolder;
            text-align: center;
            text-decoration: none
        }
    </style>
    <div id="rightTop">
        <p>Battle_Stronghold服务列表</p>
        <ul class="subnav">
            <li>
                <a href="index.php?app=game&act=createBattleStrongholdSet" class="btnS">添加Battle_Stronghold</a>
            </li>
        </ul>
    </div>

    <div class="mrightTop">
        <div class="fontl">

            <form method="GET" id="form">
                <div class="left line-h">
                    <input type="hidden" name="app" value="game" />
                    <input type="hidden" name="act" value="BattleStrongholdSetList" />

                 <?php echo $lang['belong_server']?>：
                    <select name="server_id">
                        <option value="0"><?php echo $lang['all']?></option>
                        <!--                        遍历平台名称及id -->
                        <?php foreach($servers as $key => $val):?>
                            <?php if( isset($id) && $val['id'] == $id ):?>
                                <option value="<?php echo $val['id'];?>" selected="selected">
                                    <?php echo $val['server_name'];?></option>
                            <?php else:?>
                                <option value="<?php echo $val['id'];?>"><?php echo $val['server_name'];?></option>
                            <?php endif;?>
                        <?php endforeach;?>
                    </select>
                    &nbsp;&nbsp;&nbsp;

                    &nbsp;<input type="submit"  style="cursor:pointer" class="formbtn" value="<?php echo $lang['search']?>" />
                    &nbsp;&nbsp;
                    <input type="button" onclick="window.location='/index.php?app=game&act=BattleStrongholdSetList'"
                           id="goBack" style="cursor:pointer;display: none" class="formbtn" value="<?php echo $lang['cancel_search']?>" />

                </div>
            </form>
        </div>
    </div>

    <div class="tdare">
        <table width="100%" cellspacing="0" class="dataTable">
            <thead>
            <tr class="tatr1">
                <td width="6%" class="firstCell">
                    <input type="checkbox" class="checkall" />&nbsp;
                <td width="13%">Battle_Stronghold服务ID</td>
                <td width="6%">物理主机ID</td>
                <td width="6%">主机wan_IP</td>
<!--                <td width="6%">主机local_IP</td>-->
                <td width="6%">开服时间</td>

                <td width="7%">BB支撑负载ID</td>

                <td width="10%">battle_server_ip</td>
                <td width="9%">battle_server_port</td>
                <td width="16%">zk_path</td>
                <td width="6%">状态</td>
                <td><?php echo $lang['handle']?></td>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($balances) ):?>
                <?php foreach( $balances as $key=>$val):?>
                    <tr class="tatr2">
                        <td class="firstCell">
                            <input type="checkbox" class="checkitem" value="<?php echo $val['id'];?>"/>
                        <!--                                                        <b>--><?php //echo $val['id'];?><!--</b>-->
                        </td>
<!--                        <td>--><?php //echo str_cut($val['content'], 58 ); ?><!--</td>-->
                        <td><?php echo $val['battle_stronghold_host_id']; ?></td>
                        <td><?php echo $val['server_id']; ?></td>
                        <td><?php echo $val['out_ip']; ?></td>
<!--                        <td>--><?php //echo $val['in_ip']; ?><!--</td>-->
                        <td><?php echo $val['open_server_time']; ?></td>

                        <td><?php echo $val['battle_balance_host_id_support']; ?></td>
                        <td><?php echo $val['battle_server_ip'] ;?></td>
                        <td><?php echo $val['battle_server_port'] ;?></td>

                        <td><?php echo $val['zk_path'] ;?></td>
                        <td><?php echo $val['status'] ;?></td>
                        <td >
                            <!--            <a href="javascript:;" onclick="toggle_state('--><?php //echo $val['id'];?><!--',this)"><?php echo $lang['hide']?></a>-->
                            <a href="index.php?app=game&act=editBattleStrongholdSet&id=<?php echo $val['id'] ?>">编辑</a>
                            &nbsp;|&nbsp;
                            <a href="javascript:drop_confirm('<?php echo $lang['deletion']?>','index.php?app=game&amp;act=3333drop&aim=game_push&amp;id=<?php echo $val['id'];?>');">
                                <?php echo $lang['delete']?></a>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php else:?>
                <tr>
                    <td colspan="10"><?php echo $lang['no_result']?></td>
                </tr>
            <?php endif;?>
            </tbody>
        </table>
        <div id="dataFuncs">
            <div id="batchAction" class="left paddingT15">
                <input class="formbtn batchButton"
                       type="button" value="<?php echo $lang['delete']?>"
                       name="id"
                       uri="index.php?app=game&act=3333drop&aim=game_push"
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

            var server_id = '<?php echo isset($_GET['server_id']) ? $_GET['server_id'] : 0 ?>';
            if(server_id){
                $("select[name='server_id']").val(server_id);
            }

            if(server_id > 0 ){
                $("#goBack").show();
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