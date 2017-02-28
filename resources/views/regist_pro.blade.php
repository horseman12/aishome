<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<link rel="stylesheet" href="./css/regist2.css">
<body>
    <div id="head">
        <a href="regist" id="return">←</a>
        <span>注册</span>
    </div>
    <span id="ts">你会收到一条带验证的短信</span><br>
    <form action="regist_suc"  method="post">
        <input type="text" id="capth" name="capth" placeholder="&nbsp;&nbsp;请输入验证码">
        <input type="password" id="password" name="password" placeholder="&nbsp;&nbsp;请设置密码,6-12位、英文、符号">
        <input type="text" id="nick_name" name="nickname" placeholder="&nbsp;&nbsp;请输入昵称">
        @if(isset($error))
            <span style="font-size: 43px;color: red;padding-left: 10px; ">{{$error}}</span>
            @else
            <span style="font-size: 43px;color: red;padding-left: 10px;display: none"></span>
        @endif
        <input type="submit" value="提交" id="sbt">
    </form>
</body>
</html>

