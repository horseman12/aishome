<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta charset="UTF-8">
    <title>个人中心</title>
    <link rel="stylesheet" href="./css/memberindex.css">
</head>
<body>
    <div id="header">
        <a onclick="history.back(-1)" id="return">←</a>
        <span>个人中心</span>
    </div>
    <ul id="list">
        <li id="changeimg">头像
        @if($userInfo->img != '')
                <div id="img" style="background-image: url(<?php echo $userInfo->img?>)"></div>
            @else
                <div id="img" style="background-image: url('./images/yiren.gif')"></div>
            @endif
        </li>
        <li id="nick">昵称
            @if($userInfo->nickname !='')
                <span class="show" uid="<?php echo $userInfo->user_id?>"><span id="nickname"><?php echo $userInfo->nickname?></span></span>
                @else
                <span class="show">暂无设置</span>
            @endif
        </li>
        <li>性别
            <span class="show">
            <select id="sex">
                @if($userInfo->sex != ''){
                <option value="男">男</option>
                <option value="女" <?php if($userInfo->sex == '女'){echo 'selected';}?>>女</option>
                }@else{
                <option value="">暂无设置</option>
                <option value="男">男</option>
                <option value="女">女</option>
                }
                @endif
            </select>
            </span>
        </li>
        <li>出生年月
                <span class="show">
                    <select id="year">
                        @if($userInfo->year != ''){
                         <option><?php echo $userInfo->year?></option>
                        <?php
                        for($i=1940;$i<=2017;$i++){
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                        }
                        @else{
                        <option>暂未设置</option>
                        <?php
                        for($i=1940;$i<=2017;$i++){
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                        }
                        @endif
                    </select>年-

                    <select id="month">
                        @if($userInfo->month != ''){
                        <option><?php echo $userInfo->month?></option>
                        <?php
                        for($i=1;$i<=12;$i++){
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                        }
                        @else{
                        <option>暂未设置</option>
                        <?php
                        for($i=1;$i<=12;$i++){
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                        }
                        @endif
                    </select>月-
                    <select id="day">
                        @if($userInfo->day != ''){
                        <option><?php echo $userInfo->day?></option>

                        <?php
                        for($i=1;$i<=30;$i++){
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                        }
                        @else{
                        <option>暂未设置</option>
                        <?php
                        for($i=1;$i<=30;$i++){
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                        }
                        @endif
                    </select>日
                </span>

        </li>
        <li>积分 <span class="show"><?php echo $userInfo->score?></span></li>
    </ul>


</body>
</html>
<script src="./js/jquery-1.11.1.min.js"></script>
<script>
    $("#changeimg").click(function()
    {
        location.href = "changeimg";
    })
    $("#year").change(function () {
        var year = $("#year").val();
        $.ajax({
            type: "get",
            url: "{{('lala')}}",
            data: {year:year},
            success: function(msg){
                if(msg==1){
                    history.go(0);
                }
            }
        });
    })
    $("#month").change(function () {
        var month = $("#month").val();
        $.ajax({
            type: "get",
            url: "{{('lala')}}",
            data: {month:month},
            success: function(msg){

            }
        });
    })
    $("#day").change(function () {
        var day = $("#day").val();
        $.ajax({
            type: "get",
            url: "{{('lala')}}",
            data: {day:day},
            success: function(msg){

            }
        });
    })
    $("#sex").change(function () {
        var sex = $("#sex").val();
        $.ajax({
            type: "get",
            url: "{{('lala')}}",
            data: {sex:sex},
            success: function(msg){

            }
        });
    })
    $(document).on('click','#nickname',function(){
        var nickname = $(this).html();

        $(this).parent().html("<input type='text' name='nickname' value='"+nickname+"'>");
        $(document).on('blur',"input[name='nickname']",function(){
            var obj=$(this);
            var id=$(this).parent("span").attr("uid");
            var name=$(this).val();

            if(name == ''){
                obj.attr({placeholder:'不能为空'});
                return false;
            }

            $.ajax({
                type:"get",
                url:"{{('update_name')}}",
                data:{
                    user_id : id,
                    nickname : name
                },
                success:function(){
                    obj.parent().html("<span id='nickname'>"+name+"</span>");
                }
            });
        })
    })

</script>