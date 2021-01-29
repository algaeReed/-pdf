<?php


$upload = "upload";
if(!is_dir($upload)){
    mkdir(iconv("UTF-8", "GBK", $upload),0777,true);
}  


// 允许上传的图片后缀
// $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf","doc","docx");

$allowedExts = array("pdf");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);  

session_start();
if( intval( $_SESSION['uid'] ) < 1 )
{
    header("Location: user_login.php");
    die("请先<a href='user_login.php'>登入</a>再添加文档"); 
} 

error_reporting( E_ALL & ~E_NOTICE );

try
{
// 获取文件后缀名
if ( 
        ($_FILES["file"]["type"] == "application/pdf")
        && ($_FILES["file"]["size"] < 512000000 )    // 小于 500 MB
        && in_array($extension, $allowedExts)
    )
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
        echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
        echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] ."<br>";
      
        $item = $_FILES["file"]["type"];
        $url =  $_FILES["file"]["name"];
        echo $item;
        echo $url;
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=doc', 'doc', 'doc');

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO `doc` ( `item` , `url` , `uid` , `created_at` ) VALUES ( ? , ? , ? , ? )";

    $sth = $dbh->prepare( $sql );
    $ret = $sth->execute( [ $item , $url , intval( $_SESSION['uid'] ) , date( "Y-m-d H:i:s" )  ] );
    
        // die("文档保存成功<script>location='doc_list.php'</script>");
    
    
    
        if (file_exists("upload/" . $_FILES["file"]["name"]))
        {
            echo $_FILES["file"]["name"] . " 文件已经存在。" ."<br>";
        }
        else
        {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
            echo "文件存储在: " . "upload/" . $_FILES["file"]["name"]."<br>";
            //  die("文档保存成功<script>location='doc_list.php'</script>");
            
        }
    }
}
else
{
    echo "非法的文件格式";
}
}
catch( Exception $Exception )
{
    die( $Exception->getMessage() );
}