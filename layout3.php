<?php
if(isset($_COOKIE['username']))
 {
    if(!($_COOKIE['username'] == 'Tunkit'))
     {
         header('location: ../../site/home/index.php');
        }
    }
    else {
        
      header('location: ../../site/home/index.php');
 }
?>
<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$home_path?>/styles/index.css">
    <link rel="stylesheet" href="<?=$home_path?>/styles/<?= $style ?>.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title><?= $title ?></title>
    <style> 
    body {
        overflow-x: hidden;
    }
    #list:nth-child(<?= $index_list ?>) {
        border-left-color: #4481eb !important ; color: #4481eb;
    }
</style>
</head>

<body>
    
    <nav>
        <div id="logo" onclick="location.href = '../home/index.php'">IGT</div>
        <div id="search" style="visibility: hidden"><input  placeholder="" type="text" spellcheck="false">
            <i class="fa-solid fa-magnifying-glass" style="font-size: 1.4em; color:var(--primary-color)"></i>
        </div>
        <div id="action">
            <!-- <button onclick="location.href = '../storage/index.php'">Đăng xuất<sup style="background-color: #4481eb; color: white; padding: 4px; border-radius: 10% ">1</sup> </button> -->
            <i class="fa-solid fa-user-astronaut" style="font-size: 1.7em ;color:var(--primary-color)"></i>
            <button onclick="location.href = '../../site/home/index.php'">Trang khách hàng</button>
        </div>
    </nav>
    <aside>
        <div id="category" style="position: sticky ; top: 1em;">

            <ul style="cursor: pointer">
                <li id="list" onclick="location.href = '../home/'">Thống kê</li>
                <li id="list" onclick="location.href = '../category'">Loại từ</li>
                <li id="list" onclick="location.href = '../vocabulary'">Tất cả từ</li>
                <li id="list" onclick="location.href = '../customers'">Người dùng</li>
                <li id="list" onclick="location.href = '../feedback'">Feedback</li>
                <li id="list" onclick="location.href = '../bill'">Hoá đơn thanh toán</li>
                <!-- <li id="list">Sắp xếp theo
                    <ul id="list_item">
                        <li># Mới nhất</li>
                        <li># Lưu nhiều nhất</li>
                        <li># Xem gần đây</li>
                    </ul>
                </li> -->
            </ul>
            
        </div>
        <div>
        <?php
        require_once($include_file);
        ?>
        </div>