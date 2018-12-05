<?php
//接收表单数据
$email = $_POST['email'];
$slug =  $_POST['slug'];
$nickname = $_POST['nickname'];
$password = md5($_POST['password']);
$state =  $_POST['state'];

//拼接SQL语句
$sql = "insert into ali_admin(admin_id,admin_email,admin_slug,admin_nickname,admin_pwd,admin_state)values(null,'$email','$slug','$nickname','$password','$state')";
//链接服务器，并执行SQL语句
include_once '../include/mysqli.php';
$result = execSql($sql);


//返回布尔型
echo $result ? 1: 2;
//最后将数据写入到ali_admin表，

?>