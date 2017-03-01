<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>精选集详情</title>
    <link rel="stylesheet" type="text/css" href="css/rand.css">
    <script src="./js/jquery.js"></script>
</head>
<body>
<div class="head" style=' background:url("./images/IMG_0733_02.jpg") repeat;'>
    <a href="javascript:void(0)" onclick="history.go(-1)">←</a>
    <span>专辑</span>
</div>
<div class="head1" style="background: url('./images/IMG_0733_05.jpg') repeat">
    <dl>
        <dt><img src="<?php echo "http://admin.daphp.top$img";?>" alt="" width="220px" height="220px"></dt>
        <dd><b>{{$title}}</b></dd>
        <dd>最美的专辑，最好听的歌</dd>
        <dd>{{date('m',time()).'月'.date('d',time()).'日更新'}}</dd>
    </dl>
</div>
<div class="head2">
    <div class="play">
        <a><img src="./images/IMG_0732_06.jpg" alt=""><h1 id="song">全部播放 {{count($music)}}首</h1></a>
    </div>
    @foreach($music as $k => $v)
        @foreach($v as $a=>$b)
        <div class="play1">
                <dl>
                    <dt><a href=""><img src="http://admin.daphp.top{{$b->music_img}}" class="photo" alt=""></a></dt>
                    <a href="javascript:;" class='song' attr="{{ $b->music_id }}">
                        <dd class="songname">{{$b->music_name}}</dd>
                    </a>
                    <dd>{{$b->actor_name}}</dd>
                </dl>

            <img src="./images/my7.jpg" class="caozuo" music_id="{{$b->music_id}}" download="http://admin.daphp.top{{$b->music_path}}" actor_id="{{$b->actor_id}}" alt="歌曲封面">
        </div>
            @endforeach
    @endforeach
</div>
<div id="test"></div>
<div class="head3" style="" music_id="" download="">
    <div class="footer1">
        <dl>
            <dt><a href="javascript:void(0)" id="jing"><img src="./images/jingxuan.gif" alt=""></a></dt>
            <dd>加到精选集</dd>
        </dl>
        <dl>
            <dt><img src="./images/shoucang.gif" id="shoucang" alt=""></dt>
            <dd>收藏</dd>
        </dl>
        <dl>
            <dt><a href="" id="download" ><img src="./images/xiazai.gif" alt=""></a></dt>
            <dd>下载</dd>
        </dl>
        <dl>
            <dt><img src="./images/bofang.gif" alt="" id="dui"></dt>
            <dd>加入播放列表</dd>
        </dl>
        <dl>
            <dt><a href="" id="actor"><img src="./images/yiren.gif" alt="" ></a></dt>
            <dd>艺人</dd>
        </dl>
        <dl>
            <dt><a href="" id="zhuan"><img src="./images/zhuanji.gif" alt="" ></a></dt>
            <dd>专辑详情</dd>
        </dl>

        <dl>
            <dt><a href="" id="comment"><img src="./images/pinglun.gif" alt="" ></a></dt>
            <dd>评论</dd>
        </dl>
    </div>
    <div class="footer">
        <span id="rest">取消</span>
    </div>
</div>

</body>
</html>
<script>
    $('.caozuo').click(function(){
        var music_id = $(this).attr('music_id');
        var actor_id = $(this).attr('actor_id');
        var music_path = $(this).attr('download');
        $('#test').show('slow');
        $(".head3").show("slow");
        $('.head3').attr('music_id',music_id);

        $('#download').attr('href',music_path);
        $('#actor').attr('href','yiren?actor_id='+actor_id);
        $('#zhuan').attr('href','z_xiang?music_id='+music_id);
        //音乐评论

        $('#comment').attr('href','comment?music_id='+music_id);
    })
    $('.footer').click(function(){
        $(".head3").hide("slow");
        $('#test').hide('slow');
    })
    //加入精选集
    $("#jing").click(function(){
        var id=$('.head3').attr('music_id');
        $.ajax({
            type: "POST",
            url: "jing",
            data: {
                id:id
            },
            success:function(e){
                if(e==1){
                    alert("已经添加过了");
                }
                if(e==2){
                    alert("添加成功！");
                }
            }

        });
    });

    $('#shoucang').click(function(){
        var music_id = $('.head3').attr('music_id');

        $.ajax({
            type: "POST",
            url: "shoucang",
            data: "music_id="+music_id,
            success: function(msg){
                if(msg == 0)
                {
                    alert('收藏成功');
                }
                else if(msg == 1)
                {
                    alert('收藏失败');
                }
                else if(msg == 2)
                {
                    alert('你已经收藏过该歌曲');
                }
                else if(msg == 3)
                {
                    alert('请先登录');
                    location.href = 'login';
                }
            }
        });
    })

    //申慧慧 点击歌曲播放
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


</script>
