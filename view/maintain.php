<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>闭站维护中</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/itoukou1/cssjs@1.2/app.css">
    <?php if ($data->sakura=='on') : ?>
        <script src="https://cdn.jsdelivr.net/gh/itoukou1/cssjs@1.0/sakura.js"></script>

    <?endif;?>
    <?php if($data->MaintainBackground != "") : ?>
    <style>
        .layerBackground{
            background: url("<?php echo($data->MaintainBackground); ?>");
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
    <?php endif; ?>

</head>
<body>
<div class="layerBackground" id="background"></div>

<div class="box">
    <div class="submit-layer">
        <!-- <div class="logo">
            <img src="http://dns.doraeclub.com/icon.svg" class="logopicture">
        </div> -->
        <div class="loginbox">
            <div class="title">闭站维护中</div>
            <div class="form">

                <?php if($data->MaintainContent == "") : ?>
                    我们正在维护!!
                <?php else : ?>

                    <?php echo($data->MaintainContent); ?>
                <?php endif; ?>



            </div>
            <script>
                function url(){
                    <?php if ($data->URL === "") : ?>
                    alert("页面维护中");
                    <?php else: ?>
                    window.location.href="<?php echo ($data->URL); ?>";
                    <? endif;?>
                }
            </script>
            <button onclick="url()"><?php if(is_null($data->title)) : ?>点我访问<?php else: ?><?php echo($data->title);?><?php endif;?></button>

        </div>
    </div>


</body>

</html>