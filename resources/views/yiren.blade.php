<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<style>
    .top1{
        width: 100%;
        height:48rem;
        background: url("{{'http://admin.daphp.top'.$data['actor_img']}}");
        background-size:100% 100%;
    }
    .top11{
        position: absolute;
        height: 10rem;
        /*        background:red;*/
    }
    .font1{
        color: #fff4e6;
        font-size:6rem;
        margin-left:1rem;
    }
    .font2{
        color: #fff4e6;
        font-size:3rem;
        margin-left:13rem;
        color: yellow;
    }
    .font3{
        color: #fff4e6;
        font-size:3.5rem;
        margin-left:15rem;
    }


    .main1{

        margin-top:2rem;
       // height: 23rem;
    }
    h2{
        padding-top: 1rem;
        font-size: 55px;
        font-family: STXingkai;
        background: #efeae6;
    }
    .p1{
        margin-left: 2rem;
        font-size: 30px;
        line-height: 3rem;
padding-right:20px
    }

    .main2{
        background: #efeae6;
        margin-top:1rem;
    }
    dl{
        padding-top: 3rem;
        margin-left: 7rem;
        float: left;
    }
    dd{
        font-family: STXingkai;
        font-size: 35px;
        color: purple;
    }
    a{
        text-decoration:none;
        color:inherit;
    }

</style>
<body>
<div class="all">
    <div class="top1">
        <div class="top11">
            <a href="javascript:void(0)" onclick="history.go(-1)"><span class="font1">⇜</span></a>
            <span class="font3">{{$data['actor_name']}}</span>
            <a href="javascript:void(0)"><span class="font2"><img src="<?php if($is_atte == 0){echo "./images/my4.jpg";}if($is_atte==1){echo "./images/my44.jpg";}?>" actor_id="{{$data['actor_id']}}" id="gz" width="80px" alt=""></span></a>
        </div>
        <div></div>
    </div>


    <div class="main1">
        <h2>艺人信息</h2>
        <p class="p1">
            &nbsp;{{$data['actor_desc']}}
        </p>
    </div>
    <div class="main2">
        <div class="main22">
            <h2>艺人歌曲</h2>
            @foreach($music as $k => $v)
            <dl class="dl1">
                <dt><img src="{{'http://admin.daphp.top'.$v['music_img']}}" width="300px" height="300px;" class="img33"></dt>
                <dd>{{$v['music_name']}}
                    <br>
                    &nbsp;&nbsp;&nbsp;
                    {{$v['actor_name']}}
                </dd>
                <!-- <dd></dd> -->
            </dl>
            @endforeach

        </div>
    </div>
</div>
</body>
</html>
<script src="./js/jquery.js"></script>
<script>
    $('#gz').click(function(){
        var actor_id = $(this).attr('actor_id');
        $.ajax({
            type: "get",
            url: "attention",
            data:"actor_id="+actor_id,
            dataType:'json',
            success: function(msg)
            {
                if(msg.code ==  0){
                    alert(msg.msgs)
                }
                if(msg.code == 1){
                    alert(msg.msgs)
                    $('#gz').attr('src','./images/my4.jpg')
                }
                if(msg.code ==  2){
                    alert(msg.msgs)
                    $('#gz').attr('src','./images/my44.jpg')
                }
                if(msg.code == 3){
                    alert(msg.msgs)
                }

            }
        });
    })
</script>
