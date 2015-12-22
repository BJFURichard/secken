<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");
/**
 * 请先确保您已经执行了table.sql中的语句
 */
$host = '127.0.0.1';  //您的数据库地址，例如：127.0.0.1
$user_name  = 'root';   //连接数据库所需用户名，例如: root
$password = '123';     //连接数据库所需密码, 例如: 123456

//连接数据库
$pdo = new PDO("mysql:host=".$host.";dbname=map", $user_name, $password);

//判断是否来自绑定页面
if(isset($_POST['bind_form'])){
    $user_name = $_POST['username'];
    $pwd = $_POST['pwd'];
    //判断用户名是否存在
    $sql = 'SELECT * FROM `admin` WHERE username = "'.$user_name.'" and userpass = "'.$pwd.'"';

    $resp = $pdo->query($sql);
    $count = count($resp->fetch());
    if($count > 0){
      $affected_rows = $pdo->exec('UPDATE `ADMIN` SET `yangcong_uid`="'.$_SESSION['yangcong_uid'].'" WHERE username = "'.$user_name.'" and userpass = "'.$pwd.'"');
      var_dump($affected_rows);
      if($affected_rows > 0){
          echo '<script>location.href="/datacollect/index.php/angular/mainpage";</script>';
      }else{
          echo '<script>alert("绑定失败，请于管理员联系")</script>';
          echo '<script>location.href="/datacollect/";</script>';
      }
    }else{
        echo "用户名或者密码错误";
    }
}
?>
