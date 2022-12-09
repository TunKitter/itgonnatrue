<?php
require_once('../../config/config.php');
$data = getOneData('customers','username_customer',$_COOKIE['username'] )[0];

?> 
<style>
    #container {
        display: flex;
        height: 100vh;
        width: 100vw;
        display: flex;
        flex-direction: column;
        margin-top: 6em;
        justify-content: center;
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
      width: 100%;
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
        <form method="POST">
        <div>
        <label><i class="fa-solid fa-lock"></i></label>
            <input type="text" name="old">
        </div>
        <br>
        <div>
        <label><i class="fa-solid fa-unlock"></i></label>
            <input type="text" name="new">
        </div>
        <br>
        <div>
        <label><i class="fa-solid fa-repeat"></i></label>
            <input type="text" name="repeat">
        </div>
        <br>
        <div>
            <a href="../password_recovery/index.php" style="text-decoration:none; color: #FB2576; margin-left: 2em;">Quên mật khẩu</a>
        </div>
        <br>
        <div>
            <button class="btn5 btn5-hover pwd">Đổi mật khẩu</button>
        </div>
    </form>
    </div>
<script>
    document.getElementById('category').style.display = 'none'
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
if( isset($_POST['new']) && isset($_POST['old']) && isset($_POST['repeat']) ){
    if($_POST['old'] == $data[1]) {
        editData('customers','password_customer',$_POST['new'],'username_customer',$_COOKIE['username'] );
        header('location:'. $_SERVER['PHP_SELF']);
    }
    else {
        echo '<script>launch_toast("Mật khẩu không đúng")</script>';

    }
 }
?>