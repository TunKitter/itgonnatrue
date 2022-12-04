<?php
require_once('../../../config/config.php');
if(isset($_GET['username']) && isset($_GET['password'])) {
    $data = getOneData('customers','username_customer',$_GET['username']);
if(count($data) != 0) {
        if($data[0][1] == $_GET['password']) {
            echo '1'. base64_encode(serialize($data[0]));
        }
        else {
         echo '0'   ;
        }
    }
    else {
        echo '0';

    }
}
else {
    echo '-';
}

?>