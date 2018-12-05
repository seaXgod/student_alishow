<?php
//验证sql语句查询结果是否正确
//设置页号
$pageno = $_POST['pageno'];
//设置每页显示的数量
$pagesize = 3;
$start = ($pageno - 1) * $pagesize;

$sql = "select * from ali_article limit $start, $pagesize";

include_once '../include/mysqli.php';
$list  = execSql($sql, All);

echo json_encode($list);

?>