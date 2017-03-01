
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
        .top{
            margin-top: 20px;
            height: 400px;
            background: red;
        }
    </style>
</head>
<body>
<div class="head1">
     <span id="tou"><img src="./images/1.jpg" alt=""/></span><a href="/">我的</a>&nbsp;&nbsp;&nbsp;<a href="quality"> 推荐</a>&nbsp;&nbsp;&nbsp;<a href="article">发现</a>
</div>
<div class="jingxuan">
    <div>
        <?php
        foreach($data as $k){
        ?>
            <a href="wen?id=<?php echo $k->art_id; ?>">
        <dl>
            <dt><img src="<?php echo 'http://admin.daphp.top/instyle/images/article/'.$k->art_img; ?>" alt="" width="200rem" height="200rem"/></dt>
            <dd>
                <h1><?php echo $k->art_title; ?></h1>
                <p><span><?php echo $k->jian; ?></span></p>
            </dd>
        </dl>
            </a>
        <?php }
        ?>
    </div>
</div>
</body>
</html>
