<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<link rel="stylesheet" href="./css/login.css">
<body>
    <div id="head">
        <a href="/" id="return">←</a>
        <span>登录</span>
        <a href="regist" id="regist">注册</a>
    </div>
    <div id="logoimg">
        <img src="./images/logo.png" alt="" id="logo">
        <span>爱尚音乐</span>
    </div>
    <div id="loginform">
        <form action="login_pro" method="post">
            @if(isset($error))
                <span id='ts' style="font-size: 43px;color: red;padding-left: 240px;">{{$error}}</span>
                @else
                <span id='ts' style="font-size: 43px;color: red;padding-left: 240px;display: none"></span>
                @endif
            <p><input type="text" id="user" name="username" placeholder="&nbsp;&nbsp;请输入手机号" value="{{ $user or '' }}"></p>
            <p><input type="password" id="pwd" name="password" placeholder="&nbsp;&nbsp;请输入密码"></p>
            <input type="submit" id="sbt" value="登录">
        </form>
    </div>
    <div id="auto">
    <span >其他登录方式</span>
    </div>
    <ul id="automethod">

        <li><a href="#"><img src="./images/taobao.png" alt=""></a></li>
        <li><a href="https://api.weibo.com/oauth2/authorize?client_id={{Config::get('web.sinaAppkey')}}&redirect_uri={{Config::get('web.sinacallback')}}&display={{Config::get('web.sinamethod')}}"><img src="./images/weibo.png" alt=""></a></li>
        <li><a href="https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id={{Config::get('web.qqAppid')}}&redirect_uri={{Config::get('web.qqcallback')}}&display={{Config::get('web.mobile')}}&state=test"><img src="./images/qq.png" alt="""></a></li>
    </ul>
</body>
</html>
<script src="./js/jquery.1.12.min.js"></script>
<script>
    $("#sbt").click(function()
    {
        var user = $("#user").val();
        var pwd = $("#pwd").val();
        if(user == '')
        {
            $("#ts").html('请输入用户名');
            $("#ts").show();
            return false;
        }
        if(pwd == '')
        {
            $("#ts").html('请输入密码');
            $("#ts").show();
            return false;
        }
        if(!IsTel(user))
        {
            $("#ts").html('请输入正确的用户名');
            $("#ts").show();
            return false;
        }
    })
    function IsTel(Tel){
        var re=new RegExp(/^((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)$/);
        var retu=Tel.match(re);
        if(retu){
            return true;
        }else{
            return false;
        }
    }
</script>