<?php require("header.html") ?>
    <script src="/public/js/jquery.ui/jquery.ui.js"></script>
    <script src="/public/js/jquery.ui/jquery-ui-slide.min.js"></script>
    <script src="/public/js/jquery.ui/jquery-ui-timepicker-addon.js"></script>
    <script src="/public/js/jquery.ui/i18n/zh-CN.js"></script>
    <link rel="stylesheet" href="/public/js/jquery.ui/themes/smoothness/jquery.ui.css"/>

    <div id="rightTop">
        <ul class="subnav">
            <li><a class="btn4" href="index.php?app=server"><?php echo $lang['host_list']?></a></li>
        </ul>
        <p><?php echo $lang['add_host']?></p>
    </div>

    <!--form表单开始-->
    <div class="info">
        <form method="POST" enctype="multipart/form-data" id="form">
            <table class="infoTable">
                <tr>
                    <th class="paddingT15"> <?php echo $lang['serverID']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="server_id" type="text"name="server_id"
                               value="<?php echo isset($server_id) ? $server_id : '';?>" />
                        <label class="field_notice"><?php echo $lang['eg']?>: 123132</label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"> <?php echo $lang['server_name']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="server_name" type="text"name="server_name"
                               value="<?php echo isset($server_name) ? $server_name : '';?>" />
                        <label class="field_notice"><?php echo $lang['server_eg']?></label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"><?php echo $lang['belong_platform']?></th>
                    <td class="paddingT15 wordSpacing5">
                        <select style="width: 157px" id="platform_id" name="platform_id">
                            <option value=""><?php echo $lang['select_pl']?></option>
                                <?php foreach($platforms as $key => $val):?>
                                    <?php if( isset($platform_id) && $val['id'] == $platform_id ):?>
                                        <option value="<?php echo $val['id'];?>" selected="selected">
                                            <?php echo $val['platform_name'];?></option>
                                    <?php else:?>
                                        <option value="<?php echo $val['id'];?>"><?php echo $val['platform_name'];?></option>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </select>
                        <label class="field_notice"><?php echo $lang['select_server_platform']?></label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"> <?php echo $lang['in_ip']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="in_ip" type="text"name="in_ip"
                               value="<?php echo isset($in_ip) ? $in_ip : '';?>" />
                        <label class="field_notice">示例: 192.168.90.6</label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"> <?php echo $lang['out_ip']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="out_ip" type="text"name="out_ip"
                               value="<?php echo isset($out_ip) ? $out_ip : '';?>" />
                        <label class="field_notice">示例: 115.124.90.6</label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"> <?php echo $lang['in_nic_name']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="in_nic_name" type="text"name="in_nic_name"
                               value="<?php echo isset($in_nic_name) ? $in_nic_name : '';?>" />
                        <label class="field_notice">示例: eth0</label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"> <?php echo $lang['out_nic_name']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="out_nic_name" type="text" name="out_nic_name"
                               value="<?php echo isset($out_nic_name) ? $out_nic_name : '';?>" />
                        <label class="field_notice">示例: eth1</label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"><?php echo $lang['server_desc']?>：</th>
                    <td class="paddingT15 wordSpacing5">
                        <textarea name="desc" style="width: 390px;" ><?php echo isset($desc) ? $desc : '';?></textarea>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"><?php echo $lang['status']?></th>
                    <td class="paddingT15 wordSpacing5">
                        <select id="status" name="status">
                            <option value="1"><?php echo $lang['normal']?></option>
                            <option value="0"><?php echo $lang['close']?></option>
                        </select>
                        <label class="field_notice"><?php echo $lang['default_normal']?></label>
                    </td>
                </tr>

<!--                <tr>-->
<!--                    <th class="paddingT15"> --><?php //echo $lang['order']?><!--:</th>-->
<!--                    <td class="paddingT15 wordSpacing5">-->
<!--                        <input id="sort" size="6px" type="text"name="sort"  value="--><?php //echo isset($sort) ? $sort : '';?><!--" />-->
<!--                        <label class="field_notice">--><?php //echo $lang['order_notice']?><!--</label>-->
<!--                    </td>-->
<!--                </tr>-->


                <tr>
                    <th></th>
                    <td class="ptb20"><input class="formbtn" type="submit" value="<?php echo $lang['submit']?>" />
                        <input class="formbtn" type="reset" name="Reset" value="<?php echo $lang['reset']?>" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        //<!CDATA[
        $(document).ready(function(){
            // 时间设置
            var id = '<?php echo isset($id) ? $id : ''?>';

            $('#start_time,#end_time').datetimepicker();

            var FunShow = function(className){
                $("#form").find("tr[rel_data='" + className +  "']").show().find("input,select").removeAttr('disabled');
            };

            var FunHide = function(className){
                $("#form").find("tr[rel_data='" + className + "']").hide().find("input,select").attr('disabled',true);
            };

            var status = "<?php echo isset($status) ? $status : '';?>";
            if(status){
                $("#status").val(status);
            }
        });

        var validateOption = {
            onkeyup:false,
            rules:{
                server_id:{
                    required:true,
                    number:true
                },
                platform_id:{
                    required:true
                },
                server_name:{
                    required:true
                },
                in_ip:{
                    required:true
                },
                out_ip:{
                    required:true
                },
                in_nic_name:{
                    required:true
                },
                out_nic_name:{
                    required:true
                },
                desc:{
                    maxlength:255
                }
            },
            messages:{
                server_id:{
                    required:'<?php echo $lang['please_input']?>',
                    number:'<?php echo $lang['please_input'].$lang['number']?>'
                },
                platform_id:{
                    required:'<?php echo $lang['select_please']?>'
                },
                server_name:{
                    required:'<?php echo $lang['please_input']?>'
                },
                in_ip:{
                    required:'<?php echo $lang['please_input']?>'
                },
                out_ip:{
                    required:'<?php echo $lang['please_input']?>'
                },
                in_nic_name:{
                    required:'<?php echo $lang['please_input']?>'
                },
                out_nic_name:{
                    required:'<?php echo $lang['please_input']?>'
                },
                desc:{
                    maxlength:'<?php echo $lang['max_num']?>'
                }
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent());
            }
        };
        $("form").validate(validateOption);
        //]]>
    </script>
    <!--form表单结束-->

<?php require("footer.html")?>