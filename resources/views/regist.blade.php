<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<link rel="stylesheet" href="./css/regist.css">
<body>
    <div id="head">
        <a href="login" id="return">←</a>
        <span>注册</span>
    </div>
    <form action="regist_pro" method="post">
    <input type="text" id="tel" name="telphone" placeholder="&nbsp;&nbsp;请输入手机号" value="{{ $tel or '' }}">
    @if(!isset($error))
            <span id='ts' style="font-size: 43px;color: red;padding-left: 10px;display: none"></span>
        @else
            <span id='ts' style="font-size: 43px;color: red;padding-left: 10px">{{$error}}</span>
        @endif
    <input type="submit" id="sbt" value="下一步">
    </form>
    <span id="footer">注册代表你同意  <a href="#"><<爱尚音乐使用协议和隐私条款>> </a> </span>
</body>
</html>
<script src="./js/jquery.1.12.min.js"></script>
<script type="text/javascript">
    $("#sbt").click(function()
    {
        var tel = $("#tel").val();
        if(tel == '')
        {
            $("#ts").html('');
            $("#ts").html('请输入手机号');
            $("#ts").show();
            return false;
        }
        if(IsTel(tel))
        {

        }else {
            $("#ts").html('');
            $("#ts").html('请输入正确手机号');
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
