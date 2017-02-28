<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/reply.css"/>
    <title>音乐评论回复</title>
</head>
<body>
    <div id="box">

        @include('comment/header')

        <div class="box2">
            相关回复
        </div>
        @foreach($comment as  $k=>$v)
        <div class="box3">
            <div class="box4">
                <ul>
                    <li><?php echo $user->username?></li>
                    <li><?php echo $v->comm_time;?></li>
                    <li><span class="com_reply" user_id="<?php echo $user->user_id?>"></span></li>
                </ul>
            </div>
            <div class="box5"><?php echo $v->comm_content?></div>
        </div>
         @endforeach;
    </div>
</body>
</html>