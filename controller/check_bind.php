<?php
    session_start();
    header("Content-Type: text/html; charset=UTF-8");
    $yangcong_uid = isset($_POST['yangcong_uid']) ? $_POST['yangcong_uid'] : '';
    /**
     * 请先确保您已经执行了table.sql中的语句
     */
    $host = '127.0.0.1';  //您的数据库地址，例如：127.0.0.1
    $user_name  = 'root';   //连接数据库所需用户名，例如: root
    $password = '123';     //连接数据库所需密码, 例如: 123456
    //连接数据库
    $pdo = new PDO("mysql:host=".$host.";dbname=map", $user_name, $password);
	
    //判断映射表中是否已存在映射关系
    $resp = $pdo->query('SELECT * FROM `admin` WHERE yangcong_uid = "'.$yangcong_uid.'"');
	
    if(count($resp->fetchAll()) > 0){
        echo 1;
    }else{
        $_SESSION['yangcong_uid'] = $yangcong_uid;
        echo 0;
    }
?>
