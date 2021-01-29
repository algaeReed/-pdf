<?php
session_start();
if( intval( $_SESSION['uid'] ) < 1 )
{
    header("Location: user_login.php");
    die("请先<a href='user_login.php'>登入</a>再添加文档"); 
}

$is_login = true;

try
{
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=doc', 'doc', 'doc');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM `doc` WHERE `uid` = ? AND `is_deleted` != 1";

    $sth = $dbh->prepare( $sql );
    $ret = $sth->execute( [ intval( $_SESSION['uid'] ) ] );
    $doc_list = $sth->fetchAll(PDO::FETCH_ASSOC);
}
catch( Exception $Exception )
{
    die( $Exception->getMessage() );
}

?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>我的文档 | h2doc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/main.js"></script>
    
</head>
<body>
    <div class="container">
        <?php include 'header.php' ?>
        <?php include 'text.php' ?>
        <h1>我的文档</h1>
        <p id="hitokoto"> <?=$h?> </p>
        <?php if( $doc_list ): ?>
        <ul class="doc_list">
        <?php foreach( $doc_list  as $item ): ?>
            <li id="rlist-<?=$item['id']?>">
                <span class="num"><?=$item['id']?></span>
                <a href="doc_detail.php?id=<?=$item['id']?>" class="title  middle" target="_blank"><?=$item['url']?></a> 
                <span class="more">
                <a href="doc_detail.php?id=<?=$item['id']?>"  target="_blank"><img src="image/open_in_new.png" alt="查看"></a>
                <a href="javascript:confirm_delete('<?=$item['id']?>');void(0);"><img src="image/close.png" alt="删除"></a>
                </span>
            </li>
        <?php endforeach; ?>
        </ul>
        <?php endif;?>
        <p><a href="doc_add.php" class="doc_add"><img src="image/add.png" alt="添加文档"> 添加文档</a></p>
    </div>
</body>
</html>