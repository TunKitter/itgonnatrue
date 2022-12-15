<?php
require_once('../../global.php');
$title = 'Hoá đơn';
$index_list = 6;
if(isset($_GET['v'])) {
    $include_file = 'detail.php';
}
else {
    $include_file = 'index_visual.php';
}
require_once('../../layout3.php');
?>
