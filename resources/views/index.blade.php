<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>爱尚music  首页</title>
    <link rel="stylesheet" type="text/css" href="css/mdialog.css">
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/mdialog.js"></script >

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link href="css/index.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script type="text/javascript" src="http://down.hovertree.com/jquery/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://hovertree.com/texiao/jqimg/4/js/jquery.SuperSlide.js"></script>
    <style type="text/css">
        input {
            margin: 100px auto;
        }

        input[type="button"] {
            padding: 15px 25px;

        }
	.head1 a{
            color:#f0f9fe;
            text-decoration:none;
        }
        a{
            color: #001217;
            text-decoration:none;
        }
        /*轮播图样式 from hhj*/
        .num{
            margin-left: 120px;
        }
        .num a{
            color: white;
            font-size: 34px;
        }
        .num li{
            border-radius: 24px;
            background: none;
            margin: 0 -10px 0;
        }
        .num .on a{
            color: orange;
        }
    </style>
</head>
<body>
<!-- 遮罩层 -->
<div id="fade1" class="black_overlay"></div>
<div id="MyDiv1" class="white_content">
    <div class="white_d">
        <div class="notice_t">
        </div>
        <div class="notice_c">
            <table border="0" align="center" style="margin-top:;" cellspacing="0" cellpadding="0">
                <tr valign="top">
                    <td width="60"><br><img src="images/suc.png" /></td>
                    <td>
                        <br><span style="color:red; font-size:50px;">歌曲已成功添加到列表</span><br /><br>
                    </td>
                </tr>
                <tr height="50" valign="bottom">
                    <td>&nbsp;</td>
                    <td><a href="listen" class="b_sure" >查看播放列表</a><a href="#" class="b_buy">继续点歌</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<br>

<div class="head1" style="margin-top:-23px;">
    <span id="tou" style="margin-top: 8px;"><img src="./images/1.png" alt="" width='60px' height='60px'/></span>
    <span id='tou2'>
        <a href="mine_index">我的</a>&nbsp;&nbsp;&nbsp;
        <a href="index">推荐</a>&nbsp;&nbsp;&nbsp;
        <a href="article">发现</a>
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

@include('public.nav')

<div class="focusBox">
    <ul class="pic" >
        @foreach ($car_data as $key => $val)
            <li><a href="javascript:void(0)" target="_blank"><img src="http://admin.daphp.top/instyle/images/carousel/{{$val['car_file']}} "></a></li>
        @endforeach
    </ul>
    <!-- <div class="txt-bg"></div> -->
    <ul class="num">
        <li class=" "><a>●</a><span></span></li>
        <li class=" "><a>●</a><span></span></li>
        <li class=" on"><a>●</a><span></span></li>
        <li class=" "><a>●</a><span></span></li>
    </ul>
</div>
<div class="category">
    <ul>
        <li><a href="quality"><img src="./images/like.png" width="70rem" height="70rem"/></a></li>
        <li>猜你喜欢</li>
    </ul>
    <ul>
        <li><a href="rank_lisk?ifid=2"><img src="./images/hot.png" width="70rem" height="70rem"/></a></li>
        <li>最新最热</li>
    </ul>
    <ul>
        <li><a href="rank_index"><img src="./images/jingxuan.png" width="70rem" height="70rem"/></a></li>
        <li>排行榜</li>
    </ul>
    <ul>
        <li><img src="./images/listen.png" width="70rem" height="70rem"/></li>
        <li>听歌识取</li>
    </ul>
</div>
<div class="tuijian">
    <p><span id="more">更多</span>为你推荐</p>
    @foreach($topList as $k=>$v)
        <div class='song' attr='{{ $v->music_id }}'>
            <img src="http://admin.daphp.top{{ $v->music_img }}" alt="" width='300px' height='250px'/>
            <span class="songname">{{ $v->music_name }}</span>
        </div>
    @endforeach
</div>
<div class="newsong">
    <p><span id="newmore">更多</span>新碟首发</p>
    @foreach($hotList as $k=>$v)
        <div class='song' attr='{{ $v->music_id }}'>
            <img src="http://admin.daphp.top{{ $v->music_img }}" alt="" width='300px' height='250px'  />
            <span  class="songname">{{ $v->music_name }}</span>
        </div>
    @endforeach
</div>
<div class="zhuanti">
    <p><span><a href="{{URL('/ac_index')}}">更多</a></span>歌手</p>
    <div class="zhuanti1">
        <a href="{{URL('/ac_index')}}"><img src="./images/aaa33.jpg" alt=""/></a>
    </div>
</div>

<div class="zhuanti">
    <p><span>更多</span>专题</p>
    <div class="zhuanti1">
       <a href="article"> <img src="./images/2.jpg" alt=""/></a>
    </div>
</div>

<script type="text/javascript">
    jQuery(".focusBox").slide({ titCell:".num li", mainCell:".pic",effect:"fold", autoPlay:true,trigger:"click",startFun:function(i){jQuery(".focusBox .txt li").eq(i).animate({"bottom":0}).siblings().animate({"bottom":-36});}});
</script>

<script type="text/javascript">
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
    $(".song").click(function()
    {
        var music_id = $(this).attr('attr');
        $.ajax({
            type: "POST",
            url: "joinlisten",
            data: "music_id="+music_id+"&_token={{ csrf_token() }}",
            // dataType:'json',
            success: function(msg){
                $("#MyDiv1").show();
                $("#fade1").show();
            }
        });
    })
    $(".b_buy").click(function()
    {
        $("#MyDiv1").hide();
        $("#fade1").hide();
    })
</script>

</body>
</html>
