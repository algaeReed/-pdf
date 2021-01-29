

<?php
error_reporting( E_ALL & ~E_NOTICE );
session_start();
$is_login = intval( $_SESSION['uid'] ) < 1 ? false:true;

try
{
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=doc', 'doc', 'doc');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //分页
    $page = $_GET["page"]??1;
  
    
    $limit = $dbh->query("SELECT COUNT(*) FROM doc;");
    $rows = $limit->fetch();
    $rowCount = $rows[0];
    
    $num = 10;
    $totalpage = ceil( $rowCount/$num );
    // echo $totalpage;
    
      if($page > $totalpage){
          $page = $totalpage;
      }
     

    $start = ($page - 1) * $num;
    if($start < 0){
        $page = 1;
        $start = 0;
    }
    $sql = "SELECT * FROM `doc`  WHERE `is_deleted` != 1 limit $start,10";
    //   die();
  
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
    <title>共享文档 | doc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <script src="js/jquery-3.1.1.min.js"></script>
    <link rel="shortcut icon" href="image/favicon.ico">
    <meta name=”description” content=”H2doc Is A Simple Online doc... ”>
    <meta name=”keyword” content=共享文档 | doc，—“>
    <script src="js/main.js"></script>
</head>
<body>
    <div class="container">
        <?php include 'header.php' ?>
        <?php include 'text.php' ?>
        <script> javascript:checkLoading();</script>
        <h1>共享文档</h1>
        <p id="hitokoto"> <?=$h?> </p>
        <?php if( $doc_list ): ?>
        <ul class="doc_list">
        <?php foreach( $doc_list  as $item ): ?>
            <li id="rlist-<?=$item['id']?>">
                <span class="num"><?=$item['id']?></span>
               <a href="doc_detail.php?id=<?=$item['id']?>" class="title  middle" target="_blank"><?=$item['url']?></a> 
               <span class="more">
                   <a href="doc_detail.php?id=<?=$item['id']?>"  target="_blank"><img src="image/open_in_new.png" alt="查看"></a>
               </span>
            </li>
        <?php endforeach; ?>
        </ul>
         <a href="?page=1">首页</a>
         <a href="?page=<?php echo $page -1 ?>">&lt;&lt;&lt;</a>
         
         <a href="">第</a>
         <a href=""><?php echo $page ?> </a>
         <a href="">页</a>
         
         <a href="?page=<?php echo $page +1?>">&gt;&gt;&gt;</a>
         <a href="?page=<?php echo $totalpage;?>">尾页</a>
            
        <?php endif;?>
        <div class="foot">
        © 2021 ，All rights reserved.  
        </div>
    </div>
</body>
<div  style="display:none">
    <script  type="text/javascript" src="http://s4.cnzz.com/z_stat.php?id=1277892319&web_id=1277892319"></script>
</div>
</html>

