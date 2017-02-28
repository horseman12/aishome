<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>jQuery支持PC手机音乐播放器插件</title>
<link rel="stylesheet" href="css/palyss.css"/>
<link rel="stylesheet" href="css/styles.css"/>
</head>
<body>
<div id="not-allowed">
    <ul id="example-size-picker">
        <li data-size="mobile">Mobile</li>
        <li data-size="large">Large</li>
        <li data-size="full">Full Screen</li>
    </ul>
    <div id="example-outer">
        <div id="example" data-size="large">

        </div>
    </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/ttw-clarity-player.js"></script>
<script src="js/yepnope.js"></script>
<script type="text/javascript">
    $(function () {
        var myPlaylist = [
            @foreach($music as  $k => $music)
            {
                mp3:"<?php echo 'http://admin.daphp.top'.$music['lyric_path'];?>",
                //duration:'2:21',
                cover:"<?php echo 'http://admin.daphp.top'.$music['music_img'];?>",
                title:"<?php echo $music['music_name'];?>",
                artist:"<?php echo $music['actor_name'];?>",
                background:"<?php echo 'http://admin.daphp.top'.$music['music_img']?>"
            },
            @endforeach

        ];
        
        var clarity = $('#example').ttwClarityPlayer(myPlaylist,{
                jPlayer:{
                    supplied:'mp3',
                    errorAlerts:true,   
                    autoPlay:true,              
                    warningAlerts:true,
                    consoleAlerts:true
                }
            });
        
        $('#example-size-picker').on('click', 'li', function(){
            $('#example').attr('data-size', $(this).data('size'));
            clarity.manageLayout();
        });
    });
</script>

</body>
</html>
