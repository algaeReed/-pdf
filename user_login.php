<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>用户登入 | h2Note</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <script src="js/jquery-3.1.1.min.js"></script>
    <link rel="shortcut icon" href="image/favicon.ico">
    <script src="js/main.js"></script>
</head>
<body>
    <div class="container">
        <?php $is_login=false;include 'header.php' ?>
        <?php include 'text.php' ?>
        <h1>用户登入</h1>
        <p id="hitokoto"> <?=$h?> </p>
        <form action="user_login_check.php" method="post" id="form_login" onsubmit="send_form('form_login');return false;">
            <div id="form_login_notice" class="form_info middle"></div>
            <p><input type="text" name="email" placeholder="Email" class="middle"/></p>
            <p><input type="password" name="password" placeholder="密码（6~12个字符）" class="middle"></p>
            <p><input type="submit" value="登入" class="middle-button"></p>
        </form>
    </div>
</body>
</html>