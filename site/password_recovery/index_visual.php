<?php
require_once('../../config/config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$data = '';
if(isset($_COOKIE['username'] )) {
    $data = getOneData('customers','username_customer',$_COOKIE['username'] )[0];
}

if(isset($_POST['otp1']) && isset($_SESSION['otp'])) {
    $user_otp =  $_POST['otp1'].$_POST['otp2'].$_POST['otp3'].$_POST['otp4'].$_POST['otp5'];
    if($user_otp == $_SESSION['otp'])
     {
         $_SESSION['new_password'] = $_SESSION['otp'];
        unset($_SESSION['otp']);
        header('location: '. $_SERVER['PHP_SELF']);
    }
    
}
if(isset($_POST['confirm_mail'])) {
    if(isset($_COOKIE['username'])) {
        if(!($_POST['confirm_mail'] == $data[4])) {
            echo '<script>document.getElementById("category").style.display = "none"</script>';
            header('location: '. $_SERVER['PHP_SELF']);
            die('Sai tài khoản email ');
        }
    }
    else {
        $data = getOneData('customers','email_customer',$_POST['confirm_mail']);
        if($data) {   
            // if(isset($_SESSION['new_password'])) {
            //     $_SESSION['email_check'] = $_POST['confirm_email'];
            // }
            // else {
            //     die('Không có dữ liệu');
            // }
        }
        else {
            echo '<script>document.getElementById("category").style.display = "none"</script>';
            die('Sai tài khoản email ');

         }
    }
    
    require '../../src/PHPMailer/src/Exception.php';
    require '../../src/PHPMailer/src/PHPMailer.php';
    require '../../src/PHPMailer/src/SMTP.php';
$_SESSION['otp'] = rand(10000,99999);
$mail = new PHPMailer(true);
try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'tunkitjava@gmail.com';                     //SMTP username
    $mail->Password   = 'kqehwhmtpudfnxwb';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('igt@contact.com', 'IGT\'s Contact');
    $mail->addAddress($_POST['confirm_mail'], 'User');     //Add a recipient
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Password Recovery';
    $mail->Body    = '<div>
    <h2 style="color: lightslategray;">Yêu cầu mật khẩu mới</h2>
    <p>Bạn đã gửi yêu cầu đổi mật khẩu. Vì vậy, chúng tôi đã gửi cho bạn một mã xác minh để xác nhận bạn là chủ tài khoản. Vui lòng không cung cấp mã này cho ai </p>
    <div style="font-weight: bold;text-align:center; font-size : 2.5em;letter-spacing: 10px">'. $_SESSION['otp'] .'</div>
</div>';
    $mail->send();
    // echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
    }
    



?> 
<style>
    #container {
        display: flex;
        height: 100vh;
        width: 100vw;
        display: flex;
        flex-direction: column;
        margin-top: -5em;
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
    input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
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
      width: 100%;
        }
</style>
<link rel="stylesheet" href="../../styles/detail.css">
<div id="toast"><div id="img">IGT</div><div id="desc">Thành công</div></div>
<div id="container">
    <?php
    if(isset($_SESSION['otp']))
     {
        echo '
        <style>
        input[name^=otp] {
            width:100px;
            text-align:center;
            margin:10px;
        }        
        </style>

        <h2 style="font-size: 1.7em;">Chúng tôi đã gửi cho bạn mã xác nhận</h2>
        <div>
            <form method="POST">
                <br>
            <div>
            <label></i></label>
                <input type="text" maxlength="1" pattern="\d" name="otp1">
                <input type="text" maxlength="1" pattern="\d" name="otp2">
                <input type="text" maxlength="1" pattern="\d" name="otp3">
                <input type="text" maxlength="1" pattern="\d" name="otp4">
                <input type="text" maxlength="1" pattern="\d" name="otp5">
            </div>
          
            <br>
            <div>
                <button class="btn5 btn5-hover pwd">Xác nhận</button>
            </div>
        </form>
        </div>';
     }
     else if(isset($_SESSION['new_password'])) {
        echo '<h2 style="font-size: 1.7em;">Nhập mật khẩu mới</h2>
        <div>
            <form method="POST">
                <br>
            <div>
            <label><i class="fa-solid fa-lock"></i></label>
                <input type="text" name="new_password">
            </div>
                <br>
            <div>
            <label><i class="fa-solid fa-repeat"></i></label>
                <input type="text" name="repeat_password">
            </div>
          
            <br>
            <div>
                <button class="btn5 btn5-hover pwd">Xác nhận</button>
            </div>
        </form>
        </div>';
     }
     else {
        echo '<h2 style="font-size: 1.7em;">Nhập địa chỉ email</h2>
        <div>
            <form method="POST">
                <br>
            <div>
            <label><i class="fa-solid fa-message"></i></label>
                <input type="text" name="confirm_mail">
            </div>
          
            <br>
            <div>
                <button class="btn5 btn5-hover pwd">Xác nhận</button>
            </div>
        </form>
        </div>';
     }
    ?>
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
if(isset($_POST['new_password']) && isset($_POST['repeat_password'])) {
    if($_POST['new_password'] == $_POST['repeat_password']) {
        editData('customers','password_customer',$_POST['new_password'],'username_customer',$_COOKIE['username'] );
        echo '<script>launch_toast()</script>';
        if(isset($_COOKIE['username'] )) {

            header('location: ../infor/index.php');
        }
        else {
            header('location: ../form/login/');

        }
    }
    else {
        echo '<script>launch_toast("Mật khẩu không khớp")</script>';

    }
}
?>