<?php
// echo '123';
//删除

//接收数据
$admin_id = $_GET['id'];
//拼接SQL语句
$sql = "delete from ali_admin where admin_id = $admin_id";
//链接SQL服务器，并执行SQL语句
include_once '../include/mysqli.php';
$result = execSql($sql);
//返回结果
echo $result ? 1: 2;

?>