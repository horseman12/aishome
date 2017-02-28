<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta charset="UTF-8">
    <title>个人中心</title>
    <link rel="stylesheet" href="./css/memberindex.css">
</head>
<body>
    <div id="header">
        <a href="/" id="return">←</a>
        <span>个人中心</span>
    </div>
    <ul id="list">
        <li id="changeimg">头像
        @if($userInfo->img != '')
                <div id="img" style="background-image: url(<?php echo $userInfo->img?>)"></div>
            @else
                <div id="img" style="background-image: url('./images/yiren.gif')"></div>
            @endif
        </li>
        <li id="nick">昵称
            @if($userInfo->nickname !='')
                <span class="show"><?php echo $userInfo->nickname?></span>
                @else
                <span class="show">暂无设置</span>
            @endif
        </li>
        <li>性别
            @if($userInfo->sex !='')
            <span class="show"><?php echo $userInfo->sex?></span>
            @else
                <span class="show">暂无设置</span>
            @endif
        </li>
        <li>出生年月
            @if($userInfo->year != '' && $userInfo->month !='' && $userInfo->day != '')
                <span class="show"><?php echo $userInfo->year?>年<?php echo $userInfo->month?>月<?php echo $userInfo->day?>日</span>
                @else
                <span class="show">暂无设置</span>
            @endif
        </li>
        <li>积分 <span class="show"><?php echo $userInfo->score?></span></li>
    </ul>


</body>
</html>
<script src="./js/jquery-1.11.1.min.js"></script>
<script>
    $("#changeimg").click(function()
    {
        location.href = "changeimg";
    })
</script>