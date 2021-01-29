<?php
session_start();
if( intval( $_SESSION['uid'] ) < 1 )
{   
    header("Location: user_login.php");
    die("请先<a href='user_login.php'>登入</a>再添加文档"); 
} 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上传文件</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
</head>
<body>

<div class = "container">
    
    <?php include 'header.php' ?>
    <?php include 'text.php' ?>
    <br>
    <h1>上传文件</h1>

    <form action="doc_save.php" method="post"     enctype="multipart/form-data">
        请选择pdf文件：<input type="file" name="file" /><input type="submit" value="上传" />
    <br><br><br>
    <a>*目前仅支持pdf格式 </a>
</div>
</form>
</body>
</html>