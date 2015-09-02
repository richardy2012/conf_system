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
            </tr>
            </thead>
<!--            <tbody>-->
<!--                    <tr class="tatr2">-->
<!--                        <td class="firstCell">-->
<!--                        </td>-->
<!--                    </tr>-->
<!--            </tbody>-->
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



        <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<!--        --><?php //if(empty($res)){
//            echo $lang['no_result'];
//        }?>

        <div id="combination" style="height: 1650px"></div>
        <div class="clear"></div>
    </div>

    <!-- ECharts单文件引入 -->
    <script src="/public/js/echart/themes/blue.js"></script>
    <script src="/public/js/echart/echarts-all.js"></script>

    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts图表
//        var myChart = ec.init(document.getElementById('combination'));
        var myChart = echarts.init(document.getElementById('combination'),theme);

        option = {
            title : {
                text: '结构拓扑'
            },
            toolbox: {
                show : true,
                feature : {
                    mark : {show: true},
                    dataView : {show: true, readOnly: false},
                    restore : {show: true},
                    saveAsImage : {show: true}
                }
            },
            series : [
                {
                    name:'树图',
                    type:'tree',
                    orient: 'horizontal',  // vertical horizontal
                    rootLocation: {x: 300,y: 330}, // 根节点位置  {x: 100, y: 'center'}
                    nodePadding: 38,
                    layerPadding: 266,
                    hoverable: false,
                    roam: true,
                    symbolSize: 6,
                    itemStyle: {
                        normal: {
                            color: '#4883b4',
                            label: {
                                show: true,
                                position: 'right',
                                formatter: "{b}",
                                textStyle: {
                                    color: '#000',
                                    fontSize: 5
                                }
                            },
                            lineStyle: {
                                color: '#ccc',
                                type: 'curve' // 'curve'|'broken'|'solid'|'dotted'|'dashed'

                            }
                        },
                        emphasis: {
                            color: '#4883b4',
                            label: {
                                show: false
                            },
                            borderWidth: 0
                        }
                    },

                    data:
                        <?php echo  isset($result) && !empty($result) ? json_encode($result) : json_encode(array())?>
//                        [{"name":"冰桶挑战","children":[{"name":"刘作虎","children":[{"name":"周鸿祎","children":[{"name":"马化腾"},{"name":"徐小平","children":[{"name":"牛文文","children":[{"name":"姚劲波","children":[{"name":"蔡文胜"},{"name":"蔡明"},{"name":"汪小菲"}]},{"name":"杨守彬","children":[{"name":"所有的创业者"},{"name":"所有的投资人"},{"name":"所有的创业服务机构"}]},{"name":"蒲易"}]},{"name":"罗振宇","children":[{"name":"罗辑思维25000名会员"}]},{"name":"黄西"}]},{"name":"黄章"}]},{"name":"罗永浩"},{"name":"刘江峰","children":[{"name":"何刚","children":[{"name":"谢清江"},{"name":"王翔"},{"name":"艾伟"}]},{"name":"王煜磊"}]}]}]}]
                }
            ]
        };

        // 为echarts对象加载数据
        myChart.setOption(option);


    </script>

<?php require("footer.html")?>