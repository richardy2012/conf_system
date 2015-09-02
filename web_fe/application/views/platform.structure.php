<?php require("header.html") ?>
    <div id="rightTop">
        <p><?php echo $lang['platform_view']?></p>
    </div>
    <div class="mrightTop">
        <div class="fontl">
        </div>
    </div>
    <div class="tdare">

<?php if (isset($result) ):?>
    <?php foreach( $result as $k=>$v):?>
        <table width="100%" cellspacing="0" class="dataTable">
            <thead>
            <tr class="tatr1">
                <td width="1%">&nbsp;</td>
                <td width="9%"><?php echo $v['name'] ;?></td>
                <td width="6%"></td>
                <td width="5%"></td>
                <td width="9%"><?php echo $lang['merge_info'] ;?></td>
                <td width="12%">
                    <?php echo $lang['total_reg']?>：<?php echo $v['totalReg'] ;?>
                </td>
                <td width="12%">
                    <?php echo $lang['total_create']?>：<?php echo $v['totalRole'] ;?>
                </td>
                <td width="12%">
                    <?php echo $lang['total_recharges']?>：<?php echo $v['totalRecharge'] ;?>
                </td>
                <td width="21%"><?php echo $lang['platform_recharge_total']?>：&nbsp;&nbsp;<?php echo $v['totalAmount'] ;?></td>
                <td><?php echo $lang['surplus_coins']?></td>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($v['servers']) ):?>
                <?php foreach( $v['servers'] as $key=>$val):?>
                    <tr class="tatr2">
                        <td class="firstCell">
                        </td>
                        <td>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php echo $val['server_name'] ;?>
                        </td>
                        <td>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php echo $val['server_type'] ;?>
                        </td>
                        <td>
                            <?php echo $val['status'] ? $lang['server_type_label'][0] : $lang['server_type_label'][1] ;?>
                        </td>

                        <td>
                           <?php echo  isset($val['server_merge']) && !empty($val['server_merge']) ? $val['server_merge'] : '' ;?>
                        </td>

                        <td>
                           <?php echo $val['Reg'] ;?>
                        </td>
                        <td>
                            <?php echo $val['Role'] ;?>
                        </td>
                        <td>
                            <?php echo $val['recharge'] ;?>
                        </td>
                        <td><?php echo $val['rechargeAmount'] ;?></b></td>
                        <td>
                            <?php echo $val['Popular'] ;?>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
    <?php endforeach;?>
<?php else:?>
    <table width="100%" cellspacing="0" class="dataTable">
    <tbody>
        <tr class="tatr2">
            <td colspan="3"><?php echo $lang['noResult']?></td>
        </tr>
    </tbody>
    </table>
<?php endif;?>

    <div id="dataFuncs">
            <div id="batchAction" class="left paddingT15">

<!--                <input class="formbtn batchButton"-->
<!--                       type="button" value="删除"-->
<!--                       name="id"-->
<!--                       uri="index.php?app=platform&act=drop&aim=platform"-->
<!--                       presubmit="confirm('正在执行删除操作！');" />-->
            </div>
            <div class="pageLinks">
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