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
            <li><a class="btnS" href="index.php?app=game&act=loadBalanceSetList">load_balance负载列表</a></li>
        </ul>
        <p>添加load_balance负载</p>
    </div>

    <!--form表单开始-->
    <div class="info" style="height: auto">
        <form method="POST" enctype="multipart/form-data" id="form">
            <table class="infoTable" style="height: auto">

                <tr rel_data="TOP">
                    <th  class="paddingT15"> loadBalance负载编号:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="load_balance_host_id" type="text"name="load_balance_host_id"
                               value="<?php echo isset($load_balance_host_id) ? $load_balance_host_id : '';?>" />
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
                    <th class="paddingT15">对广域网login_server服务：</th>
                    <td class="paddingT15 wordSpacing5 iparent">
                        <b>ip:</b>
                        <input type="text" id="load_for_login_server_ip" name="load_for_login_server_ip" class="reward_item" />
                        &nbsp;
                        <b>port:</b>&nbsp;
                        <input type="text" id="load_for_login_server_port" name="load_for_login_server_port" class="reward_quantity"/>
                        <label class="field_notice">请输入对外提供login_server服务的IP和端口</label>
                    </td>
                </tr>

                <tr rel="equip" >
                    <th class="paddingT15">对本地load_balancer服务：</th>
                    <td class="paddingT15 wordSpacing5 iparent">
                        <b>ip:</b>
                        <input type="text" id="load_for_load_balance_ip" name="load_for_load_balance_ip" class="reward_item" />
                        &nbsp;
                        <b>port:</b>&nbsp;
                        <input type="text" id="load_for_load_balance_port" name="load_for_load_balance_port" class="reward_quantity"/>
                        <label class="field_notice">请输入对内提供load_balancer服务的IP和端口</label>
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
                    <th class="paddingT15">load_balance.xml预览</th>
                    <td class="paddingT15 wordSpacing5" style="height: 650px">
                        <iframe id="framer" name="framer" src="index.php?app=game&act=showGameSet&set_type=load_balancer" width="100%" height="100%" style="overflow:hidden; border:0;" scrolling="no" frameborder="no" scroll="no">
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
        var type = 'load_balancer';
        var l_id = '<?php echo isset($load_balance_host_id) ? $load_balance_host_id : 0;?>';

        $(document).ready(function(){
            // 时间设置
            $('#open_server_time').datetimepicker();

            var status = "<?php echo isset($status) ? $status : '';?>";
            if(status){
                $("#status").val(status);
            }

            var load_for_login_server_ip = "<?php echo isset($load_for_login_server_ip) ? $load_for_login_server_ip : '';?>";
            if(load_for_login_server_ip){
                $("#load_for_login_server_ip").val(load_for_login_server_ip);
            }else{
                $("#load_for_login_server_ip").val('0.0.0.0');
            }

            var load_for_login_server_port = "<?php echo isset($load_for_login_server_port) ? $load_for_login_server_port : '';?>";
            if(load_for_login_server_port){
                $("#load_for_login_server_port").val(load_for_login_server_port);
            }else{
                $("#load_for_login_server_port").val('');
            }

            var load_for_load_balance_ip = "<?php echo isset($load_for_load_balance_ip) ? $load_for_load_balance_ip : '';?>";
            if(load_for_load_balance_ip){
                $("#load_for_load_balance_ip").val(load_for_load_balance_ip);
            }else{
                $("#load_for_load_balance_ip").val('127.0.0.1');
            }

            var load_for_load_balance_port = "<?php echo isset($load_for_load_balance_port) ? $load_for_load_balance_port : '';?>";
            if(load_for_load_balance_port){
                $("#load_for_load_balance_port").val(load_for_load_balance_port);
            }else{
                $("#load_for_load_balance_port").val('');
            }

            var init_show_set_url = '';
            if(load_for_login_server_ip.length != 0){
                init_show_set_url = init_show_set_url + '&load_for_login_server_ip=' +load_for_login_server_ip;
            }
            if(load_for_login_server_port.length != 0){
                init_show_set_url = init_show_set_url + '&load_for_login_server_port=' +load_for_login_server_port;
            }
            if(load_for_load_balance_ip.length != 0){
                init_show_set_url = init_show_set_url + '&load_for_load_balance_ip=' +load_for_load_balance_ip;
            }
            if(load_for_load_balance_port.length != 0){
                init_show_set_url = init_show_set_url + '&load_for_load_balance_port=' +load_for_load_balance_port;
            }
            var showSetUrl = 'index.php?app=game&act=showGameSet&set_type='+type+init_show_set_url;
            $("#framer").attr("src",showSetUrl);

            $("tr[rel='equip'] input").blur(function(){
                var load_for_login_server_ip = $("#load_for_login_server_ip").val()
                var load_for_login_server_port = $("#load_for_login_server_port").val()
                var load_for_load_balance_ip = $("#load_for_load_balance_ip").val()
                var load_for_load_balance_port = $("#load_for_load_balance_port").val()
                var urlSet = '';
                if(load_for_login_server_ip.length != 0){
                    urlSet = urlSet + '&load_for_login_server_ip=' +load_for_login_server_ip;
                }
                if(load_for_login_server_port.length != 0){
                    urlSet = urlSet + '&load_for_login_server_port=' +load_for_login_server_port;
                }
                if(load_for_load_balance_ip.length != 0){
                    urlSet = urlSet + '&load_for_load_balance_ip=' +load_for_load_balance_ip;
                }
                if(load_for_load_balance_port.length != 0){
                    urlSet = urlSet + '&load_for_load_balance_port=' +load_for_load_balance_port;
                }
                var showSetUrl = 'index.php?app=game&act=showGameSet&set_type='+type+urlSet;
                $("#framer").attr("src",showSetUrl);
            })

            //load_balance_host_id 的排重

            //同一机器下 是否部署多个 load_balance_host 的排重
        });

        var validateOption = {
            onkeyup:false,
            rules:{
                'load_balance_host_id':{
                    required:true,
                    remote: {
                        url:'index.php?app=game&act=ajaxCheckHostId',
                        type:'post',
                        data:{
                            host_id:function(){
                                return $("#load_balance_host_id").val();
                            },
                            id:'<?php echo isset($id) ? $id : 0;?>',
                            type:type
                        }
                    }
                },
                server_id:{
                    required:true,
                    remote: {
                        url:'index.php?app=game&act=ajaxCheckServerSingle',
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
                load_for_login_server_ip:{
                    required:true
                },
                load_for_login_server_port:{
                    required:true
                },
                load_for_load_balance_ip:{
                    required:true
                },
                load_for_load_balance_port:{
                    required:true
                }
            },
            messages:{
                'load_balance_host_id':{
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
                load_for_login_server_ip:{
                    required:'请输入'
                },
                load_for_login_server_port:{
                    required:'请输入'
                },
                load_for_load_balance_ip:{
                    required:'请输入'
                },
                load_for_load_balance_port:{
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