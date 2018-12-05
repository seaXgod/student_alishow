<?php
// echo 'welcome';

//接收数据 --- 这里直接用的Ajax来接收，不需要接收，最后直接返回就好


//拼接SQL语句
$sql = 'select * from ali_admin';

//链接SQL语句，并执行SQL语句
include_once '../include/mysqli.php';
$admin_list = execSql($sql,'All');
//返回结果
echo json_encode($admin_list);
?>                           