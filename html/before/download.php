<?php

$file_name = $_GET["name"];     // 下载文件名
$file_dir = "f/";        // 下载文件存放目录
if (strpos(realpath($file_dir . $file_name), realpath($file_dir)) !== 0) { // 哥们你心真大，虽然说是自己用的，但是不怕别人乱下载你文件吗
    header("HTTP/1.1 403 Forbidden");
    exit;
}
// 检查文件是否存在
if (!file_exists($file_dir . $file_name)) {
    header('HTTP/1.1 404 NOT FOUND');

} elseif (strpos($file_name, "/") === false) {
    // 以只读和二进制模式打开文件
    $file = fopen($file_dir . $file_name, "rb");

    // 告诉浏览器这是一个文件流格式的文件
    Header("Content-type: application/octet-stream");
    // 请求范围的度量单位
    Header("Accept-Ranges: bytes");
    // Content-Length是指定包含于请求或响应中数据的字节长度
    Header("Accept-Length: " . filesize($file_dir . $file_name));
    // 用来告诉浏览器，文件是可以当做附件被下载，下载后的文件名称为$file_name该变量的值。
    Header("Content-Disposition: attachment; filename=" . $file_name);

    // 读取文件内容并直接输出到浏览器
    echo fread($file, filesize($file_dir . $file_name));
    fclose($file);

    exit ();
} else {
    echo "非法地址";
}
?>