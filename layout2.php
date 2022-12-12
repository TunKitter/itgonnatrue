<?php
$_COOKIE['dark'] = isset($_COOKIE['dark']) ? $_COOKIE['dark'] : '"demo"' ;

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
               position: relative;
        }
        #more {
            list-style: none;
            position: absolute;
            top: 0;
            left: 0;
            overflow: hidden;
            display: flex;
            /* flex-direction: column; */
            display: none;
            transform: translateY(55px);
        }
        #more li  {
            padding: 10px;
            border: 1px solid transparent;
        }
        #more li:hover {
            transition-duration: 0.4s;
         color :#4481eb;
            /* color: white; */
        }
        #personal:hover #more {
            display: flex;
        }
        #category ul  {
            list-style: none;
        }
    
</style>
</head>

<body>

    <nav>
        <div id="logo" onclick="location.href = '../home/index.php'">IGT</div>
        <div id="search" style="visibility: hidden;"><input type="text"  placeholder="" spellcheck="false">
            <i class="fa-solid fa-magnifying-glass" style="font-size: 1.4em; color:var(--primary-color)"></i>
        </div>
        <div id="action">   
        <img onclick="location.href = '../payment/payment.php'" src="../../src/vip_badge.png " id="banner" style="box-shadow: none" width="70px">
            <!-- <button onclick="location.href = '../training/index.php'"
                style="background: #FED049 ;border:none;color:white; border-radius: 4px">Premium</button> -->
            <?php
    ob_start();

require_once('../../config/config.php');    

                $check = getOneData('customers','username_customer',$_COOKIE['username'])[0];
                echo '<div id="personal">'. $_COOKIE['username'] . '<img src="../../src/images/customers/'. $check[3] .'" style="width: 35px;height: 35px;border-radius: 50%;"> <ul id="more">
                <li onclick="location.href = `../infor/index.php`"><i class="fa-solid fa-user"></i></li>
                <li onclick="location.href = `../setting/index.php`"><i class="fa-solid fa-bars"></i></li>
                '. ($_COOKIE['username'] == 'Tunkit'  ? '<li onclick="location.href = `../../admin/home/`" ><i class="fa-solid fa-user-astronaut"></i></li>' : '') .
                '<li onclick="log_out()"><i class="fa-solid fa-sign-out"></i></li>
            </ul> </div>';
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
<script>
    function log_out() {
    if(confirm('Bạn chắc chắn muốn đăng xuất ? '))
       {
        location.href = '../form/login/index.php?logout=1'
       }
 }

 var is_dark = <?=  ($_COOKIE['dark'])   ?>;
            if(is_dark == 'true') {
                document.head.innerHTML+= '<link rel="stylesheet" href="../../styles/darkmode_index.css">'
                document.cookie = 'dark="true";path=/'
        is_dark = "false"  

            } 
            else {
           document.head.innerHTML = document.head.innerHTML.replace('<link rel="stylesheet" href="../../styles/darkmode_index.css">','')
           document.cookie = 'dark="false";path=/'
        is_dark = "true"
 

        }
            
        

</script>