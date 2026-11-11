<?php
if (strpos($_GET["file"], "/") === false) {
    echo "合法";
} else {
    echo "非法地址";
}
?>