<?php
header('content-type:text/html;charset=utf-8');
//接收表单提交数据
$name = $_POST['name'];
$slug = $_POST['slug'];
$icon = $_POST['icon'];
$state = $_POST['state'];
$show = $_POST['show'];
//还有一个要按 年-月-日 来显示的日期 可以抵用data加时间戳
//如果参数二是当前时间点time(),可以不填
$time = date('Y-m-d');
//拼接SQL语句  insert into
$sql = "insert into ali_cate value(null,'$name','$slug','$time','$icon',$state,$show)";
//链接MySQL服务器，并执行SQL
//这一步相当于调用，来执行SQL语句
include_once '../include/mysqli.php';
//执行
//这里由于是增删改的增，第二个值默认就是'idu'，所以可以不用写
$result = execSql($sql);
//增删改返回的都是布尔值，所以下面来判断是否泰添加成功
if($result) {
    echo '添加成功';
    header('refresh:2;url=categories.php');
} else {
    echo '添加失败';
    header('refresh:2;url=addcate.php');

}


?>