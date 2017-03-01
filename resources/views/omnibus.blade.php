<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <link href="css/quality.css" rel="stylesheet">
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
<div class="head1">
    <span id="tou"><img src="./images/headtu.jpg" alt=""/></span>
    <a href="index">我的</a>&nbsp;&nbsp;&nbsp;<a href="quality">推荐</a>&nbsp;&nbsp;&nbsp;<a href="article">发现</a>
</div>
<div class="head2">
    <a href="index">首页</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="quality">精选集</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="rank_index">排行榜</a>&nbsp;&nbsp;&nbsp;&nbsp;电台&nbsp;&nbsp;mv
</div>
<div class="head3">
    <ul>
        <li><a href="quality">推荐</a></li>
        <li><a href="xin">最新</a></li>
        <li><a href="hot">最热</a></li>
        <li><a href="zhuan">专区</a></li>
    </ul>
</div>
<div class="jingxuan">
    @foreach($data as $k)
    <dl>
        <dt><a href="music?id={{$k->song_id}}&img={{$k->img}}&title={{$k->title}}"><img src="<?php echo 'http://admin.daphp.top'.$k->img; ?>" alt="" width="200rem" height="200rem"/></a></dt>
        <dd>
            <h1><a href="{{url('music')}}?id={{$k->song_id}}&img={{$k->img}}&title={{$k->title}}">{{$k->title}}</a></h1>
            <p><a href="music?id={{$k->song_id}}&img={{$k->img}}&title={{$k->title}}"><span>{{$k->des}}</span></a></p>
        </dd>
    </dl>
    @endforeach


</div>
</body>
</html>
