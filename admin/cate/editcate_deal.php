<?php
header('content-type:text/html;charset=utf-8');
//1.接收数据
$id = $_POST['id'];
$name = $_POST['name'];
$slug = $_POST['slug'];
$icon = $_POST['icon'];
$state = $_POST['state'];
$show = $_POST['show'];

//2.拼接SQL语句 改--- update
$sql = "update ali_cate set cate_name = '$name',cate_slug = '$slug',cate_icon = '$icon',cate_state = $state,cate_show = $show where cate_id = $id"; 

//3。链接mysql服务器，并执行SQL语句
include_once "../include/mysqli.php";
$result = execSql($sql);

//4.处理sql结果，判断修改是否成功，页面跳转 
if($result) {
    echo "修改栏目信息成功";
    header('refresh:2;url=categories.php');
} else {
    echo "修改栏目信息失败";
    header('refresh:2;url=editcate.php');

}

?>