<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
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
	<title>爱尚music 排行榜</title>
	 <link href="./css/ranking_list.css" rel="stylesheet">
	 <link rel="stylesheet" href="http://cdn.bootcss.com/aplayer/1.4.6/APlayer.min.css"> 
</head>
<body>
		<!-- Header -->

		@include('public.head')

		@include('public.nav')

		<!-- 爱尚官方榜 -->
		<div class="top">
			<h2 class="tname">爱尚官方榜</h2>

			<a href="{{URL('/rank_lisk')}}?ifid=1">
			<div class="top1">
				<img src="./images/xinge/aaa1.jpg" alt="" height="140px" width="140px">
				<ul>
					<b>新歌榜</b>
					<?php foreach ($data1 as $k => $v): ?>
					<li><?php echo $v['actor_name'];?>-<?php echo $v['music_name']; ?></li>
					<?php endforeach ?>
				</ul>
				<img src="./images/aaa.jpg" class="imgs">
			</div><hr>
			</a>

			<a href="{{URL('/rank_lisk')}}?ifid=2">
			<div class="top1">
				<img src="./images/xinge/aaa2.jpg" alt="" height="140px" width="140px">
				<ul>
					<b>热歌榜</b>
					<?php foreach ($data2 as $ke => $va): ?>
					<li><?php echo $va['actor_name'];?>-<?php echo $va['music_name']; ?></li>
					<?php endforeach ?>
				</ul>
				<img src="./images/aaa.jpg" class="imgs">
			</div><hr>
			</a>

			<a href="{{URL('/rank_lisk')}}?ifid=3">
			<div class="top1">
				<img src="./images/xinge/aaa3.jpg" alt="" height="140px" width="140px">
				<ul>
					<b>原创榜</b>
					<?php foreach ($data3 as $key => $val): ?>
					<li><?php echo $val['actor_name'];?>-<?php echo $val['music_name']; ?></li>
					<?php endforeach ?>
				</ul>
				<img src="./images/aaa.jpg" class="imgs">
			</div><hr>
			</a>
		</div>

		<!-- 全球排行榜 -->
		<div class="middle">
			<h2 class="tname">全球排行榜</h2>

			<a href="{{URL('/rank_lisk')}}?ifid=4">
			<div class="top1">
				<img src="./images/xinge/aaa4.jpg" alt="" height="140px" width="140px">
				<ul>
					<b>欧美单曲榜</b>
					<?php foreach ($data4 as $keys => $valu): ?>
					<li><?php echo $valu['actor_name'];?>-<?php echo $valu['music_name']; ?></li>
					<?php endforeach ?>
				</ul>
				<img src="./images/aaa.jpg" class="imgs">
			</div><hr>
			</a>

			<a href="{{URL('/rank_lisk')}}?ifid=5">
			<div class="top1">
				<img src="./images/xinge/aaa6.jpg" alt="" height="140px" width="140px">

				<ul>
					<b>日语激情榜</b>
					<?php foreach ($data5 as $keyss => $value): ?>
					<li><?php echo $value['actor_name'];?>-<?php echo $value['music_name']; ?></li>
					<?php endforeach ?>
					
				</ul>
				<img src="./images/aaa.jpg" class="imgs">
			</div><hr>
			</a>

			<a href="{{URL('/rank_lisk')}}?ifid=6">
			<div class="top1">
				<img src="./images/xinge/aaa8.jpg" alt="" height="140px" width="140px">

				<ul>	
					<b>韩国MNET音乐排行榜</b>
					<?php foreach ($data6 as $keyss => $value): ?>
					<li><?php echo $value['actor_name'];?>-<?php echo $value['music_name']; ?></li>
					<?php endforeach ?>
				</ul>
				<img src="./images/aaa.jpg" class="imgs">
			</div><hr>
			</a>

			<a href="{{URL('/rank_lisk')}}?ifid=7">
			<div class="top1">
				<img src="./images/xinge/aaa3.jpg" alt="" height="140px" width="140px">

				<ul>
					<b>Hito 中文排行榜</b>
					<?php foreach ($data7 as $keyss => $value): ?>
					<li><?php echo $value['actor_name'];?>-<?php echo $value['music_name']; ?></li>
					<?php endforeach ?>
				</ul>
				<img src="./images/aaa.jpg" class="imgs">
			</div><hr>
			</a>

		</div>

		<!-- 爱尚特色榜 -->
</body>
</html>
