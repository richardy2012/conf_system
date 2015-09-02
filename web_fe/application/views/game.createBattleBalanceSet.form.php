<?php require("header.html") ?>
    <script src="/public/js/jquery.ui/jquery.ui.js"></script>
    <script src="/public/js/jquery.ui/jquery-ui-slide.min.js"></script>
    <script src="/public/js/jquery.ui/jquery-ui-timepicker-addon.js"></script>
    <script src="/public/js/jquery.ui/i18n/zh-CN.js"></script>
    <link rel="stylesheet" href="/public/js/jquery.ui/themes/smoothness/jquery.ui.css"/>

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
        <ul class="subnav">
            <li><a class="btnS" href="index.php?app=game&act=battleBalanceSetList">battle_balance负载列表</a></li>
        </ul>
        <p>添加battle_balance负载</p>
    </div>

    <!--form表单开始-->
    <div class="info" style="height: auto">
        <form method="POST" enctype="multipart/form-data" id="form">
            <table class="infoTable" style="height: auto">

                <tr rel_data="TOP">
                    <th  class="paddingT15"> battleBalance负载编号:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="battle_balance_host_id" type="text"name="battle_balance_host_id"
                               value="<?php echo isset($battle_balance_host_id) ? $battle_balance_host_id : '';?>" />
                        <label class="field_notice">填入负载服务器的编号</label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"><?php echo $lang['install_host']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <select style="width: 157px" id="server_id" name="server_id">
                            <?php foreach($servers as $key => $val):?>
                                <option value="<?php echo $val['id'];?>"><?php echo $val['server_name'];?></option>
                            <?php endforeach;?>
                        </select>
                        <label class="field_notice">部署在哪台物理机器</label>
                    </td>
                </tr>

                <tr rel_data="TOP">
                    <th  class="paddingT15"> <?php echo $lang['open_server_time']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="open_server_time" type="text"name="open_server_time"
                               value="<?php echo isset($open_server_time) ? $open_server_time : '';?>" />
                        <label class="field_notice"><?php echo $lang['select_start_dis_time']?></label>
                    </td>
                </tr>

                <tr rel="equip" >
                    <th class="paddingT15">对广域网battle_balance服务：</th>
                    <td class="paddingT15 wordSpacing5 iparent">
                        <b>ip:</b>
                        <input type="text" id="battle_for_battle_balance_ip" name="battle_for_battle_balance_ip" class="reward_item" />
                        &nbsp;
                        <b>port:</b>&nbsp;
                        <input type="text" id="battle_for_battle_balance_port" name="battle_for_battle_balance_port" class="reward_quantity"/>
                        <label class="field_notice">请输入对外提供battle_master服务的IP和端口</label>
                    </td>
                </tr>

                <tr rel="equip" >
                    <th class="paddingT15">对广域网battle_master服务务：</th>

                    <td class="paddingT15 wordSpacing5 iparent">
                        <b>ip:</b>
                        <input type="text" id="battle_for_battle_master_ip" name="battle_for_battle_master_ip" class="reward_item" />
                        &nbsp;
                        <b>port:</b>&nbsp;
                        <input type="text" id="battle_for_battle_mater_port" name="battle_for_battle_mater_port" class="reward_quantity"/>
                        <label class="field_notice">请输入对外提供battle_balance服务的IP和端口</label>
                    </td>
                </tr>

                <tr rel_data="TOP">
                    <th class="paddingT15"><?php echo $lang['status']?></th>
                    <td class="paddingT15 wordSpacing5">
                        <select id="status" name="status">
                            <option value="1"><?php echo $lang['normal']?></option>
                            <option value="0"><?php echo $lang['close']?></option>
                        </select>
                        <label class="field_notice"><?php echo $lang['default_normal']?></label>
                    </td>
                </tr>

                <tr rel_data="TOP" style="height: auto">
                    <th class="paddingT15">battle_balancer.ini预览</th>
                    <td class="paddingT15 wordSpacing5" style="height: 650px">
                        <iframe id="framer" name="framer" src="index.php?app=game&act=showGameSet&set_type=battle_balancer" width="100%" height="100%" style="overflow:hidden; border:0;" scrolling="no" frameborder="no" scroll="no">
                        </iframe>
                    </td>
                </tr>

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
        var type = 'battle_balancer';
        var l_id = '<?php echo isset($battle_balance_host_id) ? $battle_balance_host_id : 0;?>';

        $(document).ready(function(){
            // 时间设置
            $('#open_server_time').datetimepicker();

            var status = "<?php echo isset($status) ? $status : '';?>";
            if(status){
                $("#status").val(status);
            }

            var battle_for_battle_master_ip = "<?php echo isset($battle_for_battle_master_ip) ? $battle_for_battle_master_ip : '';?>";
            if(battle_for_battle_master_ip){
                $("#battle_for_battle_master_ip").val(battle_for_battle_master_ip);
            }else{
                $("#battle_for_battle_master_ip").val('0.0.0.0');
            }

            var battle_for_battle_mater_port = "<?php echo isset($battle_for_battle_mater_port) ? $battle_for_battle_mater_port : '';?>";
            if(battle_for_battle_mater_port){
                $("#battle_for_battle_mater_port").val(battle_for_battle_mater_port);
            }else{
                $("#battle_for_battle_mater_port").val('');
            }

            var battle_for_battle_balance_ip = "<?php echo isset($battle_for_battle_balance_ip) ? $battle_for_battle_balance_ip : '';?>";
            if(battle_for_battle_balance_ip){
                $("#battle_for_battle_balance_ip").val(battle_for_battle_balance_ip);
            }else{
                $("#battle_for_battle_balance_ip").val('0.0.0.0');
            }

            var battle_for_battle_balance_port = "<?php echo isset($battle_for_battle_balance_port) ? $battle_for_battle_balance_port : '';?>";
            if(battle_for_battle_balance_port){
                $("#battle_for_battle_balance_port").val(battle_for_battle_balance_port);
            }else{
                $("#battle_for_battle_balance_port").val('');
            }


            var init_show_set_url = '';
            if(battle_for_battle_master_ip.length != 0){
                init_show_set_url = init_show_set_url + '&battle_for_battle_master_ip=' +battle_for_battle_master_ip;
            }
            if(battle_for_battle_mater_port.length != 0){
                init_show_set_url = init_show_set_url + '&battle_for_battle_mater_port=' +battle_for_battle_mater_port;
            }
            if(battle_for_battle_balance_ip.length != 0){
                init_show_set_url = init_show_set_url + '&battle_for_battle_balance_ip=' +battle_for_battle_balance_ip;
            }
            if(battle_for_battle_balance_port.length != 0){
                init_show_set_url = init_show_set_url + '&battle_for_battle_balance_port=' +battle_for_battle_balance_port;
            }
            var showSetUrl = 'index.php?app=game&act=showGameSet&set_type='+type+init_show_set_url;
            $("#framer").attr("src",showSetUrl);

            $("tr[rel='equip'] input").blur(function(){
                var battle_for_battle_master_ip = $("#battle_for_battle_master_ip").val()
                var battle_for_battle_mater_port = $("#battle_for_battle_mater_port").val()
                var battle_for_battle_balance_ip = $("#battle_for_battle_balance_ip").val()
                var battle_for_battle_balance_port = $("#battle_for_battle_balance_port").val()
                var urlSet = '&set_type=' + type;
                if(battle_for_battle_master_ip.length != 0){
                    urlSet = urlSet + '&battle_for_battle_master_ip=' +battle_for_battle_master_ip;
                }
                if(battle_for_battle_mater_port.length != 0){
                    urlSet = urlSet + '&battle_for_battle_mater_port=' +battle_for_battle_mater_port;
                }
                if(battle_for_battle_balance_ip.length != 0){
                    urlSet = urlSet + '&battle_for_battle_balance_ip=' +battle_for_battle_balance_ip;
                }
                if(battle_for_battle_balance_port.length != 0){
                    urlSet = urlSet + '&battle_for_battle_balance_port=' +battle_for_battle_balance_port;
                }
                var showSetUrl = 'index.php?app=game&act=showGameSet&set_type='+type+urlSet;
                $("#framer").attr("src",showSetUrl);
            })

            //battle_balance_host_id 的排重

            //同一机器下 是否部署多个 load_balance_host 的排重

        });

        var validateOption = {
            onkeyup:false,
            rules:{
                'battle_balance_host_id':{
                    required:true,
                    remote: {
                        url:'index.php?app=game&act=ajaxCheckHostId',
                        type:'post',
                        data:{
                            host_id:function(){
                                return $("#battle_balance_host_id").val();
                            },
                            id:'<?php echo isset($id) ? $id : 0;?>',
                            type:type
                        }
                    }
                },
                server_id:{
                    required:true,
                    remote: {
                        url:'index.php?app=game&act=ajaxCheckBattleBalanceServerSingle',
                        type:'post',
                        data:{
                            server_id:function(){
                                return $("#server_id").val();
                            },
                            id:l_id
                        }
                    }
                },
                open_server_time:{
                    required:true
                },
                battle_for_battle_master_ip:{
                    required:true
                },
                battle_for_battle_mater_port:{
                    required:true
                },
                battle_for_battle_balance_ip:{
                    required:true
                },
                battle_for_battle_balance_port:{
                    required:true
                }
            },
            messages:{
                'battle_balance_host_id':{
                    required:'请输入',
                    remote:'编号不能重复'
                },
                server_id:{
                    required:'请选择',
                    remote:'只能部署单应用实例'
                },
                open_server_time:{
                    required:'请输入'
                },
                battle_for_battle_master_ip:{
                    required:'请输入'
                },
                battle_for_battle_mater_port:{
                    required:'请输入'
                },
                battle_for_battle_balance_ip:{
                    required:'请输入'
                },
                battle_for_battle_balance_port:{
                    required:'请输入'
                }
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent());
            },

            submitHandler:function(form){
                var logic = true;
                if(logic){
                    form.submit();
                }
            }

        };
        $("form").validate(validateOption);
        //]]>
    </script>
    <!--form表单结束-->

<?php require("footer.html")?>