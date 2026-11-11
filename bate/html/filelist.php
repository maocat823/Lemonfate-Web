<html>

<head>
    <style>
        a {
            display: block;
            color: blue;
        }
    </style>
</head>

<body>
    <?php
    $handler = opendir("./f/");
    while (($filename = readdir($handler)) !== false) { //务必使用!==，防止目录下出现类似文件名“0”等情况
        if ($filename != "." && $filename != "..") {
            echo "<a href=\"download.php?name=" . $filename . "\">" . $filename . "</a><br/>";
        }
    }
    closedir($handler);
    ?>
</body>

</html>