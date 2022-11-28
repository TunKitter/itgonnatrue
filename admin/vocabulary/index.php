<?php
require_once('../../global.php');
$title = 'Tất cả từ';
$index_list = 3;
if(isset($_GET['v'])) {
    $include_file = 'detail.php';
}
else {
    $include_file = 'index_visual.php';
}
require_once('../../layout3.php');
?>
