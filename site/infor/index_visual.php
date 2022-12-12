<?php

require_once('../../config/config.php');
$data = getOneData('customers','username_customer',$_COOKIE['username'] )[0];
if( isset($_POST['mail']) || isset($_FILES['img']))
 {
    if(isset($_FILES['img']['tmp_name'])) {
        if($data[3] != 'default.png') {
            move_uploaded_file($_FILES['img']['tmp_name'],'../../src/images/customers/'. getOneData('customers','username_customer',$_COOKIE['username'] )[0][3]);
        }
        else {
            editData('customers','image_customer',$_COOKIE['username'] . explode('/',$_FILES['img']['type'])[1],'username_customer',$_COOKIE['username']);
            move_uploaded_file($_FILES['img']['tmp_name'],'../../src/images/customers/'. $_COOKIE['username'] . explode('/',$_FILES['img']['type'])[1]);

        }
    }
    editData('customers','email_customer',$_POST['mail'],'username_customer',$_COOKIE['username'] );
    editData('customers','name_customer',$_POST['name'],'username_customer',$_COOKIE['username'] );
    header('location:'. $_SERVER['PHP_SELF']);
 }
?> 
<style>
    #container {
        display: flex;
        height: 100vh;
        width: 100vw;
        display: flex;
        flex-direction: column;
        margin-top: 6em;
        justify-content: flex-start;
        align-items: center;
        position: relative;
    }
    #container > img:not(#bg) {
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    border-radius: 50%;
    width: 100px;
    height: 100px;
    border: 2px solid white;
    background: white;
    }
    #container h2 {
        font-size: 2.4em;
        color: lightslategray;
    }
    
    #bg {

        border-radius: 12px;
        position: absolute;
        top: -120;
        z-index: -1;
        /* height: 200px; */
        width: 1000px;
        height: 200px;
        object-fit: cover;
        opacity: 0.9;
    }
   label ~ input {
            width: 500px;
            font-family: inherit;
            height: 50px;
            border: none;
            border-radius: 12px;
            padding: 10px 20px;
            color: lightslategray;
            box-sizing: border-box;
            outline: none;
            letter-spacing: 1px;
            font-weight: bold;
            font-size: 1.2em;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
        }
        div label {
            display: inline-block;
            min-width: 30px;
            text-align: left;

        }
        input[type=file]::-webkit-file-upload-button {
            display: none;
        }
        .pwd {
            background-image: linear-gradient(
        to right,
        #FB2576,
        #FB2576,
        #FB2576,
        #FB2576
      ) !important;
      box-shadow: 0 4px 15px 0 #FB2576 !important;
        }
</style>
<link rel="stylesheet" href="../../styles/detail.css">
<div id="toast"><div id="img">IGT</div><div id="desc">Thành công</div></div>
<div id="container">

    <img src="../../src/images/customers/<?= $data[3] ?>" alt="">
    <img src="https://cdn.dribbble.com/users/3474264/screenshots/16996313/media/be641bbbe991ad8b99f270991112df25.png?compress=1&resize=1200x900&vertical=top" id="bg">
    
    
    <br><br>
    <h2><?= $data[2] ?></h2>
    <br>
    <div>
            <form method="POST" enctype="multipart/form-data">
            <label><i class="fa-solid"></i></label>
            <input type="text"  style="box-shadow: none;background: none;color: #FB2576;"  onchange="uploaded(this)" tabindex="1" value="#<?= $data[0] ?>"  autocomplete="off">
        </div>
        <br>
        <div>
        <label><i class="fa-solid fa-user"></i></label>
            <input type="text" onchange="uploaded(this)" value="<?= $data[2] ?>" tabindex="2"  name="name">
        </div>
        <br>
        <div>
        <label><i class="fa-solid fa-message"></i></label>
            <input type="text" onchange="uploaded(this)" value="<?= $data[4] ?>" tabindex="2"  name="mail">
        </div>
        <br>
        <div>
        <label><i class="fa-solid fa-image"></i></label>
            <input type="file"  onchange="uploaded(this)" tabindex="3"  name="img">
        </div>
        <br>
        <div>
            <button class="btn5 btn5-hover pwd" onmouseover ="document.forms[0].onsubmit = function() {return false}" onclick="location.href = `<?= $_SERVER['PHP_SELF'] ?>?change_pwd=1`" value="1">Đổi mật khẩu</button>
            <button class="btn5 btn5-hover" onmouseover ="document.forms[0].onsubmit = function() {return true}" id="confirm" style="transition-duration: 0.4s;opacity: 0">Lưu thay đổi</button>
        </div>
    </form>
    </div>
<script>
    document.getElementById('category').style.display = 'none'
    function uploaded(obj) {
        document.getElementById('confirm').style.opacity = '1'
        obj.style.background = '#4481eb'
        obj.style.color = 'white'
    }
    function launch_toast(text) {
            var x = document.getElementById("toast")
            if(text) {
                document.getElementById('desc').innerText = text
            }
            x.className = "show";
setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
}
</script>
<?php
if(isset($_SESSION['new_password']))
{
echo '<script>launch_toast()</script>';
unset($_SESSION['new_password']);
}
?>