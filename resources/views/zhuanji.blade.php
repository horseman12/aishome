<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>精选集详情</title>
    <link href="css/dianji.css" rel="stylesheet">
    <style>
        #one{ background-image: url("images/bei.jpg"); height: 500px;width: 980px; }
        h1{ text-align: center; }
        #o1{ height: 350px;width:350px;float: left; }
        #o2{ height: 350px;width: 630px;float: left; }
        #o3{ clear:both; width:980px;height: 100px;}
        #o3 ul li{ list-style: none;float: left;margin: 50px 100px; }
        #dao{ width: 980px;height: 100px; }
        #d1{ width: 440px;height: 60px;float: left;margin-left: 20px; }
        #d2{ width: 220px;height: 60px;float: right;margin-right: 20px; }
        #d3{ width: 220px;height: 60px;float: right; }
        #foot{ clear: both;width:980px;height: 300px; }
        #foot dt{ width: 200px;height: 300px; float: left;}
        #f1{ width:500px;height: 300px; float: left;}
        #f2{ width:200px;height: 300px; float: left;}
        #z{ width: 980px;height: 100px;background-color: #f00;position: fixed;
        bottom: 0; }
 /*遮罩层*/
         html,body {
             margin:0;
             height:100%;
         }
        #test {
            width:100%;
            height:100%;
            background-color:#000;
            position:absolute;
            top:0;
            left:0;
            z-index:2;
            opacity:0.3;
            /*兼容IE8及以下版本浏览器*/
            filter: alpha(opacity=30);
            display:none;
        }

        #log_window {
            margin-top: 60%;
            width:100%;
            height:40%;
            background-color:#f0f9fe;
            margin: auto;
            position: absolute;
            z-index:3;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            display:none;
        }
        #f1{
            margin-top: 2rem;
        }
        #f2{
            margin-top: 2rem;
        }
        #log_window ol{
            float:left;
            /*list-style: none;*/
            margin-left:5rem;
            margin-top: 3rem;
        }
        #log_window ol li{
            list-style: none;
        }
        #log_window ol li span{
            /*list-style: none;*/
            font-size: 28px;
            font-weight: bold;
            margin-top: 10px;
            text-align: center;
        }
        a{
            text-decoration: none;
        }
        #log_window span{
            font-size: 28px;
        }
    </style>
</head>
<body>
<div id="one">
    <h1>专辑详情</h1>
    <?php
     foreach($data as $k){
        ?>
        <div id="o1">
        <img src="<?php echo $k->spe_img; ?>" style="width: 300px;height: 300px;margin: 25px;">
    </div>
    <div id="o2">
        <h1><?php echo $k->spe_name; ?></h1>
        <h2 style="margin-left: 50px;"><?php echo $k->spe_desc; ?> ></h2>
    </div>
     <?php }
    ?>

</div>
<?php
foreach($data as $k){
    ?>
    <a href="chajian?music_id=<?php echo $k->music_id?>">
    <div id="foot">
    <div>
        <dl>
            <dt>
             <span id="music_image">
                 <a href="chajian?spe_id={{$spe_id}}"><img src="<?php echo 'http://admin.daphp.top'.$k->music_img; ?>" music_id="<?php echo $k->music_id?>" style="width: 150px;height: 150px;margin: 20px;"></a>
                 </span>
            </dt>
            <dd id="f1">
                <h2><font style="font-size: 32px;"><?php echo $k->music_name; ?></font></h2>
                <span><font style="font-size: 32px;"><?php echo $k->actor_name; ?></font></span>
            </dd>
            <dd id="f2">
                <a href="javascript:shield('<?php echo $k->music_id;?>','<?php echo 'http://admin.daphp.top'.$k->lyric_path;?>')"><h1>***</h1></a>
            </dd>
        </dl>
    </div>
</div>
</a>
 <?php }
?>

<div id="test"></div>
<div id="log_window" music_id="">
    <ol>
        <li><span id="jing"><img src="./images/jingxuan.gif" alt="" width="140rem" height="140rem"/></span></li>
        <li><span id="jing">加到精选集</span></li>
    </ol>
    <ol>
        <li><span class="shou"><img src="./images/shoucang.gif" class="shou" alt="" width="140rem" height="140rem"/></span></li>
        <li><span class="shou">收藏</span></li>
    </ol>
    <ol>
        <li><span id="load"><a href=""><img src="./images/xiazai.gif" alt="" width="140rem" height="140rem"/></a></span></li>
        <li><span id="load"><a href="">下载</a></span></li>
    </ol><ol>
        <li><span id="dui"><img src="./images/bofang.gif" alt="" width="140rem" height="140rem"/></span></li>
        <li><span id="dui">加到播放队列</span></li>
    </ol>
    <ol>
        <li><span id="actor"><a href=""><img src="./images/yiren.gif" alt="" width="140rem" height="140rem"/></a></span></li>
        <li><span id="actor"><a href="">艺人详情</a></span></li>
    </ol>
    <ol>
        <li><span id="zhuan"><a href=""><img src="./images/zhuanji.gif" alt="" width="140rem" height="140rem"/></a></span></li>
        <li><span id="zhuan"><a href="">专辑详情</a></span></li>
    </ol>
    <ol>
        <li><span class="comment"><a href=""><img src="./images/pinglun.gif" alt="" width="140rem" height="140rem"/></a></span></li>
        <li><span class="comment"><a href="">评论</a></span></li>
    </ol>
    
    <span><a href="javascript:cancel_shield()">关闭</a></span>
</div>

<script src="./js/jquery.1.12.min.js"></script>
<script>
    //加入播放队列
    $("#dui").click(function(){
        var id=$('#log_window').attr('music_id');
        alert('添加成功');
    });
    //加入精选集
    $("#jing").click(function(){
        var id=$('#log_window').attr('music_id');
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
    //收藏
    $('#shou').click(function(){
       var id = $('#log_window').attr('music_id');
        $.ajax({
            type: "POST",
            url: "shoucang",
            data: "music_id="+id,
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
</script>
<script>

    function shield(id,path){
        var s = document.getElementById("test");
        s.style.display = "block";

        var l = document.getElementById("log_window");
        l.style.display = "block";

        $('#log_window').attr('music_id',id);
        $('#actor').children('a').attr('href','yiren?music_id='+id);
        $('#zhuan').children('a').attr('href','z_xiang?music_id='+id);
        //音乐评论
        $('.comment').children('a').attr('href','comment?music_id='+id);
        //音乐下载
        $('#load').children('a').attr('href',path);

    }

    function cancel_shield(){
        var s = document.getElementById("test");
        s.style.display = "none";

        var l = document.getElementById("log_window");
        l.style.display = "none";
    }
</script>


</body>
</html>
