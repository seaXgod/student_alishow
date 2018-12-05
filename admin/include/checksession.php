<?php
//检测session
session_start ();
if (empty($_SESSION['id'])) {
    //为空就说明未登录
    echo '您尚未登陆，请登录后再访问';
    header('refresh:2;url=/admin/login.html');
    die();
}
?>