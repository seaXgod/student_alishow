<?php 
define('HOST', 'localhost');
define('NAME', 'root');
define('PWD', 'root');
define('DBNAME', 'style');


function execSql ($sql, $type = 'idu') {
    //链接MySQL服务器 & 设置字符集
    $conn = mysqli_connect(HOST, NAME, PWD, DBNAME);
    mysqli_query($conn, 'set names utf8');
    //执行SQL语句
    $result = mysqli_query($conn, $sql);
    //判断$type的类型,不同类型返回不同数据
    if ($type == 'All') {
        $arr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
        return $arr;
    } else if ($type == 'One') {
        return mysqli_fetch_assoc($result);
    } else if ($type == 'idu') {
        return $result;
    }
}

?>