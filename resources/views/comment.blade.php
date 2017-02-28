<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/comment.css"/>
    <title>音乐评论回复</title>
</head>
<body>
<div id="box">

    @include('comment/header')

    <div class="box2">
        评论
    </div>
    <div class="box3">
        <input type="hidden" value="<?php echo $user_id?>" class="user_id"/>
        <input type="hidden" value="<?php echo $music_id?>" class="music_id"/>
        <textarea name="" id="comment"></textarea>
    </div>
        <img src="./images/comment1.gif" alt=""/>
</div>
</body>
</html>
<script src="./js/jquery.1.12.min.js"></script>
<script>
    $("img").click(function(){
        //获取评论值
        var comment = $('#comment').val();
        var user_id = $('.user_id').val();
        var music_id = $('.music_id').val();
        $.ajax({
            type:"POST",
            url:"comment_post",
            data:"comment="+comment+"&user_id="+user_id+"&music_id="+music_id,
           success:function(msg){
               if(msg == 1)
               {
                   location.href='reply&'+music_id+','+user_id;
               }
               if(msg == 0)
               {
                    alert('评论失败');
                   location.href='comment';
               }
           }

        })
    })
</script>