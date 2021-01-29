<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>共享文档 | doc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    <div class="container">
        <?php $is_login=false;include 'header.php' ?>
        
        <?php include 'text.php' ?>
        
        
        
        <h1>用户注册</h1>
        <p id="hitokoto"> <?=$h?> </p>
        <form action="user_save.php" method="post" id="form_reg" onsubmit="send_form('form_reg');return false;">
            <div id="form_reg_notice" class="form_info middle"></div>
            <p><input type="text" name="email" placeholder="Email" class="middle"/></p>
            <p><input type="password" name="password" placeholder="密码（6~12个字符）" class="middle"></p>
            <p><input type="password" name="password2" placeholder="重复密码" class="middle"></p>
            <p><input type="password" name="Invitation_code" placeholder="邀请码" class="middle"></p>
            <p><input type="submit" value="注册" class="middle-button"></p>
        </form>
        <div class="foot">
        Copyright © 2019 Moecraft All Rights Reserved. &nbsp&nbsp 陕ICP备19013987号 &nbsp&nbsp  Email:h2note@163.com
        </div>
    </div>
</body>
</html>