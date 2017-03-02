<link rel="stylesheet" type="text/css" href="css/mdialog.css">
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/mdialog.js"></script >
<link href="css/index.css" rel="stylesheet">
<script type="text/javascript" src="http://down.hovertree.com/jquery/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="http://hovertree.com/texiao/jqimg/4/js/jquery.SuperSlide.js"></script>

<div class="head1" style="height: 90px;font-size: 34px;">
    <span id="tou" style="margin-top: 4px;"><img src="./images/1.png" alt="" width='60px' height='60px'/></span>
    <span id='tou2' style="margin-left: 20%;">
        <a href="mine_index" style="color:white">我的</a>&nbsp;&nbsp;&nbsp;
        <a href="index" style="color:white">推荐</a>&nbsp;&nbsp;&nbsp;
        <a href="article" style="color:white">发现</a>
    </span>
    <span id="tou3" style="margin:10px 10px 0 0;float:right;">
        <a href="search">
            <img src="./images/hhj.jpg" alt="搜索" width='60px' height='60px' title="搜索"/>
        </a>
    </span>
</div>
<div id='member'>
    <div style='height:60px;background:#666666'></div>
    <div id='memberHeader'>
        <?php
            session_start();
            $userInfo = isset($_SESSION['userInfo']) ? $_SESSION['userInfo'] : '';
        ?>
        @if($userInfo == '')
            <div id="memimg" style="background-image: url('./images/logo.png')">
            </div>
            <span id='memname' style='color:#000000'><a href="login" style='color:#000000'>登录</a> / <a href="regist" style='color:#000000'>注册</a></span>
        @else
            <div id="memimg" style="background-image:url({{ $userInfo['img'] or './images/logo.png' }})">
            </div>
            <span id='memname' style='color:#000000'>{{ $userInfo['nickname'] }}</span>
        @endif
        <hr>
        @if($userInfo != '')
            <ul id='memyl'>
                <li>
                    累计播放 0
                </li>
                <li>
                    关注  0
                </li>
                <li>
                    粉丝  0
                </li>
            </ul>
        @endif
    </div>
    @if($userInfo != '')
        <div id='memlist'>
            <ul>
                <li><a href="javascript:void(0)" id="qiandao">签到</a></li>
                <li><a href="member">会员中心</a></li>
                <li><a href="mine_favorite">我收藏的</a></li>
                <li><a href="memberindex">个人设置</a></li>
                <li><a href="loginout">退出</a></li>
            </ul>
        </div>
    @endif
</div>
<script>
    $("#qiandao").click(function()
    {

        $.ajax({
            type: "POST",
            url: "qiandao",
            dataType:"json",
            success: function(msg){
                if(msg.status)
                {
                    new TipBox({
                        type: 'success',
                        str: msg.msg,
                        hasBtn: true
                    });
                }else
                {
                    new TipBox({
                        type: 'error',
                        str: msg.msg,
                        hasBtn: true
                    });
                }
            }
        });
    })
    $("#tou").click(function()
    {
        if($("#member").is(":hidden"))
        {
            $("#member").show("slow");
        }else
        {
            $("#member").hide("slow");
        }
    })
</script>