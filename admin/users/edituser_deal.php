<?php
//接收表单数据 
$id = $_POST['id'];
$slug = $_POST['slug'];
$nickname = $_POST['nickname'];
$state = $_POST['state'];

//拼接SQL语句
$sql = "update ali_admin set admin_slug = '$slug',admin_nickname= '$nickname', admin_state = '$state' where admin_id = '$id' ";

//链接SQL服务器，并执行SQL语句
include_once '../include/mysqli.php';
$result = execSql($sql);
//返回结果
echo $result ? 1 : 2;
?>