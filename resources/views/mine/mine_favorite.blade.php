<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>我的收藏</title>
	<link href="./css/mfavorite.css" rel="stylesheet">
	<link rel="stylesheet" href="http://cdn.bootcss.com/aplayer/1.4.6/APlayer.min.css"> 
</head>
<body>
	<div class="main">
		<div class="last_one">
			<a href="javascript:void(0)"><span class="font1" onclick="history.go(-1)">⇜</span></a><span class="font11"  >我的收藏</span>
			<a href="javascript:void(0)"><span class="font2" onclick="history.go(0)" >↺</span></a>
		</div>
		<div class="uls">
			<ul class="ul1">
				<a href="{{URL('/mine_favorite')}}"><li class="li1">歌曲</li></a>
				<a href="{{URL('/mine_fav_zhuanji')}}"><li>专辑</li></a>
				<a href="#"><li>精选集</li></a>
			</ul>
		</div>
		<hr>
		<div class="tt">
			<?php foreach ($coll_data as $key => $val): ?>
			<div class="clflaot">
				<img src="<?php echo 'http://admin.daphp.top'.$val['music_img']?>">
				<ul class="ul2">
					<b><?php echo $val['music_name'] ?></b>
					<li><?php echo $val['actor_name'] ?></li>
				</ul>
			</div>
			<hr width="100%">
			<?php endforeach ?>
		</div>
	</div>
</body>
</html>
