<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $home_path?>/styles/index.css">
    <link rel="stylesheet" href="<?= $home_path?>/styles/<?= $style ?>.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>It's gonna true</title>
    <style> 
    #list:nth-child(<?= $index_list ?>) {
        border-left-color: #4481eb !important ; color: #4481eb;
    }
</style>
</head>

<body>

    <nav>
        <div id="logo">IGT</div>
        <div id="search"><input type="text" placeholder="" spellcheck="false">
            <i class="fa-solid fa-magnifying-glass" style="font-size: 1.4em; color:var(--primary-color)"></i>
        </div>
        <div id="action">
            <button onclick="location.href = '../training/index.php'"
                style="background: #4481eb ;color:white; border-radius: 4px">Ôn tập ngay</button>
            <button>Đăng nhập</button>
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
                        <li onclick="location.href = './grammar.html'"># Ngữ pháp</li>
                        <li onclick="location.href = './feedback.html'"># Feedback</li>
                        <li onclick="location.href = './contact.html'"># Thông tin liên hệ</li>
                        <li onclick="location.href = './about.html'"># Về chúng tôi</li>
                    </ul>
                </li>
            </ul>

        </div>
<?php
require_once($include_file);
?>