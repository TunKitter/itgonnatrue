<?php
if(!isset($_COOKIE['username'] ))
 {
    header('location: ../home/index.php');
 }

require_once('../../global.php');
require_once('../../config/config.php');
$title = 'It\'s gonna true';
$style = 'index';
if(isset($_GET['change_pwd'])) {
    $include_file = 'password.php';
}
else {

    $include_file = 'index_visual.php';
}
require_once('../../layout.php');
?>
