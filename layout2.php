<?php
if(!isset($_COOKIE['username'] ))
 {
    header('location: ../home/index.php');
 }
?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $home_path?>/styles/index.css">
    <link rel="stylesheet" href="<?= $home_path?>/styles/<?= $style ?>.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title><?= $title ?></title>
    <style> 
    body {
        overflow-x: hidden;
    }
    #list:nth-child(<?= $index_list ?>) {
        border-left-color: #4481eb !important ; color: #4481eb;
    }
        #personal {
            display: flex;
            align-items:center;
             gap:1em;
              border:1px solid;
              color: lightslategray;
               padding: 10px ;
               border-radius: 7px;
               box-sizing: border-box;
        }
        
</style>
</head>

<body>

    <nav>
        <div id="logo" onclick="location.href = '../home/index.php'">IGT</div>
        <div id="search"><input type="text" placeholder="" spellcheck="false">
            <i class="fa-solid fa-magnifying-glass" style="font-size: 1.4em; color:var(--primary-color)"></i>
        </div>
        <div id="action">
            
        <img src="https://media.istockphoto.com/id/1357548429/vector/winner-medal-with-star-and-ribbon-3d-vector-icon-cartoon-minimal-style-premium-quality.jpg?s=612x612&w=0&k=20&c=hOII9S8YXRpnlGlEi7ig_Jnrctjk5FehXr99-F0w8dU=" id="banner" style="box-shadow: none" width="70px">
            <!-- <button onclick="location.href = '../training/index.php'"
                style="background: #FED049 ;border:none;color:white; border-radius: 4px">Premium</button> -->
            <?php
require_once('../../config/config.php');    

                $check = getOneData('customers','username_customer',$_COOKIE['username'])[0];
            echo '<div id="personal">'. $_COOKIE['username'] . '<img src="../../src/images/customers/'. $check[3] .'" style="width: 35px;height: 35px;border-radius: 50%;"></div>';   
            ?>
            <!-- <i class="fa-solid fa-user-astronaut" style="font-size: 1.7em ;color:var(--primary-color)"></i> -->
        </div>
    </nav>
    <aside>
        <div id="category" style="position: sticky ; top: 1em;">

            <ul style="cursor: pointer">
                <li id="list" onclick="location.href = '../storage/index.php'">Kho từ vựng</li>
                <li id="list" onclick="location.href = '../training/index.php'">Ôn tập</li>
                <li id="list" onclick="location.href = '../ranking/index.php'">Xếp hạng</li>
                <li id="list" onclick="location.href = '../analytic/index.php'">Thống kê</li>
                <li id="list">Khác
                    <ul id="list_item">
                        <li onclick="location.href = '../grammar/index.php'"># Ngữ pháp</li>
                        <li onclick="location.href = '../feedback/index.php'"># Feedback</li>
                        <li onclick="location.href = '../contact/index.php'"># Thông tin liên hệ</li>
                        <li onclick="location.href = '../about/index.php'"># Về chúng tôi</li>
                    </ul>
                </li>
            </ul>

        </div>
<?php
require_once($include_file);
?>