<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>爱尚music 快讯详情</title>
    <link href="css/quality.css" rel="stylesheet">
    <style>
        #tu{
            float: right;
        }
    </style>
</head>
<body>
<div class="head1">
    <h1>发现好文</h1>
    <div id="tu">
        <img src="<?php echo 'http://admin.daphp.top/instyle/images/article/'.$data[0]->art_img; ?>" style="width: 980px;height: 300px;">
    </div>
</div>
<div class="jingxuan">
    <h2><?php echo $data[0]->art_title; ?></h2>
<p>
    <?php echo $data[0]->art_content; ?>
</p>
</div>
</body>
</html>
