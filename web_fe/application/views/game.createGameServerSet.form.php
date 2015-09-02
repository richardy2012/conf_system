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
            <li><a class="btnS"
           href="index.php?app=game&act=gameServerSetList">Game_server服务列表</a></li>
        </ul>
        <p>添加Game_server服务</p>
    </div>

    <!--form表单开始-->
    <div class="info" style="height: auto">
        <form method="POST" enctype="multipart/form-data" id="form">
            <table class="infoTable" style="height: auto">

                <tr rel_data="TOP">
                    <th  class="paddingT15"> GameServer服务编号:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="game_server_host_id"
                               type="text"name="game_server_host_id"
                               value="<?php echo isset($game_server_host_id) ? $game_server_host_id : '';?>" />
                        <label class="field_notice">填入game服务器的编号</label>
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

                <tr>
                    <th class="paddingT15">选择Load_balance负载支撑:</th>
                    <td class="paddingT15 wordSpacing5">
                        <select style="width: 157px" id="load_balance_host_id_support" name="load_balance_host_id_support">
                            <?php foreach($load_balance_hosts as $key => $val):?>
                                <option server_data="<?php echo $val['server_id'];?>" value="<?php echo $val['load_balance_host_id'];?>">
                                    <?php echo $val['load_balance_host_id'];?></option>
                            <?php endforeach;?>
                        </select>
                        <label class="field_notice">请选择Load_balance负载支撑</label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15">选择Battle_balancer负载支撑:</th>
                    <td class="paddingT15 wordSpacing5">
                        <select style="width: 157px" id="battle_balance_host_id_support" name="battle_balance_host_id_support">
                            <?php foreach($battle_balance_hosts as $key => $val):?>
                                <option server_data="<?php echo $val['server_id'];?>" value="<?php echo $val['battle_balance_host_id'];?>">
                                    <?php echo $val['battle_balance_host_id'];?></option>
                            <?php endforeach;?>
                        </select>
                        <label class="field_notice">请选择Battle_balancer负载支撑</label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15">选择IM_server聊天服务支撑:</th>
                    <td class="paddingT15 wordSpacing5">
                        <select style="width: 157px" id="im_server_host_id_support" name="im_server_host_id_support">
                            <?php foreach($im_server_hosts as $key => $val):?>
                                <option server_data="<?php echo $val['server_id'];?>" value="<?php echo $val['im_server_host_id'];?>"><?php echo $val['im_server_host_id'];?></option>
                            <?php endforeach;?>
                        </select>
                        <label class="field_notice">请选择IM_server聊天服务支撑</label>
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
                    <th class="paddingT15">对外game_server服务：</th>
                    <td class="paddingT15 wordSpacing5 iparent">
                        <b>ip:</b>
                        <input type="text" id="game_server_ip" name="game_server_ip" class="reward_item" />
                        &nbsp;
                        <b>port:</b>&nbsp;
                        <input type="text" id="game_server_port" name="game_server_port" class="reward_quantity"/>
                        <label class="field_notice">请输入对外提供game_server服务的IP和端口</label>
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
                    <th class="paddingT15">game_server.xml预览</th>
                    <td class="paddingT15 wordSpacing5" style="height: 650px">
                        <iframe id="framer" name="framer" src="index.php?app=game&act=showGameSet&set_type=game_server" width="100%" height="100%" style="overflow:hidden; border:0;" scrolling="no" frameborder="no" scroll="no">
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
        var type = 'game_server';
        var l_id = '<?php echo isset($game_server_host_id) ? $game_server_host_id : 0;?>';

        $(document).ready(function(){
            // 时间设置
            $('#open_server_time').datetimepicker();

            var server_id = "<?php echo isset($server_id) ? $server_id : '';?>";
            if(server_id){
                $("#server_id").val(server_id);
            }

            var status = "<?php echo isset($status) ? $status : '';?>";
            if(status){
                $("#status").val(status);
            }

            var load_balance_host_id_support = "<?php echo isset($load_balance_host_id_support) ? $load_balance_host_id_support : '';?>";
            if(load_balance_host_id_support){
                $("#load_balance_host_id_support").val(load_balance_host_id_support);
            }

            var battle_balance_host_id_support = "<?php echo isset($battle_balance_host_id_support) ? $battle_balance_host_id_support : '';?>";
            if(battle_balance_host_id_support){
                $("#battle_balance_host_id_support").val(battle_balance_host_id_support);
            }

            var im_server_host_id_support = "<?php echo isset($im_server_host_id_support) ? $im_server_host_id_support : '';?>";
            if(im_server_host_id_support){
                $("#im_server_host_id_support").val(im_server_host_id_support);
            }

            var game_server_ip = "<?php echo isset($game_server_ip) ? $game_server_ip : '';?>";
            if(game_server_ip){
                $("#game_server_ip").val(game_server_ip);
            }else{
                $("#game_server_ip").val('0.0.0.0');
            }

            var game_server_port = "<?php echo isset($game_server_port) ? $game_server_port : '';?>";
            if(game_server_port){
                $("#game_server_port").val(game_server_port);
            }else{
                $("#game_server_port").val('');
            }

            var init_show_set_url = '';
            var game_server_host_id = l_id;


            if(game_server_host_id.length != 0){
                init_show_set_url = init_show_set_url + '&game_server_host_id=' +game_server_host_id;
            }

            if(server_id.length != 0){
                init_show_set_url = init_show_set_url + '&server_id=' +server_id;
            }

            if(game_server_ip.length != 0){
                init_show_set_url = init_show_set_url + '&game_server_ip=' +game_server_ip;
            }

            if(game_server_port.length != 0){
                init_show_set_url = init_show_set_url + '&game_server_port=' +game_server_port;
            }

            if(load_balance_host_id_support.length != 0){
                init_show_set_url = init_show_set_url + '&load_balance_host_id_support=' +load_balance_host_id_support;
            }

            if(battle_balance_host_id_support.length != 0){
                init_show_set_url = init_show_set_url + '&battle_balance_host_id_support=' +battle_balance_host_id_support;
            }

            if(im_server_host_id_support.length != 0){
                init_show_set_url = init_show_set_url + '&im_server_host_id_support=' +im_server_host_id_support;
            }

            var showSetUrl = 'index.php?app=game&act=showGameSet&set_type='+type+init_show_set_url;
            $("#framer").attr("src",showSetUrl);

            $("#server_id").change(function(){
                var $server_id = $(this).val();
                $("#load_balance_host_id_support").attr("disabled","disabled").find("option[server_data='"+ $server_id +"']").attr("selected",true);
                $("#battle_balance_host_id_support").attr("disabled","disabled").find("option[server_data='"+ $server_id +"']").attr("selected",true);
                $("#im_server_host_id_support").attr("disabled","disabled").find("option[server_data='"+ $server_id +"']").attr("selected",true);
            })


            $("tr[rel='equip'] input").blur(function(){
                var game_server_host_id = $("#game_server_host_id").val()
                var game_server_ip = $("#game_server_ip").val()
                var game_server_port = $("#game_server_port").val()
                var server_id =$("#server_id").val()
                var load_balance_host_id_support =$("#load_balance_host_id_support").val()
                var battle_balance_host_id_support =$("#battle_balance_host_id_support").val()
                var im_server_host_id_support =$("#im_server_host_id_support").val()

                var urlSet = '&set_type=' + type;

                if(server_id.length != 0){
                    urlSet = urlSet + '&server_id=' +server_id;
                }

                if(game_server_ip.length != 0){
                    urlSet = urlSet + '&game_server_ip=' +game_server_ip;
                }

                if(game_server_port.length != 0){
                    urlSet = urlSet + '&game_server_port=' +game_server_port;
                }

                if(game_server_host_id.length != 0){
                    urlSet= urlSet+ '&game_server_host_id=' +game_server_host_id;
                }

                if(load_balance_host_id_support.length != 0){
                    urlSet = urlSet + '&load_balance_host_id_support=' +load_balance_host_id_support;
                }

                if(battle_balance_host_id_support.length != 0){
                    urlSet = urlSet + '&battle_balance_host_id_support=' +battle_balance_host_id_support;
                }

                if(im_server_host_id_support.length != 0){
                    urlSet = urlSet + '&im_server_host_id_support=' +im_server_host_id_support;
                }

                var showSetUrl = 'index.php?app=game&act=showGameSet&set_type='+type+urlSet;
                $("#framer").attr("src",showSetUrl);
            })


            //game_server_host_id 的排重
            //同一机器下 是否部署多个 load_balance_host 的排重
        });

        var validateOption = {
            onkeyup:false,
            rules:{
                'game_server_host_id':{
                    required:true,
                    remote: {
                        url:'index.php?app=game&act=ajaxCheckHostId',
                        type:'post',
                        data:{
                            host_id:function(){
                                return $("#game_server_host_id").val();
                            },
                            id:'<?php echo isset($id) ? $id : 0;?>',
                            type:type
                        }
                    }
                },
                server_id:{
                    required:true

                },
                open_server_time:{
                    required:true
                },
                load_balance_host_id_support:{
                    required:true
                },
                battle_balance_host_id_support:{
                    required:true
                },
                im_server_host_id_support:{
                    required:true
                },
                game_server_ip:{
                    required:true
                },
                game_server_port:{
                    required:true
                }
            },
            messages:{
                'game_server_host_id':{
                    required:'请输入',
                    remote:'编号不能重复'
                },
                server_id:{
                    required:'请选择'
                },
                open_server_time:{
                    required:'请输入'
                },
                load_balance_host_id_support:{
                    required:'请输入'
                },
                battle_balance_host_id_support:{
                    required:'请输入'
                },
                im_server_host_id_support:{
                    required:'请输入'
                },
                game_server_ip:{
                    required:'请输入'
                },
                game_server_port:{
                    required:'请输入'
                }
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent());
            },

            submitHandler:function(form){
                $("#load_balance_host_id_support").removeAttr("disabled");
                $("#battle_balance_host_id_support").removeAttr("disabled");
                $("#im_server_host_id_support").removeAttr("disabled");
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