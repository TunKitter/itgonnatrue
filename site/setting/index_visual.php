<?php

require_once('../../config/config.php');
if(isset($_GET['pwd_confirm']))
 {
if(getOneData('customers','username_customer',$_COOKIE['username'])[0][1]  == $_GET['pwd_confirm'])
 {
    switch($_GET['del'])
    {
       case 'avatar': {
           editData('customers','image_customer','default.png','username_customer',$_COOKIE['username'] );
           break;
           
       }
       case 'all': {
           deleteData('vocabulary_manager','customer_mg',$_COOKIE['username'] );
           break;
       }
       case 'account': {
           deleteData('feedback', 'customer_feedback',$_COOKIE['username'] );
           deleteData('vocabulary_manager', 'customer_mg',$_COOKIE['username'] );
           deleteData('customers', 'username_customer',$_COOKIE['username'] );
           setcookie('username','',time()-1000,'/');
        setcookie('account','',time()-1000,'/');
        setcookie('sound','',time()-1000,'/');
        setcookie('expiration','',time()-1000,'/');
        header('location: ../form/login/index.php?logout=1');
        break;
    }
}

echo '<script>alert("Thành công")</script>';
}
header('location: '. $_SERVER['PHP_SELF']);
 }
if(isset($_GET['save_day'])) {
    setcookie('account',$_COOKIE['account'],time()+ 60*60* (int) $_GET['save_day'],'/');
    setcookie('username',$_COOKIE['username'],time()+ 60*60*24* (int) $_GET['save_day'],'/');
    setcookie('expiration',$_GET['save_day'],time()+ 60*60*24* (int) $_GET['save_day'],'/');
    if(isset($_GET['sound'])) {
    setcookie('sound',$_COOKIE['sound'] == '1' ? '0' : '1'  ,time()+ 60*60*24*30,'/');
    header('location: '. $_SERVER['PHP_SELF']);
    }
    if(isset($_GET['del']))
     {
        header('location: ' . $_SERVER['PHP_SELF']. '?confirm=1&del='.$_GET['del']);
       
     }
}

?>
<script>
    document.getElementById('category').style.display = 'none'
</script>
<style>
    form {
        display: flex;
        flex-direction: column;
        width: 50vw;
        gap: 1.7em;
    }
    label {
        display: inline-block;
        min-width:300px;
        padding: 10px;
    } 
    select {
        border: none;
    }
    input[type=checkbox] {
        visibility: hidden;
    }
    label[for=sound]::after {
       content: '';
       width: 20px;
       height: 20px;
       background: <?= $_COOKIE['sound'] == '1' ? '#4481eb' : 'red' ?>;
       border-radius: 2px;
       position: relative;
       left: 250;
       display: inline-block;
    }
    button {
        background: white;
        border-width: 1px;
        box-sizing: border-box;
        padding: 10px;
    }
    form input[type=password] {
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
</style>
<div id="container">
    <form>
        <?php
        if(isset($_GET['confirm']))
        {
            echo ' <div style="width:100vw;display:flex;flex-direction:column;gap: 1em; align-items : center">
            <h2>Nhập lại mật khẩu</h2>
            <input id="pwd" type="password" name="pwd_confirm">
            <input  type="hidden" name="del" value="'. $_GET['del'] .'">
            <button class="btn5 btn5-hover">Xác nhận</button>
        </div>';
            die();
        }
        ?>
        <div>
            <label>Lưu tài khoản</label>
            <select name="save_day" onchange="submit()">
            <?php 
            $day = array('1','3','7','14','30');

                for ($i=0; $i < 5; $i++) { 
                    if(isset($_COOKIE['expiration'] )) {
                        if($_COOKIE['expiration'] == $day[$i]) {
                echo '<option value="'. $day[$i]  .'" selected >'. $day[$i] .' ngày</option>';
            }
            else {
                echo '<option value="'. $day[$i]  .'"   >'. $day[$i] .' ngày</option>';

            }
        }
        else {
                        echo '<option value="'. $day[$i]  .'"   >'. $day[$i] .' ngày</option>';

                    }
                }

             
            ?>
            </select>
        </div>
        <div>
            <label for="sound">Âm thanh</label>
            <input id="sound" type="checkbox" name="sound" value="1" onclick="submit()">
        </div>
        <div>
            <label>Xoá ảnh đại diện</label>
            <button name="del" onclick="submit()" value="avatar">Xoá</button>
        </div>
        <div>
            <label>Xoá toàn bộ từ</label>
            <button name="del" onclick="submit()" value="all">Xoá</button>
        </div>
        <div>
            <label>Xoá tài khoản</label>
            <button name="del" onclick="submit()" value="account">Xoá</button>
        </div>

    </form>
</div>
<script>
    function submit() {
        if(confirm('Bạn chắc chắn muốn xoá ?'))
         {
             document.forms[0].submit()
            }
            
    }
</script>
