<?php
ob_start();
require_once('../../config/config.php');
$top10 = getCustomData('SELECT id_voca,name_voca FROM vocabulary ORDER BY click_voca DESC LIMIT 10');
session_start();
$is_premium = false;
if(isset($_COOKIE['username'] )) {
    $is_premium  = getOneData('customers','username_customer',$_COOKIE['username'])[0][5];
}
if(isset($_GET['view']))
 {
    header('location: '. $_SERVER['PHP_SELF']. '?w='.$_GET['w']);
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
    <style>
        body {
            overflow-x: hidden;
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
    </style>
    <title><?= $title ?></title>
</head>

<body>
    
    <nav>
        <div id="logo" onclick="location.href ='../home/index.php'">IGT</div>
        <div id="search"><input placeholder="" type="text" spellcheck="false">
            <i class="fa-solid fa-magnifying-glass" style="font-size: 1.4em; color:var(--primary-color)"></i>
        </div>
        <div id="action">
            <button style="visibility: <?= isset($_COOKIE['account'] ) ? 'visible' : 'hidden' ?>" onclick="location.href = '../storage/index.php'">Kho từ vựng </button>
            <?php
            if($is_premium) {
                echo '<img src="https://cdn.dribbble.com/users/1194206/screenshots/12028922/media/144a31183a201089c07141d49e7ccf40.gif" id="vip" width="100px" style="box-shadow: none">';
            }
            ?>
            
            <?php
require_once('../../config/config.php');    

            if(isset($_COOKIE['username'])) {
                $check = getOneData('customers','username_customer',$_COOKIE['username'])[0];

                    echo '<div id="personal">'. $_COOKIE['username'] . '<img src="../../src/images/customers/'. $check[3] .'" style="width: 35px;height: 35px;border-radius: 50%;"> <ul id="more">
                        <li onclick="location.href = `../infor/index.php`"><i class="fa-solid fa-user"></i></li>
                        <li><i class="fa-solid fa-bars"></i></li>
                        '. ($_COOKIE['username'] == 'Tunkit'  ? '<li onclick="location.href = `../../admin/home/`" ><i class="fa-solid fa-user-astronaut"></i></li>' : '') .
                        '<li onclick="log_out()"><i class="fa-solid fa-sign-out"></i></li>
                    </ul> </div>';
                    // die('<script>alert("Phát hiện việc chỉnh sửa cookie");document.body.innerHTML= "<img src=\"https://cdn.dribbble.com/users/272763/screenshots/4576659/astronaut-600x800.gif\" style=\" display:block; margin : 0 auto \"  />"</script>');
            }
            else {
                echo '<button onclick="location.href = `../form/login/`">Đăng nhập</button>';
            }
            ?>
        </div>
            <!-- <i class="fa-solid fa-user-astronaut" style="font-size: 1.7em ;color:var(--primary-color)"></i> -->
        </div>
    </nav>
    <aside>
        <div id="category" style="position: sticky ; top: 1em;">

            <ul style="cursor: pointer">
                <li id="list">Danh mục
                    <ul id="list_item">
                        <?php
                        $cate = getCustomData('SELECT id_category,name_category FROM category INNER JOIN vocabulary ON id_category = category_voca GROUP BY id_category ORDER BY COUNT(id_category) DESC LIMIT 5');
                        for ($i=0; $i < count($cate); $i++) { 
                            echo '<li onclick="location.href = `'. $_SERVER['PHP_SELF'] .'?cate='. $cate[$i][0].'`">'.  $cate[$i][1] .'</li>';
                        }
                        ?>
                    </ul>
                </li>
                <li id="list">Sắp xếp theo
                    <ul id="list_item">
                        <li onclick="location.href = `index.php?filter=0`"># A - Z</li>
                        <li onclick="location.href = `index.php?filter=1`"># Xem nhiều nhất</li>
                        <li onclick="location.href = `index.php?filter=2`"># Đã lưu</li>
                    </ul>
                </li>
            </ul>
            <div style="position: relative">
               <div id="top10" style="opacity: 1">
                    <ul style="color:gray">
                    <?php
                        
                        for ($i=0; $i < count($top10); $i++) { 
                            echo '<li onclick="location.href = `../detail/index.php?w='. $top10[$i][0] .'`">'.  $top10[$i][1] .'</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div>
        <?php
        require_once($include_file);
        ?>
        </div>
<script>
    document.getElementsByTagName('nav')[0].style.position = 'relative'
    document.getElementsByTagName('nav')[0].style.zIndex = 10
           rd = Math.random()
        if(rd > 0.7) {
            i = 0 
            text = 'Tìm kiếm từ vựng ngay . . .'
            var a = document.getElementsByTagName('input')[0];
            const inv = setInterval(() => {
                if(i < text.length) {
                    a.setAttribute('placeholder',a.getAttribute('placeholder')+text[i])
                    i++;
                }
                else {
                    clearInterval(inv)
                }
                
            }, 60);
        }
 function log_out() {
    if(confirm('Bạn chắc chắn muốn đăng xuất ? '))
       {
        location.href = '../form/login/index.php?logout=1'
       }
 }
 
</script>
<?php
ob_end_flush();
?>