<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>修改头像</title>
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="description" content="">
    <link rel="stylesheet" href="./css/changeimg.css">
</head>
<body>

<div id="header">
    <a href="/memberindex" id="return">←</a>
    <span>修改头像</span>
</div>
<div class="con4">
    <form action="changeimg" method="post">
    <input type="hidden" name="image" value="{{ $userData['img'] or '' }}">
    <canvas id="cvs" width="200" height="200"></canvas>
    <span class="btn upload">更换头像<input type="file" class="upload_pic" id="upload" /></span>
     <input type="submit" value="确定更换"  class="btn upload" style="margin-top: 15px;color: #ffffff;height: 43px">
    {{--<span class="btn upload">确定更换</span>--}}
    </form>
</div>
<script src="./js/jquery-1.11.1.min.js"></script>
<script>
    $(function()
    {
         var img = "<?php echo $userData['img']?>";
         if(img == '')
         {
                imgch('./images/yiren.gif');
         }else {
                imgch(img);
         }
    })
    //获取上传按钮
    var input1 = document.getElementById("upload");
    if(typeof FileReader==='undefined'){
        input1.setAttribute('disabled','disabled');
    }else{
        input1.addEventListener('change',readFile,false);
    }
    function readFile(){
        var file = this.files[0];//获取上传文件列表中第一个文件
        if(!/image\/\w+/.test(file.type)){
            //图片文件的type值为image/png或image/jpg
            alert("文件必须为图片！");
            return false;
        }
        var reader = new FileReader(); //实例一个文件对象
        reader.readAsDataURL(file);//    把上传的文件转换成url
        reader.onload = function(e){
            var data = e.target.result.split(',');
//            console.log(data);
//            var tp = (file.type == 'image/png')? 'png': 'jpg';
            var imgUrl = data[1];
            //上传图片
            $("input[name=image]").val(imgUrl);
            imgch(e.target.result);
        }
    };

    function imgch(src)
    {
        var image = new Image();
        image.src = src;
        var max=200;
        image.onload = function(){
            var canvas = document.getElementById("cvs");
            var ctx = canvas.getContext("2d");
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(image, 0, 0, 200, 200);
        };
    }
</script>
</body>
</html>