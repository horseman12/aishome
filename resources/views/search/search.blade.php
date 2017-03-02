<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>爱尚music 搜索引擎</title>
    <link rel="stylesheet" href="jquery_ui/bootstrap.min.css">
    <link href="css/quality.css" rel="stylesheet">
    <link rel="stylesheet" href="jquery_ui/jquery-ui.css">
    <style>
        .head1 a{
            color:#f0f9fe;
            text-decoration:none;
        }
	    a{
            color: #001217;
            text-decoration:none;
            font-size: 34px;
	    }
        /*搜索框样式*/
        #search{
            border: 1px solid #2e6da4;
            width: 70%;
            height: 60px;
            font-size: 34px;
            margin-top: 30px;
        }
        #search_button{
            border: 1px solid #2e6da4;
            height: 61px;
            font-size: 34px;
            margin-top: 30px;
            color: #ff8833;
            background: white;
            font-weight: normal;
        }
        body{
            font-size: 34px;
        }
    </style>
</head>
<body>
@include("public.head")

<div class="head2" style="clear: both;">
    <input type="text" name="" id="search" placeholder="搜索您感兴趣的歌曲/歌手" >
    <input type="button" value="→" id="search_button">
</div>

<br><br><br>

<div id="search_result" class="" style="clear:both;margin:0 0 0 80px;display: none;">
    <h1 style="font-size: 50px;color:black;">搜索结果<a id="close_result" href="javascript:;" style="float:right;margin-right: 110px;font-size: 30px;color:blue;">X</a></h1>
    <div id="actor_box">

    </div>
    <div id="music_box">

    </div>
    <hr>
</div>

<div id="remen">

    {{--热门分类--}}
<div class="head3" style="clear:both;margin:0 0 0 80px;">
    <h1 style="font-size: 50px;color:black;">热门分类 <a href="type" style="float:right;margin-right: 110px;font-size: 30px;color:blue;">更多</a></h1>
    <table class="table">
        <?php
            if(count($hot_type)>4){
        ?>
        <tr>
            <td>
                <a href="omnibus?type_id=<?=$hot_type['0']->type_id?>">
                    <?=$hot_type['0']->type_name?>
                </a>
            </td>
            <td>
                <a href="omnibus?type_id=<?=$hot_type['1']->type_id?>">
                    <?=$hot_type['1']->type_name?>
                </a>
            </td>
            <td>
                <a href="omnibus?type_id=<?=$hot_type['2']->type_id?>">
                    <?=$hot_type['2']->type_name?>
                </a>
            </td>
            <td>
                <a href="omnibus?type_id=<?=$hot_type['3']->type_id?>">
                    <?=$hot_type['3']->type_name?>
                </a>
            </td>
        </tr>
        <tr>
             <?php
                for($i=4;$i<count($hot_type);$i++){
            ?>
                <td>
                    <a href="omnibus?type_id=<?=$hot_type[$i]->type_id?>">
                        <?=$hot_type[$i]->type_name?>
                    </a>
                </td>
            <?php } ?>
        </tr>
        <?php }else{  ?>

        <tr>
            <?php
            for($i=0;$i<count($hot_type);$i++){
            ?>
            <td>
                <a href="omnibus?type_id=<?=$hot_type[$i]->type_id?>">
                    <?=$hot_type[$i]->type_name?>
                </a>
            </td>
            <?php } ?>
        </tr>
        <?php } ?>
    </table>
</div>
    <hr>
    {{--热门歌曲--}}
<div class="head3" style="clear:both;margin:180px 0 0 80px;">
    <h1 style="font-size: 50px;color:black;">热门歌曲</h1>
    <div class="row">
        <table class="table">
            @foreach($hot_songs as $k=>$v)
            <tr>
                <td><a href="javascript:;" class='song' attr="{{ $v->music_id }}">{{ $v->music_name }} - {{ $v->actor_name }}</a></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

</div>

<script src="jquery_ui/jquery.js"></script>
<script src="jquery_ui/jquery-ui.js"></script>
<script>

    var availableTags = [
        <?=$search?>
    ];

    $( "#search" ).autocomplete({
        source: availableTags
    });

    //点击歌曲
    $(document).on('click','.song',function(){
        var music_id = $(this).attr('attr');
        $.ajax({
            type: "POST",
            url: "joinlisten",
            data: "music_id="+music_id+"&_token={{ csrf_token() }}",
            success: function(msg){
                location.href='listen';
            }
        });
    })

    //点击搜索
    $("#search_button").click(function(){
        var keyword = $("#search").val();
        if(keyword == ''){
            return false;
        }

        $.ajax({
            url:"dosearch",
            type:"get",
            data:{keyword:keyword},
            dataType:'json',
            success:function(msg){
                //alert(msg['actor'][0]['actor_name']);
                //处理艺人
                var actor_str = '';
                var actor = msg['actor'];
                for(var i=0;i<actor.length;i++){
                    actor_str += "<p><a href='yiren?actor_id="+actor[i]['actor_id']+"'>艺人："+actor[i]['actor_name']+"</a></p>";
                }
                $("#actor_box").html(actor_str);

                //处理歌曲
                var music_str = '';
                var music = msg['music'];
                for(var i=0;i<music.length;i++){
                    music_str += "<p><a href='javascript:;' class='song' attr='"+music[i]['music_id']+"'>歌曲："+music[i]['music_name']+" - "+music[i]['actor_name']+"</a></p>";
                }
                $("#music_box").html(music_str);

                $("#search_result").fadeIn();
            }
        })

    })

    //关闭搜索结果
    $("#close_result").click(function(){
        $("#search_result").fadeOut();
    })

    //替换搜索按钮 为 返回按钮
    $(function(){
        $("#tou3").html('X').css({'margin-right':'20px'}).click(function(){
            history.back(-1);
        });
        $("#tou2").css({'margin-left':'30%'});
    })

</script>
</body>
</html>
