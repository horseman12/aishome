<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>会员管理页面</title>
	<link href="css/member.css" rel="stylesheet">
	<link rel="stylesheet" href="http://cdn.bootcss.com/aplayer/1.4.6/APlayer.min.css">
</head>
<body>
<div class="main">
	<div class="last_one">
		<a href="/"><span class="font1">⇜</span></a>
		<span class="font2">↺</span>
	</div>
	<div class="top">
		<img src="./images/5029.gif" class="iii">
		<p><b class="b1">Vip 会 员 开 通</b></p>
	</div>

	<div class="middle">
		<div class="middle11">
			@if($endtime != '')
				<h2 style='color:red'>您已开通,到期时间: {{$endtime}}</h2>
			@else
				<h2>你还没开通会员快点开通吧!</h2>
			@endif
		</div>
		<h1>购买超级套餐</h1>
		<div class="middle12">
			<h2 style='margin-right:25px;'>一个月Vip会员&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;￥10.00</h2>
			<a href="/open_member?month=30">
				@if($endtime != '')
					<img class="img2" src="./images/19.jpg">
				@else
					<img class="img2" src="./images/17.jpg">
				@endif
			</a>
		</div>
		<div class="middle1">
			<h2 style='margin-right:25px;'>三个月Vip会员&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;￥10.00</h2>
			<a href="/open_member?month=30">
				@if($endtime != '')
					<img class="img2" src="./images/19.jpg">
				@else
					<img class="img2" src="./images/17.jpg">
				@endif
			</a>
		</div>
		<div class="middle1">
			<h2 style='margin-right:20px;'>六个月Vip会员&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;￥55.00</h2>
			<a href="/open_member?month=30">
				@if($endtime != '')
					<img class="img2" src="./images/19.jpg">
				@else
					<img class="img2" src="./images/17.jpg">
				@endif
			</a>
		</div>
		<div class="middle1">
			<h2>一年月Vip会员&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;￥100.00</h2>
			<a href="/open_member?month=30">
				@if($endtime != '')
					<img class="img2" src="./images/19.jpg">
				@else
					<img class="img2" src="./images/17.jpg">
				@endif
			</a>
		</div>
	</div>
	<div class="buttom">
		<h1>VIP会员专属特权</h1>
		<img src="./images/20.jpg" class="img3">
		<ul>
			<b>会员专享曲库</b>
			<li>无限量试听、下载专属付费音乐</li>
		</ul>
		<ul>
			<b>支持无损音质试听</b>
			<li>Vip可试听非付费音乐的无损音质</li>
		</ul>
		<ul>
			<b>手机端高音质音乐无限量下载</b>
			<li>作为Vip的你,可选择高音质的下载</li>
		</ul>
		<ul>
			<b>电脑端高音质音乐下载</b>
			<li>挑剔的你、追企的就是高音质</li>
		</ul>
		<ul>
			<b>爱尚音乐旅行漫游服务</b>
			<li>旅行海外也可以享受爱尚试听下载服务</li>
		</ul>
		<img src="./images/21.jpg" class="img4">
	</div>
</div>
</body>
</html>