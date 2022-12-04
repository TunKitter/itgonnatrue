
<?php
session_start();
unset($_SESSION['logged']);
    require_once('../../../config/config.php');
if(isset($_GET['username']) && isset($_GET['password'])) {
    $data =  getOneData('customers','username_customer',$_GET['username']);
}
else if(isset($_GET['account'])){
    setcookie('account', (($_GET['account'])),time() + 60*60*24*3,'/');
    setcookie('username', unserialize(base64_decode($_GET['account']))[0],time() + 60*60*24*3,'/');
    header('location: ../../home/index.php');
    echo $_GET['account'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../styles/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Đăng nhập</title>
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
            left: 55%;
            object-fit: cover;
            z-index: -3;
            object-position: 100% 30% ;
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
            100% {
                top: 10%;
                left: 55%;
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
<link rel="stylesheet" href="../../../styles/detail.css">
</head>
<div id="logo" style="margin-left: 1em;" onclick="location.href = '../../home/'">IGT</div>
<div id="toast"><div id="img">IGT</div><div id="desc">Thêm thành công</div></div>

<img src="https://i.pinimg.com/originals/e7/d8/67/e7d867cacda25b05c3e1bf0219a47a10.gif" alt="">

<center>
        <form onsubmit="return check_login()">
            <h2 style="font-size: 2em">Đăng nhập tài khoản</h2>
            <br>
            <div>
                <label><i class="fa-solid fa-user"></i></label>
                <input type="text"  tabindex="1" name="username" autofocus autocomplete="off">
            </div>
            <div>
        <label><i class="fa-solid fa-key"></i></label>
                <input type="password" tabindex="2"  name="password">
            </div>
            <a href="#" style="color: #4481eb; margin: 3px 2em 0;align-self: flex-end; text-decoration: none;"># Quên mật khẩu</a>
            <button class="btn5 btn5-hover" onclick="check_login()">Đăng nhập</button>
            
            <a href="../signup/"  style="color: lightslategray; margin: 3px 2em 0; text-decoration: none;">Chưa có tài khoản?</a>
        </form>
    </center>
    <script>
        function check_login() {
            if(document.getElementsByName('username')[0].value.length > 3 && document.getElementsByName('password')[0].value.length > 3) {

                let rq = new XMLHttpRequest()
                rq.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status ==200) {
                        checked_login(this.responseText)
                    }
                }
                
                rq.open('GET','login_ajax.php?username=' + document.getElementsByName('username')[0].value + '&password='+ document.getElementsByName('password')[0].value )
                rq.send()
                return false
            }
            else {
                launch_toast('Vui lòng nhập đầy đủ','#e0144c')
                return false

            }

        }
            document.getElementsByTagName('form')[0].style.opacity = 0
            document.getElementsByTagName('img')[0].classList = 'animation'
            document.body.onload  = function() {
                setTimeout(() => {
                    document.getElementsByTagName('form')[0].style.opacity = 1
                    document.getElementsByTagName('input')[0].focus()
                }, 800);
            }
        var inp = document.getElementsByTagName('input')[0]
        inp.oninput = function() {
            if(inp.value.includes(' ')) {
                inp.style.animation = 'wrong 0.5s '
            }
            setTimeout(() => {
                inp.style.animation = 'inherit'
            }, 700);
            
        }
        function launch_toast(text,bg=null) {

    var x = document.getElementById("toast")
    document.getElementById('desc').innerText = text
    if(bg) {
        x.style.backgroundColor = bg
        document.getElementById('img').style.color = bg
    }
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
   
}       

function checked_login(result) {
    switch(result[0]) {
        case '-' : {
            launch_toast('Không được bỏ trống')
            break;
        }
        
        case '0' : {
            launch_toast('Sai tên đăng nhập hoặc mật khẩu')
            break;
        }
        case '1' : {
            launch_toast('Thn')
                location.href  = document.baseURI + '?account=' +result.substring(1)
            break;
        }

    }
}
            </script>
</body>
</html>
