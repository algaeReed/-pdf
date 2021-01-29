<?php
session_start();
if( intval( $_SESSION['uid'] ) < 1 )
{
    header("Location: user_login.php");
    die("请先<a href='user_login.php'>登入</a>再添加文档"); 
}

$id = intval( $_REQUEST['id'] );
if( $id < 1 ) die("错误的筆記ID");

try
{
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=doc', 'doc', 'doc');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE `doc` SET `is_deleted` = 1 , `url` = CONCAT( `url` , ? ) WHERE `id` = ? AND `uid` =  ? LIMIT 1";
    $sth = $dbh->prepare( $sql );
    $ret = $sth->execute( [ '_DEL_'.time() , $id , intval( $_SESSION['uid'] ) ]  );

    die("done");
}
catch( Exception $Exception )
{
    die( $Exception->getMessage() );
}