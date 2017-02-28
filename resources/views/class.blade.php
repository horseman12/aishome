<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <link href="css/class.css" rel="stylesheet">
    <link rel="stylesheet" href="">
    <script src="./js/jquery.js"></script>
    <script src="./js/music.js"></script>
</head>
<body>
<div class="head1">
    <img src="./images/IMG_0580_03.jpg" alt=""><span>选择分类</span>
</div>
<div class="head2">
    全部
</div>
<div class="head3">
    <div class="box">
        <img src="./images/IMG_0580_07.jpg" alt="">
    </div>
   <div class="box1">
       <a href="" class="hot">国语</a>
       <a href=""></a>
       <a href=""></a>
       <a href=""></a>
       <a href=""></a>

   </div>
</div>
<div class="head4">
    <div class="box2">
        <img src="./images/IMG_0580_07.jpg" alt="">
    </div>
    <div class="box1">
        <a >国语</a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
    </div>
</div>
<div class="head5">
    <div class="box3">
        <img src="./images/IMG_0580_10.jpg" alt="">
    </div>
    <div class="box1">
        <a >国语</a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
    </div>
</div>
<div class="head6">
    <div class="box3">
        <img src="./images/IMG_0580_10.jpg" alt="">
    </div>
    <div class="box1">
        <a >国语</a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
        <a></a>
    </div>
</div>
<div class="hrss">
<div class="hrs"></div><span class="hrs1">想要更多？</span><div class="hrs2"></div>
</div>
<div class="likes">
    <a >国语</a>
    <a></a>
    <a></a>
    <a></a>
    <a></a>
    <a></a>
    <a></a>
    <a></a>
    <a></a>
    <a></a>
    <a></a>
    <a id="reash">换一换</a>
</div>
<!-- 音乐播放器 -->
<div id="player1" class="aplayer"></div>
<script src="APlayer.min.js">
    var ap = new APlayer({
        element: document.getElementById('player1'),
        narrow: false,
        autoplay: true,
        showlrc: false,
        music: {
            title: 'Preparation',
            author: 'Hans Zimmer/Richard Harvey',
            url: 'http://7xifn9.com1.z0.glb.clouddn.com/Preparation.mp3',
            pic: 'http://7xifn9.com1.z0.glb.clouddn.com/Preparation.jpg'
        }
    });
    ap.init();
</script>
</body>
</html>
