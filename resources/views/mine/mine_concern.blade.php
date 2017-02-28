<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>关注的艺人</title>
	<link href="./css/concern.css" rel="stylesheet">
	<link rel="stylesheet" href="http://cdn.bootcss.com/aplayer/1.4.6/APlayer.min.css"> 
</head>
<body>
	<div class="main">
		<div class="last_one">
			<a href="javascript:void(0)"><span class="font1" onclick="history.go(-1)">⇜</span></a><span class="font11"  >关注的艺人</span>
			<a href="javascript:void(0)"><span class="font2" onclick="history.go(0)" >↺</span></a>
		</div>
		<div class="uls">
		<a href="">
			<ul class="ul1">
				<b>艺人最新歌曲</b>
			</ul>
		</a>
		</div>
		<?php foreach ($att_data as $key => $val): ?>
		<div class="tt">
			<div class="clflaot">
				<a href="">
					<img src="<?php echo 'http://admin.daphp.top'.$val['actor_img']?>">
					<ul class="ul2">
						<b><?php echo $val['actor_name'] ?></b>
					</ul>
				</a>
			</div>
			<hr width="88%" style="margin-right:2rem; margin-bottom:2rem;">
		</div>		
		<?php endforeach ?>
</body>
</html>
