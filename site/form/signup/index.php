
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../styles/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Đăng ký</title>
    <style>
        form {
            display: flex;
            height: 100vh;
            flex-direction: column;
            transition-duration: 1s;

            justify-content: center;
            align-items: center;
            width: max-content;
            gap: 1em;
        }

        form input {
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
        }

        img {
            position: absolute;
            /* left: 40%; */
            /* top: 45%; */
            width: 300px;
            height: 130px;
            transform: scale(0.5);
            top: 10%;
            left: 23%;
            object-fit: cover;
            z-index: -3;
            object-position: 100% 30%;
        }

        .animation {
            animation: demo 2s forwards ease-in-out;

        }

        @keyframes demo {
            0% {
                left: 40%;
                top: 45%;
            }

            25% {
                top: 5%;
                left: 40%;

            }

            50% {
                top: 5%;
                left: 55%;
            }

            100% {
                top: 10%;
                left: 23%;
                transform: scale(0.5);
            }
        }

        @keyframes wrong {
            0% {
                transform: translateX(0);
                box-shadow: 0 0 10px #E0144C;
            }

            25% {
                transform: translateX(10px);
            }

            50% {
                transform: translateX(0px);
            }

            75% {
                transform: translateX(10px);
            }

            100% {
                transform: translateX(0px);
            }
        }
    </style>
</head>
<?php
require_once('../../../config/config.php');

if(isset($_GET['username']) && isset($_GET['email']) && isset($_GET['password']) && 
!empty($_GET['username']) && !empty($_GET['email']) && !empty($_GET['password'])
){
    if(!getCustomData('SELECT username_customer FROM customers WHERE username_customer = "'. $_GET['username'] .'" OR email_customer = "'.  $_GET['email'] .'"')) {
        insertData('customers',$_GET['username'],$_GET['password'],$_GET['name'],'default.png',$_GET['email'],0);
        header('location: ../login/index.php?change_admin='.$_GET['username'] );
    }
    else {
        header('location: '.$_SERVER['PHP_SELF'] . '?exist=1' );
    }
}
?>
<div id="logo" style="margin-left: 1em;" onclick="location.href = '../../home/'">IGT</div>

<img src="https://i.pinimg.com/originals/e7/d8/67/e7d867cacda25b05c3e1bf0219a47a10.gif" alt="">

<center>
    <form>
        <h2 style="font-size: 2em">Đăng ký tài khoản</h2>
        <br>
        <div>
            <label><i class="fa-solid fa-id-badge "></i></label>
            <input required type="text" name="name" autocomplete="off" style="text-transform: capitalize;">
        </div>
        <div>
            <label><i class="fa-solid fa-user"></i></label>
            <input required type="text" name="username">
        </div>
        <div>
            <label><i class="fa-solid fa-envelope"></i></label>
            <input required type="email" name="email">
        </div>
        <div>
            <label><i class="fa-solid fa-key"></i></label>
            <input required type="password" minlength="6"    name="password">
        </div>
        <a href="../login/" style="color: #4481eb; margin: 3px 2em 0;align-self: flex-end; text-decoration: none;"># Đã
            có tài khoản?</a>
        <button class="btn5 btn5-hover">Đăng ký</button>

    </form>
</center>
<script>
        document.getElementsByTagName('form')[0].style.opacity = 0
        document.getElementsByTagName('img')[0].classList = 'animation'
        document.body.onload = function () {
            setTimeout(() => {
                document.getElementsByTagName('form')[0].style.opacity = 1
                document.getElementsByTagName('input')[0].focus()
            }, 800);
        }
    var inp = document.getElementsByTagName('input')[1]
    inp.oninput = function () {
        if (inp.value.includes(' ')) {
            inp.style.animation = 'wrong 0.5s '
            
        }
        setTimeout(() => {
            inp.style.animation = 'inherit'
        }, 700);

    }
    inp.onchange = function() {
        if(inp.value.includes(' '))
         {

             inp.value = ''
            }
            }
    

</script>
</body>

</html>