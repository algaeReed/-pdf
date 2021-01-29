<?php

error_reporting( E_ALL & ~E_NOTICE );

$email = trim( $_REQUEST['email'] );
$password = trim( $_REQUEST['password'] );
$password2 = trim( $_REQUEST['password2'] );
$Invitation_code = trim( $_REQUEST['Invitation_code'] );

if( strlen( $email ) < 1 ) die("Email 地址不能为空");
if( mb_strlen( $password ) < 6 ) die("密码不能短于6个字符");
if( mb_strlen( $password ) > 12 ) die("密码不能长于12个字符");
if( strlen( $password2 ) < 1 ) die("重复密码不能为空");

if( $password != $password2 ) die("两次输入的密码不一致");

if( strlen( $Invitation_code ) < 1 ) die("Invitation_code is null");
if( $Invitation_code != 'code' ) die("Invitation_code is fault");



if( !filter_var( $email , FILTER_VALIDATE_EMAIL ) )
{
    die("Email 地址错误");
}

try
{
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=doc', 'doc', 'doc');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    
    $sql = "INSERT INTO `user` ( `email` , `password` , `created_at` ) VALUES ( ? , ? , ? )";

    $sth = $dbh->prepare( $sql );
    $ret = $sth->execute( [ $email , password_hash( $password , PASSWORD_DEFAULT ) , date( "Y-m-d H:i:s" )  ] );
    
    die("用户注册成功<script>location='user_login.php'</script>");
}

catch( Exception $Exception )
{
    die( $Exception->getMessage() );
}
