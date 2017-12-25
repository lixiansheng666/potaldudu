<?php
/*
 * Template Name:Index
 *
 */
 get_header(); ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/cpts-js.js"></script>



        <div class="container-fluid">
        <div class="row">
        <div class="col-md-12 col-sm-12 text-center" style="padding: 0px;"><img src="<?php echo get_template_directory_uri(); ?>/images/header-bg2.jpg" alt="主页宣传图"></div>
        </div>
        </div>

    <!--Core Services Platform START-->
    <div class="container-fluid" style="background-color: #F2F2F2;">
        <div class="row text-center tt2">
            <div class="col-md-4 col-sm-4 col-xs-12 col-lg-2 tu1 ">
                <a href="#apply"><img src="<?php echo get_template_directory_uri(); ?>/images/ico/agriculture.png" alt="农业应用图标"></a>
                <h4 style="margin-top: 10px;margin-bottom: 0px;">农业管理</h4>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 col-lg-2 tu2 ">
                <a href="#apply"><img src="<?php echo get_template_directory_uri(); ?>/images/ico/heating.png" alt="供热应用图标"></a>
                <h4 style="margin-top: 10px;margin-bottom: 0px;">智慧供热</h4>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 col-lg-2 tu3 ">
                <a href="#apply"><img src="<?php echo get_template_directory_uri(); ?>/images/ico/smart-home.png" alt="家居应用图标"></a>
                <h4 style="margin-top: 10px;margin-bottom: 0px;">智能家居</h4>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 col-lg-2 tu4 ">
                <a href="#apply"><img src="<?php echo get_template_directory_uri(); ?>/images/ico/cold-chain.png" alt="仓储应用图标"></a>
                <h4 style="margin-top: 10px;margin-bottom: 0px;">仓储冷链</h4>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 col-lg-2 tu5 ">
                <a href="#apply"><img src="<?php echo get_template_directory_uri(); ?>/images/ico/Industrial.png" alt="工业应用图标"></a>
                <h4 style="margin-top: 10px;margin-bottom: 0px;">工业监管</h4>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 col-lg-2 tu6 ">
                <a href="#apply"><img src="<?php echo get_template_directory_uri(); ?>/images/ico/medicine.png" alt="医药应用图标"></a>
                <h4 style="margin-top: 10px;margin-bottom: 0px;">医药监管</h4>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid parameter">
            <div class="col-md-12 col-sm-12 text-center" style="margin-top: 40px;"><h1 style="color:#0068b7;margin-bottom: 20px;font-size: 36px;">物联网与大数据的结合  颠覆传统</h1></div>
            <div class="col-md-12 col-sm-12 text-center" style="color:#000000;font-size: 20px">多年物联网及大数据行业经验，让智能感知设备和互联网完美结合，<br/>
                设备通过无线WIFI直接接入物联网大数据云平台，实时采集、监测并上传温度、湿度、<br>光照、震动等多重传感器数据，并可在手机、平板、电脑等多终端进行访问使用。
            </div>
            <div class="col-md-12 col-sm-12 text-center" style="margin-bottom: 40px"> <img src="<?php echo get_template_directory_uri(); ?>/images/connect_3.png" alt="大数据平台连接图"></div>
        </div>
    </div>

    <div class="container-fluid" style="background-color: #F2F2F2;">
        <div class="row text-center" style="padding-bottom:60px;margin-left:-30px;">
            <div class="col-md-12 col-sm-12 text-center" style="margin-top:40px;margin-bottom: 20px;"><h2 style="color:#0068b7;font-size: 36px;">轻松连<sup>&reg;</sup> 系列产品</h2></div>
            <div class="col-lg-2 col-md-2 col-sm-2"></div>
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2 hoverchangecolor">
                <a href="<?php echo home_url();?>/ubibot-ws1/" style="color: #000;"><img src="<?php echo get_template_directory_uri(); ?>/images/ico/ws1.png" alt="系列ws1图标" style="vertical-align:bottom;"><h4>轻松连<sup>&reg;</sup> WS1</h4></a>
                <h4 style="margin-bottom: 0px;">无线WiFi接入/低耗电/温度、湿度、光照、震动等多种传感器数据感知上传</h4>
                </div>
            <div class="col-lg-1 col-md-1 col-sm-1"></div>
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2 hoverchangecolor">
                <a href="<?php echo home_url();?>/ubibot-ws1pro/" style="color: #000;"><img src="<?php echo get_template_directory_uri(); ?>/images/ico/ws1-pro.png" alt="系列ws1-pro图标" style="vertical-align:bottom;"><h4>轻松连<sup>&reg;</sup> WS1 PRO</h4></a>
                <h4 style="margin-bottom: 0px;">无线WiFi、GPRS双接入/5寸高清LCD屏/RS485传感器接口/温度、湿度、光照等多种环境数据记录及无线远程传输</h4>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1"></div>
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2 hoverchangecolor">
                <a  href="<?php echo home_url();?>/big-data-platform/" style="color: #000;"><img src="<?php echo get_template_directory_uri(); ?>/images/ico/big-data-console.png" alt="系列大数据平台图标" style="vertical-align:bottom;"><h4>轻松连<sup>&reg;</sup> 大数据平台</h4></a>
                <h4 style="margin-bottom: 0px;">物联网开放API接口/海量数据存储/智能预警/可视化图形/数据分析/一键导出</h4>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2"></div>
        </div>
    </div>

    <div id="apply" class="container-fluid">
        <div class="row" style="margin-left:-30px;overflow: hidden;">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center slide_cont">
                            <ul>
                                <li style="list-style:none;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center" style="margin-top:40px;margin-bottom: 20px;"><h3 style="color:#0068b7;font-size: 36px;">农业管理中的无线环境数据感知</h3></div>
                                    <div class="col-md-12 col-sm-12 text-center" style="color:#000000;font-size: 20px">通过无线WiFi配置设备，可全方位实时采集并监测农业作物的生长环境，环境参数主要包括农业大棚或园中的温湿度、光照、PH值等。<br/>
                                        充分发挥物联网与大数据技术在农业生产中的应用，有效的帮助客户提高效率、增加收益。
                                    </div>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/bg/agriculture.jpg" alt="农业应用图">
                                </li>
                                <li style="list-style:none;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center" style="margin-top:40px;margin-bottom: 20px;"><h3 style="color:#0068b7;font-size: 36px;">农业管理-养殖，改善生长环境</h3></div>
                                    <div class="col-md-12 col-sm-12 text-center" style="color:#000000;font-size: 20px">全面、实时、透明的掌握整个养殖区域实时温湿度、光照等情况。<br/>
                                        生活生长状态，建立物联网实时传感监测系统，确保各个角落的舒适度，并快速响应其突发事件。
                                    </div>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/bg/cultivation.jpg" alt="养殖应用图">
                                </li>
                                <li style="list-style:none;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center" style="margin-top:40px;margin-bottom: 20px;"><h3 style="color:#0068b7;font-size: 36px;">农业管理-花房中的科学艺术</h3></div>
                                    <div class="col-md-12 col-sm-12 text-center" style="color:#000000;font-size: 20px">一站式智能花房物联网解决方案，引领走进物联网时代的科学养培智能温湿度、光照等环境数据采集及预警，<br/>
                                        通过无线WiFi将采集的数据用于统一的云分析及决策，准确掌握及监控植物生长及健康情况。
                                    </div>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/bg/flowers.jpg" alt="花房应用图">
                                </li>
                                <li style="list-style:none;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center" style="margin-top:40px;margin-bottom: 20px;"><h3 style="color:#0068b7;font-size: 36px;">智慧供热-基于物联网的完整解决方案</h3></div>
                                    <div class="col-md-12 col-sm-12 text-center" style="color:#000000;font-size: 20px">基于物联网技术应用的供热管控一体化平台，<br/>
                                        结合轻松连无线WiFi温湿度记录仪，可实现从热源、换热站、管网到热用户的整个供热系统的远程监控，极大的提高了调度效率。
                                    </div>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/bg/heating.jpg" alt="供热应用图">
                                </li>
                                <li style="list-style:none;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center" style="margin-top:40px;margin-bottom: 20px;"><h3 style="color:#0068b7;font-size: 36px;">智能家居-提供给您放心与全面的物联网监控预警系统</h3></div>
                                    <div class="col-md-12 col-sm-12 text-center" style="color:#000000;font-size: 20px">通过无线WiFi实时远程监测婴儿房内的温湿度及光照情况，并将数据同步至物联网大数据平台中。家人可在任何有无线WiFi环境下通过电脑、<br/>
                                        手机、平板实时关注孩子的健康状况及环境数据。当数据变化超过设定阀值时，系统则可通过多种预警方式提示家人，全方位通过物联网保障您家人的生活及安全。
                                    </div>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/bg/child.jpg" alt="家居应用图">
                                </li>
                                <li style="list-style:none;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center" style="margin-top:40px;margin-bottom: 20px;"><h3 style="color:#0068b7;font-size: 36px;">仓储冷链-仓库管理的智能物联网系统</h3></div>
                                    <div class="col-md-12 col-sm-12 text-center" style="color:#000000;font-size: 20px">传感设备通过无线WiFi与大数据平台进行的的数据传输，可捕捉货物在仓储运输全程中的每一时间点的环境数据变化，<br/>
                                        有效的帮助客户通过温湿度、震动、光照等数据的采集，实时了解及检验衡量物品的损耗程度与监督提供商的服务水平（SLA）。
                                    </div>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/bg/warehouse.jpg" alt="仓库应用图">
                                </li>
                                <li style="list-style:none;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center" style="margin-top:40px;margin-bottom: 20px;"><h3 style="color:#0068b7;font-size: 36px;">仓储冷链-酒窖里的智能物联网传感生态</h3></div>
                                    <div class="col-md-12 col-sm-12 text-center" style="color:#000000;font-size: 20px">部署无线智能感知设备，可实时通过物联网大数据平台监控其温湿度及整体状态，并结合预警功能来保障您的仓储物品质量。<br/>
                                        例如，酒窖里的红酒在下午三时温度升高，但是湿度平稳，属于规则性活动，此类应用极大程度的避免反复去酒窖开箱检查的状况。
                                    </div>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/bg/cellar.png" alt="酒窖应用图">
                                </li>
                                <li style="list-style:none;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center" style="margin-top:40px;margin-bottom: 20px;"><h3 style="color:#0068b7;font-size: 36px;">工业监管-全面高效物联网管控</h3></div>
                                    <div class="col-md-12 col-sm-12 text-center" style="color:#000000;font-size: 20px">提供整体的物联网环境监测与管理方案，无线WiFi实时传输，实现7×24无间断实时记录温湿度、震动、光照等环境数据，<br/>
                                        资产、设备及人员的定位管理，智能化数据分析，可视化图表输出等。
                                    </div>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/bg/industry.jpg" alt="工业应用图">
                                </li>
                                <li style="list-style:none;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center" style="margin-top:40px;margin-bottom: 20px;"><h3 style="color:#0068b7;font-size: 36px;">物联网医药监管，营造利民的放心医疗</h3></div>
                                    <div class="col-md-12 col-sm-12 text-center" style="color:#000000;font-size: 20px">高精度基于物联网环境数据传感检测设备，可通过无线WiFi实时上传药品流通及存储的环境数据。<br/>
                                        遵循GSP标准（药品经营质量管理规范），智能化保障医疗安全的监督与管理。放心医疗，健康他人。
                                    </div>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/bg/medicine.jpg" alt="医药应用图">
                                </li>
                            </ul>
                            <div class="col-lg-1 col-md-2 col-sm-2 slide_point">
                                <p class="point1 cur_point">农业管理-大棚</p>
                                <p class="point6">农业管理-养殖</p>
                                <p class="point7">农业管理-花房</p>
                                <p class="point2">智慧供热</p>
                                <p class="point3">智能家居</p>
                                <p class="point4">仓储冷链-仓库</p>
                                <p class="point5">仓储冷链-酒窖</p>
                                <p class="point5">工业监管</p>
                                <p class="point5">医药监管</p>
                            </div>
                        </div>

        </div>
    </div>



    <!--qq聊天代码部分begin-->
    <div class="izl-rmenu">
        <a class="consult" target="_blank"><div class="phone" style="display:none;">0592-1234567</div></a>
        <a class="cart"><div class="pic"></div></a>
        <a href="javascript:void(0)" class="btn_top" style="display: block;"></a>
    </div>
    <a target="_blank"  href="http://wpa.qq.com/msgrd?v=3&uin=123456&site=qq&menu=yes" id="udesk-feedback-tab" class="udesk-feedback-tab-left" style="display: block; background-color: black;"></a>
    <!--qq聊天代码部分end-->
<!--Core Services Platform end-->

    <div class="container-fluid" style="background-color: #F2F2F2;">
        <div class="row text-center" style="padding: 60px 0px">
            <div class="col-lg-3 col-md-2 col-sm-2"></div>
            <div class="col-md-3 col-lg-2 col-sm-3 col-xs-2 hoverchangecolor">
                <div class="">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/count_save.png" alt="感知数据存储量">
                    <p class="count-text total" style="font-size: 120%;"><span class="t_num"></span><span class="t_num_text" style="font-size: 20px;font-weight: normal;">加载中...</span></p>
                    <h5 class="count-text ">感知数据存储量</h5>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2"></div>
            <div class="col-md-3 col-lg-2 col-sm-3 col-xs-2 hoverchangecolor">
                <div class="">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/count_serve.png" alt="准确稳定数据服务">
                    <p class="count-text total" style="font-size: 120%;"><span class="t_num2"></span><span class="t_num_text2" style="font-size: 20px;font-weight: normal;">加载中...</span></p>
                    <h5 class="count-text ">准确稳定数据服务</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-sm-2"></div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row-fluid parameter">
            <div class="col-md-12 col-sm-12 text-center" style="margin-top: 40px;"><h1 style="color:#0068b7;margin-bottom: 20px">遍布全球的物联网感知科技</h1></div>
            <div class="col-md-12 col-sm-12 text-center" style="color:#000000;font-size: 20px">轻松连无线感知产品已遍布中国、欧洲、非洲等国家，覆盖多达18个省市。<br/>
                持续增长的物联网大数据市场覆盖率让轻松连与您国际化同行。
            </div>
            <div class="col-md-12 col-sm-12 text-center" style="margin-bottom: 60px"> <img src="<?php echo get_template_directory_uri(); ?>/images/world.png" alt="产品分布图"></div>
        </div>
    </div>


    <div class="container-fluid" style="background-color: #F2F2F2;">
        <div class="row-fluid parameter">
            <div class="col-md-12 col-sm-12 text-center" style="margin-top: 40px;"><h2 style="color:#0068b7;margin-bottom: 20px;font-size: 36px;">合作共赢</h2></div>
            <div class="col-md-12 col-sm-12 text-center" style="color:#000000;font-size: 20px">我们致力于为客户提供一站式的物联网智能硬件解决方案，<br/>
                现已为全球多家企业及科研院所提供个性化的物联网智能硬件和大数据平台服务。
            </div>
    </div>
    </div>
        <div class="text-center" style="background-color: #F2F2F2;"> <img src="<?php echo get_template_directory_uri(); ?>/images/partners.png" alt="合作伙伴图"></div>

    <div class="floating_ck">
        <dl>
            <dt></dt>
            <dd class="consult">

                <div class="floating_left">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <p>在线客服</p>
                    <p style="margin-bottom: 5px"><img src="<?php echo get_template_directory_uri(); ?>/images/ico/zxicon.png" alt="在线客服" style="width: 25px;height:25px">在线客服</p>
                    <p>工作日<br/>8：30~17：30</p>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <p>客服热线</p>
                    <p><b>0411-86686675</b></p>
                    <p>工作日<br/>8：30~17：30</p>
                     </div>
                </div>
            </dd>

            <dd class="qrcord">

                <div class="floating_left floating_ewm" style="width: 180px;left: -183px">
                    <i></i>
                    <p class="qrcord_p01">关注“轻松连”微信<br>获取最新资讯及帮助</p>

                </div>
            </dd>
            <dd class="return" onClick="gotoTop();return false;">
            </dd>
        </dl>
    </div>
<!--Our Partners end-->

<?php get_footer(); ?>


<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/animateBackground-plugin.js"></script>
<script type="text/javascript">
    $(function () {
        getdata();
        setInterval('getdata()', 60000);
        setInterval('test()', 3000);
    });

    var lastobjects = 0;
    var lastrequests = 0;
    var nimusobjects = 0;
    var nimusrequests = 0;
    var nowobjects = 0;
    var nowrequests = 0;
    var test123 = 0;
    var test5 = 0;

    function getdata() {
        $.ajax({
            url: '//api.ubibot.cn/getOverallStats',
            type: 'GET',
            dataType: "json",
            cache: false,
            error: function () {
                //alert("请求失败");
            },
            success: function (data) {
                //console.log(data.requests);
//                show_num(data.objects);
//                show_num2(data.requests);
//                console.log(start);
                if(test5 == 4){
                    test5 = 0;
                }
                if(test5 == 0){
                    if(nowobjects == 0){
                        nowobjects = 0.9 * data.objects;
                    }
                    lastobjects = nowobjects;
                    nimusobjects = (data.objects - nowobjects) / 300;
                    nowobjects = data.objects;
                }
                test5++;
                if(nowrequests == 0){
                    nowrequests = 0.9 * data.requests;
                }
                    lastrequests = nowrequests;
                    nimusrequests = (data.requests - nowrequests) / 60;
                    nowrequests = data.requests;
                    test123 = 0;

                //console.log(nimusobjects, nimusrequests);
            }
        });
    }

    function test(){
        show_num(parseInt(parseFloat(lastobjects) + (test5 * 60 + test123) * parseFloat(nimusobjects)));
        show_num2(parseInt(parseFloat(lastrequests) + test123 * parseFloat(nimusrequests)));
        test123++;
    }

    function show_num(n) {
        var it = $(".t_num i");
        var len = String(n).length;
        for (var i = 0; i < len; i++) {
            if (it.length <= i) {
                $(".t_num").append("<i></i>");
            }
            var num = String(n).charAt(i);
            var y = -parseInt(num) * 30;
            var obj = $(".t_num i").eq(i);
            obj.animate({
                    backgroundPosition: '(0 ' + String(y) + 'px)'
                }, 'slow', 'swing', function () { }
            );
        }
        $(".t_num_text").text("条");
        $(".t_num_text").append("<sup>+</sup>");
        //$("#cur_num").val(n);
    }
    function show_num2(n) {
        var it = $(".t_num2 i");
        var len = String(n).length;
        for (var i = 0; i < len; i++) {
            if (it.length <= i) {
                $(".t_num2").append("<i></i>");
            }
            var num = String(n).charAt(i);
            var y = -parseInt(num) * 30;
            var obj = $(".t_num2 i").eq(i);
            obj.animate({
                    backgroundPosition: '(0 ' + String(y) + 'px)'
                }, 'slow', 'swing', function () { }
            );
        }
        $(".t_num_text2").text("次");
        $(".t_num_text2").append("<sup>+</sup>");
        //$("#cur_num").val(n);
    }
</script>