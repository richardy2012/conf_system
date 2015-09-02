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
            <li><a class="btnS" href="index.php?app=game&act=imServerSetList">IM_server负载列表</a></li>
        </ul>
        <p>添加IM_server负载</p>
    </div>

    <!--form表单开始-->
    <div class="info" style="height: auto">
        <form method="POST" enctype="multipart/form-data" id="form">
            <table class="infoTable" style="height: auto">

                <tr rel_data="TOP">
                    <th  class="paddingT15"> IM Server负载编号:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="im_server_host_id" type="text"name="im_server_host_id"
                               value="<?php echo isset($im_server_host_id) ? $im_server_host_id : '';?>" />
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
                    <th class="paddingT15">对外网im_server服务：</th>
                    <td class="paddingT15 wordSpacing5 iparent">
                        <b>ip:</b>
                        <input type="text" id="server_im_server_ip" name="server_im_server_ip" class="reward_item" />
                        &nbsp;
                        <b>port:</b>&nbsp;
                        <input type="text" id="server_im_server_port" name="server_im_server_port" class="reward_quantity"/>
                        <label class="field_notice">请输入对外提供im_server服务的IP和端口</label>
                    </td>
                </tr>

<!--                <tr rel="equip" >-->
<!--                    <th class="paddingT15">对内网im_master服务：</th>-->
<!--                    <td class="paddingT15 wordSpacing5 iparent">-->
<!--                        <b>ip:</b>-->
<!--                        <input type="text" id="server_im_loginbalancer_ip" name="server_im_loginbalancer_ip" class="reward_item" />-->
<!--                        &nbsp;-->
<!--                        <b>port:</b>&nbsp;-->
<!--                        <input type="text" id="server_im_loginbalancer_port" name="server_im_loginbalancer_port" class="reward_quantity"/>-->
<!--                        <label class="field_notice">请输入对内提供battle_balance服务的IP和端口</label>-->
<!--                    </td>-->
<!--                </tr>-->

                <tr rel="equip" >
                    <th class="paddingT15">对内网login_balance服务：</th>
                    <td class="paddingT15 wordSpacing5 iparent">
                        <b>ip:</b>
                        <input type="text" id="server_im_loginbalancer_ip" name="server_im_loginbalancer_ip" class="reward_item" />
                        &nbsp;
                        <b>port:</b>&nbsp;
                        <input type="text" id="server_im_loginbalancer_port" name="server_im_loginbalancer_port" class="reward_quantity"/>
                        <label class="field_notice">请输入对内提供login_balance服务的IP和端口</label>
                    </td>
                </tr>

                <tr rel="equip" >
                    <th class="paddingT15">im_server的phpservice：</th>
                    <td class="paddingT15 wordSpacing5 iparent">
                        <b>http地址:</b>
                        <input type="text" size="75" id="server_im_phpservice_address" name="server_im_phpservice_address" class="reward_item" />
                        &nbsp;
                        <b>port:</b>&nbsp;
                        <input type="text" id="server_im_phpservice_port" name="server_im_phpservice_port" class="reward_quantity"/>
                        <label class="field_notice">请输入im_server的thrift_phpservice服务的地址和端口</label>
                    </td>
                </tr>

                <tr rel="equip" >
                    <th class="paddingT15">im_server的cppservice：</th>
                    <td class="paddingT15 wordSpacing5 iparent">
                        <b>ip:</b>
                        <input type="text" id="server_im_cppservice_ip" name="server_im_cppservice_ip" class="reward_item" />
                        &nbsp;
                        <b>port:</b>&nbsp;
                        <input type="text" id="server_im_cppservice_port" name="server_im_cppservice_port" class="reward_quantity"/>
                        <label class="field_notice">请输入im_server的thrift_cppservice服务的IP和端口</label>
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
                    <th class="paddingT15">im_server.ini预览</th>
                    <td class="paddingT15 wordSpacing5" style="height: 650px">
                        <iframe id="framer" name="framer" src="index.php?app=game&act=showGameSet&set_type=im_server" width="100%" height="100%" style="overflow:hidden; border:0;" scrolling="no" frameborder="no" scroll="no">
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
        var type = 'im_server';
        var l_id = '<?php echo isset($im_server_host_id) ? $im_server_host_id : 0;?>';
        var id = '<?php echo isset($id) ? $id : 0;?>';

        $(document).ready(function(){
            // 时间设置
            $('#open_server_time').datetimepicker();

            var status = "<?php echo isset($status) ? $status : '';?>";
            if(status){
                $("#status").val(status);
            }

            var server_im_loginbalancer_ip = "<?php echo isset($server_im_loginbalancer_ip) ? $server_im_loginbalancer_ip : '';?>";
            if(server_im_loginbalancer_ip){
                $("#server_im_loginbalancer_ip").val(server_im_loginbalancer_ip);
            }else{
                $("#server_im_loginbalancer_ip").val('127.0.0.1');
            }

            var server_im_loginbalancer_port = "<?php echo isset($server_im_loginbalancer_port) ? $server_im_loginbalancer_port : '';?>";
            if(server_im_loginbalancer_port){
                $("#server_im_loginbalancer_port").val(server_im_loginbalancer_port);
            }else{
                $("#server_im_loginbalancer_port").val('');
            }

            var server_im_server_ip = "<?php echo isset($server_im_server_ip) ? $server_im_server_ip : '';?>";
            if(server_im_server_ip){
                $("#server_im_server_ip").val(server_im_server_ip);
            }else{
                $("#server_im_server_ip").val('0.0.0.0');
            }

            var server_im_server_port = "<?php echo isset($server_im_server_port) ? $server_im_server_port : '';?>";
            if(server_im_server_port){
                $("#server_im_server_port").val(server_im_server_port);
            }else{
                $("#server_im_server_port").val('');
            }

            var server_im_phpservice_address = "<?php echo isset($server_im_phpservice_address) ? $server_im_phpservice_address : '';?>";
            if(server_im_phpservice_address){
                $("#server_im_phpservice_address").val(server_im_phpservice_address);
            }else{
                $("#server_im_phpservice_address").val('http://PHP-SERVER:8784/main.php?stream=');
            }

            var server_im_phpservice_port = "<?php echo isset($server_im_phpservice_port) ? $server_im_phpservice_port : '';?>";
            if(server_im_phpservice_port){
                $("#server_im_phpservice_port").val(server_im_phpservice_port);
            }else{
                $("#server_im_phpservice_port").val('9090');
            }

            var server_im_cppservice_ip = "<?php echo isset($server_im_cppservice_ip) ? $server_im_cppservice_ip : '';?>";
            if(server_im_cppservice_ip){
                $("#server_im_cppservice_ip").val(server_im_cppservice_ip);
            }else{
                $("#server_im_cppservice_ip").val('0.0.0.0');
            }

            var server_im_cppservice_port = "<?php echo isset($server_im_cppservice_port) ? $server_im_cppservice_port : '';?>";

            if(server_im_cppservice_port){
                $("#server_im_cppservice_port").val(server_im_cppservice_port);
            }else{
                $("#server_im_cppservice_port").val('');
            }

            var init_show_set_url = '';

            if(server_im_loginbalancer_ip.length != 0){
                init_show_set_url = init_show_set_url + '&server_im_loginbalancer_ip=' +server_im_loginbalancer_ip;
            }

            if(server_im_loginbalancer_port.length != 0){
                init_show_set_url = init_show_set_url + '&server_im_loginbalancer_port=' +server_im_loginbalancer_port;
            }

            if(server_im_server_ip.length != 0){
                init_show_set_url = init_show_set_url + '&server_im_server_ip=' +server_im_server_ip;
            }

            if(server_im_server_port.length != 0){
                init_show_set_url = init_show_set_url + '&server_im_server_port=' +server_im_server_port;
            }

            if(server_im_phpservice_address.length != 0){
                init_show_set_url = init_show_set_url + '&server_im_phpservice_address=' +server_im_phpservice_address;
            }

            if(server_im_phpservice_port.length != 0){
                init_show_set_url = init_show_set_url + '&server_im_phpservice_port=' +server_im_phpservice_port;
            }

            if(server_im_cppservice_ip.length != 0){
                init_show_set_url = init_show_set_url + '&server_im_cppservice_ip=' +server_im_cppservice_ip;
            }

            if(server_im_cppservice_port.length != 0){
                init_show_set_url = init_show_set_url + '&server_im_cppservice_port=' +server_im_cppservice_port;
            }

            if(server_im_server_ip.length != 0){
                init_show_set_url = init_show_set_url + '&server_im_server_ip=' +server_im_server_ip;
            }

            if(server_im_server_port.length != 0){
                init_show_set_url = init_show_set_url + '&server_im_server_port=' +server_im_server_port;
            }

            if(id.length != 0){
                init_show_set_url = init_show_set_url + '&id=' +id;
            }

            var showSetUrl = 'index.php?app=game&act=showGameSet&set_type='+type+init_show_set_url;
            $("#framer").attr("src",showSetUrl);


            $("tr[rel='equip'] input").blur(function(){
                var server_id = $("#server_id").val()
                var server_im_loginbalancer_ip = $("#server_im_loginbalancer_ip").val()
                var server_im_loginbalancer_port = $("#server_im_loginbalancer_port").val()
                var server_im_server_ip = $("#server_im_server_ip").val()
                var server_im_server_port = $("#server_im_server_port").val()


                var server_im_phpservice_address = $("#server_im_phpservice_address").val()
                var server_im_phpservice_port = $("#server_im_phpservice_port").val()
                var server_im_cppservice_ip = $("#server_im_cppservice_ip").val()
                var server_im_cppservice_port= $("#server_im_cppservice_port").val()
                var urlSet = '&set_type=' + type;

                if(server_id.length != 0){
                    urlSet = urlSet + '&server_id=' +server_id;
                }

                if(server_im_loginbalancer_ip.length != 0){
                    urlSet = urlSet + '&server_im_loginbalancer_ip=' +server_im_loginbalancer_ip;
                }

                if(server_im_loginbalancer_port.length != 0){
                    urlSet = urlSet + '&server_im_loginbalancer_port=' +server_im_loginbalancer_port;
                }
                if(server_im_server_ip.length != 0){
                    urlSet = urlSet + '&server_im_server_ip=' +server_im_server_ip;
                }
                if(server_im_server_port.length != 0){
                    urlSet = urlSet + '&server_im_server_port=' +server_im_server_port;
                }

                if(server_im_phpservice_address.length != 0){
                    urlSet = urlSet + '&server_im_phpservice_address=' +server_im_phpservice_address;
                }
                if(server_im_phpservice_port.length != 0){
                    urlSet = urlSet + '&server_im_phpservice_port=' +server_im_phpservice_port;
                }
                if(server_im_cppservice_ip.length != 0){
                    urlSet = urlSet + '&server_im_cppservice_ip=' +server_im_cppservice_ip;
                }
                if(server_im_cppservice_port.length != 0){
                    urlSet = urlSet + '&server_im_cppservice_port=' +server_im_cppservice_port;
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
                'im_server_host_id':{
                    required:true,
                    remote: {
                        url:'index.php?app=game&act=ajaxCheckHostId',
                        type:'post',
                        data:{
                            host_id:function(){
                                return $("#im_server_host_id").val();
                            },
                            id:'<?php echo isset($id) ? $id : 0;?>',
                            type:type
                        }
                    }
                },
                server_id:{
                    required:true,
                    remote: {
                        url:'index.php?app=game&act=ajaxCheckImServerSingle',
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
                server_im_loginbalancer_ip:{
                    required:true
                },
                server_im_loginbalancer_port:{
                    required:true
                },
                server_im_phpservice_address:{
                    required:true
                },
                server_im_phpservice_port:{
                    required:true
                },
                server_im_cppservice_ip:{
                    required:true
                },
                server_im_cppservice_port:{
                    required:true
                },
                server_im_server_ip:{
                    required:true
                },
                server_im_server_port:{
                    required:true
                }
            },
            messages:{
                'im_server_host_id':{
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
                server_im_loginbalancer_ip:{
                    required:'请输入'
                },
                server_im_loginbalancer_port:{
                    required:'请输入'
                },
                server_im_phpservice_address:{
                    required:'请输入'
                },
                server_im_phpservice_port:{
                    required:'请输入'
                },
                server_im_cppservice_ip:{
                    required:'请输入'
                },
                server_im_cppservice_port:{
                    required:'请输入'
                },
                server_im_server_ip:{
                    required:'请输入'
                },
                server_im_server_port:{
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