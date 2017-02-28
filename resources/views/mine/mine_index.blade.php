<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="./css/personal.css" rel="stylesheet">
	<link rel="stylesheet" href="http://cdn.bootcss.com/aplayer/1.4.6/APlayer.min.css"> 
	<style>
        .head1 a{
            color:#f0f9fe;
            text-decoration:none;
        }
        a{
            color: #001217;
            text-decoration:none;
        }
    </style>
</head>
<body>
	<div class="all">
		<div class="head1">
		    <span id="tou"><!-- <img src="./images/1.jpg" alt=""/> --></span>
			 <a href="index">我的</a>&nbsp;&nbsp;&nbsp;<a href="quality">推荐</a>&nbsp;&nbsp;&nbsp;<a href="article">发现</a>
		</div>
		<div class="one">
			<a href=""><img src="./images/my3.jpg" class="Oimg1"></a>
			<ul class="ul1">
				<h3>本地歌曲</h3>
				<li>826首</li>
			</ul>
			<a href=""><img src="./images/my1.jpg" class="Oimg2"></a>
			<a href=""><img src="./images/my2.jpg" class="Oimg3"></a>
		</div>


		<div class="two">
			<div class="two1">
				<a href="{{URL('/mine_but')}}"><img src="./images/my7.jpg" class="timg"></a>
				<a href="{{URL('/mine_favorite')}}"><img src="./images/my4.jpg" class="timg"></a>
				<a href="{{URL('/mine_lately')}}"><img src="./images/my5.jpg" class="timg"></a>
				<a href="#"><img src="./images/my6.jpg" class="timg"></a>
				<a href="{{URL('/mine_concern')}}"><img src="./images/my8.jpg" class="timg"></a><br>
				<span class="s1">已购</span>
				<span class="s2">收藏</span>
				<span class="s3">最近播放</span>
				<span class="s4">离线音乐包</span>
				<span class="s5">关注的艺人</span>
			</div>
			<div class="two2">
				<h1>把私房音乐库收藏到精选集<br>让爱尚音乐与你一起聆听、分享</h1>
			</div>

			<div class="two3">
				<a href="quality"><img src="./images/my10.jpg" class="timg3"></a>
			</div>

		</div>

	</div>
</body>
</html>
