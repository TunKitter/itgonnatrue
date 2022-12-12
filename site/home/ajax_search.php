<?php

if(isset($_GET['s']))
{
    if($_GET['s'] != '') {

        require_once('../../config/config.php');
        $data = getCustomData('SELECT name_voca,image_category,id_voca FROM vocabulary INNER JOIN category ON category_voca = id_category WHERE name_voca LIKE "'. $_GET['s'] .'%" LIMIT 3');
        for ($i=0; $i < count($data); $i++) { 
            echo '<li onclick="location.href =`../detail/index.php?w='. $data[$i][2] .'`">'. $data[$i][0] .' <img src="../../src/images/category/'. $data[$i][1] .'" width="50px"/></li>';
        }
    }
}
?>
