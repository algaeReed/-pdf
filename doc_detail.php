<?php
include 'lib/Parsedown.php';
$md = new Parsedown();

$id = intval( $_REQUEST['id'] );
if( $id < 1 ) die("错误的文档ID");

try
{
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=doc', 'doc', 'doc');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM `doc` WHERE `id` = ? LIMIT 1";

    $sth = $dbh->prepare( $sql );
    $ret = $sth->execute( [ $id ] );
    $doc = $sth->fetch(PDO::FETCH_ASSOC);
    if($doc['is_deleted'] == 1){
         echo $md->text( $doc['url'] . "</br>" ); 
         echo $md->text( ("该文档已经删除" ."</br>") );
         echo $md->text( ("请联系管理员") );
         
        echo  $_SERVER['HTTP_HOST'];
    }elseif ($doc['is_deleted'] == 0) {
    
        // $filename = $doc['url'];
        
        // echo $doc['url'];
        // echo $filename;
        // $fp = fopen("http://app.qqpip.com/upload/$filename", "r");
        // header("Content-type: application/pdf");
        // fpassthru($fp);
        // fclose($fp);
    }
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
    <title>我的文档 | <?=$doc['url'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link rel="shortcut icon" href="image/favicon.ico">
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/main.js"></script>
    
</head>
<body>
    <div class="container">
        <?=$doc['url'] ?>
      <iframe src=" http://app.qqpip.com/upload/<?=$doc['url'] ?> " frameborder="0" scrolling="no" id="external-frame" onload="setIframeHeight(this)" style="width: 100%;height: 1000px"></iframe>

    </div>
</body>
</html>
