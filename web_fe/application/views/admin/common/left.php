<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $lang['manage_page'] ?></title>
    <script src="/public/admin/js/prototype.lite.js" type="text/javascript"></script>
    <script src="/public/admin/js/moo.fx.js" type="text/javascript"></script>
    <script src="/public/admin/js/moo.fx.pack.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/public/admin/css/admin_left.css"/>
</head>
<body>


<table width="100%" height="280" border="0" cellpadding="0" cellspacing="0" bgcolor="#EEF2FB">
    <tr>
        <td width="182" valign="top">
            <div id="container">
                <h1 class="type"><a href="javascript:void(0)"><?php echo $lang['host_manage'] ?></a></h1>
                <div class="content">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="/public/admin/images/menu_topline.gif" width="182" height="5"/></td>
                        </tr>
                    </table>
                    <ul class="MM" rel="0">
                        <li><a class="refreshLink" href="index.php?app=server&act=structure" target="main"><?php echo $lang['structural']?></a></li>
                        <li><a class="refreshLink" href="index.php?app=server&act=platform" target="main"><?php echo $lang['plat_list']?></a></li>
                        <li><a class="refreshLink" href="index.php?app=server" target="main"><?php echo $lang['host_list']?></a></li>
                    </ul>
                </div>

                <h1 class="type"><a href="javascript:void(0)"><?php echo $lang['game_set']?></a></h1>
                <div class="content">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="/public/admin/images/menu_topline.gif" width="182" height="5"/></td>
                        </tr>
                    </table>
                    <ul class="MM" rel="1">
                        <li><a class="refreshLink"  href="index.php?app=game&act=loadBalanceSetList" target="main"><?php echo $lang['loadBalance_set']?></a></li>
                        <li><a class="refreshLink"  href="index.php?app=game&act=imServerSetList" target="main"><?php echo $lang['imServer_set']?></a></li>
                        <li><a class="refreshLink"  href="index.php?app=game&act=battleBalanceSetList" target="main"><?php echo $lang['battleBalance_set']?></a></li>
                        <li><a class="refreshLink"  href="index.php?app=game&act=battleSetList" target="main"><?php echo $lang['battle_set']?></a></li>
                        <li><a class="refreshLink"  href="index.php?app=game&act=BattleStrongholdSetList" target="main">Stronghold配置</a></li>
                        <li><a class="refreshLink"  href="index.php?app=game&act=gameServerSetList" target="main"><?php echo $lang['gameServer_set']?></a></li>
                        <!--                        <li><a class="refreshLink"  href="index.php?app=game&act=push" target="main">--><?php //echo $lang['push_msg']?><!--</a></li>-->
<!--                        <li><a class="refreshLink" href="index.php?app=game&act=notice" target="main">--><?php //echo $lang['game_notice']?><!--</a></li>-->
<!--                        <li><a class="refreshLink" href="index.php?app=game&act=event" target="main">--><?php //echo $lang['event_release']?><!--</a></li>-->
                        <!--                        <li><a href="index.php?app=game&act=events" target="main">活动发布</a></li>-->
                        <!--                        <li><a href="index.php?app=game&act=server" target="main">开服信息</a></li>-->
                    </ul>
                </div>

                <h1 class="type" <?php $cores=$this->session->userdata('currentUserRole');echo $cores['role_info']['role_source'] ? 'style="display:none"' : '';?>>
                    <a href="javascript:void(0)"><?php echo $lang['system_set']?></a></h1>
                <div class="content" <?php echo $cores['role_info']['role_source'] ? 'style="display:none"' : '';?>>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="/public/admin/images/menu_topline.gif" width="182" height="5"/></td>
                        </tr>
                    </table>
                    <ul class="MM" rel="7">
                        <li><a href="index.php?app=admin&act=role" class="refreshLink" target="main"><?php echo $lang['role_manage']?></a></li>
                        <li><a href="index.php?app=admin&act=index" class="refreshLink" target="main"><?php echo $lang['user_list']?></a></li>
                        <li><a href="index.php?app=admin&act=addAdmin" class="refreshLink" target="main"><?php echo $lang['add_user']?></a></li>
                        <li><a href="index.php?app=admin&act=permitAction" class="refreshLink" target="main"><?php echo $lang['control_list']?></a></li>
                    </ul>
                </div>
            </div>
            </div>

            <script type="text/javascript">
                var position = '<?php echo isset($refreshLink['position']) ? $refreshLink['position']:0?>';
                var contents = document.getElementsByClassName('content');
                var toggles = document.getElementsByClassName('type');
                var myAccordion = new fx.Accordion(
                    toggles, contents, {opacity: true, duration: 400}
                );
                myAccordion.showThisHideOpen(contents[position]);
            </script>
        </td>
    </tr>
</table>
</body>
<script type="text/javascript" src="/public/js/jquery-1.8.2.js"></script>
<script>
    $(document).ready(function(){
        $("li a[class='refreshLink']").click(function(){
            var refreshLink = {};
            refreshLink.url = 'index.php?app=welcome&act=refreshLink';
            refreshLink.dataType = 'JSON';
            refreshLink.async = false;
            refreshLink.type='GET';
            refreshLink.data={refreshLink:$(this).attr('href'),position:$(this).parent().parent().attr('rel')};
            refreshLink.success = function(response){
                //window.parent.location.reload();
            };
            $.ajax(refreshLink);
        });
    });
</script>
</html>