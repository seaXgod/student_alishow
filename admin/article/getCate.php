<?php
//这里是页面刚加载时发送的请求

//拼接SQL语句
$sql = 'select * from ali_cate where cate_state = 1';
//链接SQL服务器，并执行SQL语句
include_once '../include/mysqli.php';
$cate_list =  execSql($sql,'All');
//返回前端
echo json_encode($cate_list);
?>