<?php
//改名
//获取文件后缀
$pos = strrpos($_FILES['f']['name'], '.');
$ext = substr($_FILES['f']['name'], $pos);
//生成新的文件名
$new_file = time(). rand(100000,999999) . $ext;
echo $new_file;
//移动
if (move_uploaded_file($_FILES['f']['tmp_name'], './upload/' . $new_file)) {
    echo '/admin/upload/' . $new_file;
} else {
    echo 2;
}
?>