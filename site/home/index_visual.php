<link rel="stylesheet" href="../../styles/detail.css">
<div id="toast"><div id="img">IGT</div><div id="desc">Thêm thành công</div></div>

<?php
session_start();
require_once('../../global.php');
if(isset($_COOKIE['account']) && !isset($_SESSION['logged'])) {
    echo '<script>launch_toast("Đăng nhập thành công","rgb(44, 188, 99)")</script>';
    $_SESSION['logged'] = '1';
}
?>

<style>
    
    .cate_img {
        width: 30px;
        transform: scale(2);
    }
    
</style>
     <!-- Vip icon -->
        <!-- <img src="https://cdn.dribbble.com/users/1194206/screenshots/12028922/media/144a31183a201089c07141d49e7ccf40.gif" id="banner"> -->
<div id="content">
        
    <?php
    if(isset($_COOKIE['account'])) {
        echo '<div id="slideshow">
        <img src="https://cdn.dribbble.com/users/1322388/screenshots/7901618/media/c1a7ce419922d38ce18f90d4daac9c47.jpg?compress=1&resize=1200x900&vertical=top" id="banner" width="90%" style="box-shadow: initial">

</div>
<br>
<br>
<div id="login_require"><h2>Tham gia ranking để nhận free <span style="color: #FED049">Premium User</span></h2><br>
        <a href="#"><button class="btn5-hover btn5"  style="background-image: initial;
        background-color: #FED049;
    box-shadow: 0 4px 15px 0 #FED049;">Tham gia</Button></a>';
    }
    else {
        echo ' <div id="slideshow">
         <img src="' .$home_path. '/src/images/banner.gif" id="banner"> 
</div>
<br>
<br>
<div id="login_require"><h2>Đăng nhập để khám phá nhiều tính năng</h2><br><a href="#"><button class="btn5-hover btn5" onclick="location.href = `'.  $home_path .'/site/form/login/index.php`">Đăng nhập</Button></a>';
    }
    ?>
    
      
</div>
<br>
<br>

<div id="content_words">
    <?php
    $data = getAllData('vocabulary');
    for ($i=0; $i < count($data); $i++) { 
        echo '<div onclick="detail(`'. $data[$i][0] .'`)" oncontextmenu="remove_item(this)"  class="word_item">
        <div>
            <p class="define">'. $data[$i][1] .'</p>
            <p class="meaning">'. $data[$i][3] .'</p>
        </div>
        <div class="interaction">
            <p>#'. explode('_',($data[$i][0]))[0] .'</p>
            <p style="text-align: center">'. unserialize(base64_decode($data[$i][5]))[0][0]  .'</p>    
            <!-- <i class="fa-solid fa-plus fa-2xl"></i> -->
            <img src="../../src/images/category/'. getOneData('category','id_category',$data[$i][2])[0][2] .'" class="cate_img">

        </div>
    </div>
    ';
    }
    ?>
    
    </div>
    
</div>
        </div>
    </aside>
    <script>
        function remove_item(obj) {
            event.preventDefault()
            obj.style.background = '#019267'
            obj.style.color = 'white'
                obj.style.transform = 'scale(0)'
            setTimeout(() => {
                obj.style.display = 'none'
            }, 400);
        }
        function detail(obj) {
            document.location.href = '../detail/index.php?w='+obj 
        }       
    </script>