<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>爱尚music 艺人</title>
    <link rel="stylesheet" type="text/css" href="css/mdialog.css">
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/mdialog.js"></script >

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link href="css/index.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script type="text/javascript" src="http://down.hovertree.com/jquery/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://hovertree.com/texiao/jqimg/4/js/jquery.SuperSlide.js"></script>
    <style type="text/css">
        input {
            margin: 100px auto;
        }

        input[type="button"] {
            padding: 15px 25px;

        }
    </style>
</head>
<body>
<!-- 遮罩层 -->
<div id="fade1" class="black_overlay"></div>
<div id="MyDiv1" class="white_content">
    <div class="white_d">
        <div class="notice_t">
        </div>
        <div class="notice_c">
            <table border="0" align="center" style="margin-top:;" cellspacing="0" cellpadding="0">
                <tr valign="top">
                    <td width="60"><br><img src="images/suc.png" /></td>
                    <td>
                        <br><span style="color:red; font-size:50px;">歌曲已成功添加到列表</span><br /><br>
                    </td>
                </tr>
                <tr height="50" valign="bottom">
                    <td>&nbsp;</td>
                    <td><a href="listen" class="b_sure" >查看播放列表</a><a href="#" class="b_buy">继续点歌</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<br>

@include('public.head')

@include('public.nav')

<div class="focusBox">
</div>
<div class="tuijian">
    <?php foreach ($data as $key => $val): ?>
        <div class='song'>
            <a href="yiren?actor_id=<?php echo $val['actor_id']?>"><img src="<?php echo 'http://admin.daphp.top'.$val['actor_img']?>" alt="" width='300px' height='250px'/></a>
            <span class="songname"><?php echo $val['actor_name'] ?></span>
        </div>
    <?php endforeach ?>
</div>
</body>
</html>
