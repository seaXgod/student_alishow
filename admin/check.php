<?php
$email = $_POST['email'];
$pwd = $_POST['pwd'];

//验证用户名
//核心： select .. where admin_email = '$email';
//拼接SQL语句
$sql =  "select * from ali_admin where admin_email = '$email'";
//链接SQL服务器并执行SQL语句
include_once '../admin/include/mysqli.php';
//查询 返回的是一维关联数组记得加 'One'

$admin_info = execSql($sql, 'One');

//判断 ---> 先判断用户名（email) 是否为空，为空则用户名不存在，如果有数据，则继续验证密码
//empty() 函数 可以判断一个变量是否为空
if (empty($admin_info)) {
    //为空--->提示用户名不能为空
    echo 2;
} else {
    //不为空--->用户名正确
    //验证密码 
    //核心：这里就可以不用select 来查找判断，可以使用$include_once['admin_pwd'] 是否相等
    if (md5($pwd) == $admin_info['admin_pwd']) {
        //相等，密码正确
        session_start();
        $_SESSION['id'] = $admin_info['admin_id'];
        $_SESSION['email'] = $admin_info['admin_email'];
        $_SESSION['nickname'] = $admin_info['admin_nickname'];
        $_SESSION['pic'] = $admin_info['admin_pic'];
        echo 1;
    } else {
        //密码不相等，提示--->用户名或密码错误
        echo 3;
    }
}
?>