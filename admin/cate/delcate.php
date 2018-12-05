<!-- <meta charset="utf-8"> -->
<?php
header('content-type:text/html;charset=utf-8');
//1.接收数据 cate_id
//前面提交时有 ？ 或者提交的时候是用字符串拼接的都用接收
$cate_id = $_GET['id'];

//2.拼接SQL语句
$sql = "delete from ali_cate where cate_id = $cate_id";
//3.链接MySQL并执行SQL语句
include_once "../include/mysqli.php";
$result = execSql($sql);
//4.处理SQL执行结果  --提示成功/失败，页面跳转
//这里不管是否添加成功还是失败，都将跳转到点击删除按钮的页面categories.php
if ($result) {
    echo '删除成功';
} else {
    echo '删除失败';
}
header('refresh:2;url=categories.php');

?>