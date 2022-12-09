<?php
if(isset($_GET['name']) && isset($_GET['email']) && isset($_GET['content']))
 {
    insertData('feedback',md5(time()),$_COOKIE['username'] , $_GET['name'],$_GET['content'],$_GET['feedback']);
    header('location:'. $_SERVER['PHP_SELF']);
 }
?>
<link rel="stylesheet" href="../../styles/detail.css">

<div id="toast">
    <div id="img">IGT</div>
    <div id="desc">Xoá thành công</div>
</div>
        <div>
            <div id="feedback" style="margin-left: -5em">
                <img src="../../styles/mail.png" width="40%">
                <form onsubmit="return false">
                <div id="inputs">

                    <h2>Gửi yêu cầu</h2>
                        <input placeholder="Nhập tên" type="text" name="name">
                        <input type="text" placeholder="Nhập email" name="email">
                        <textarea cols="30" name="content" placeholder="Nhập yêu cầu của bạn" rows="10"></textarea>
                        <button class="btn5 btn5-hover" onclick="send_data()" style="width: 530px">Gửi</button>
                    </div>
                </form>
            </div>
        </div>

    </aside>

    <script>
        rd = Math.random()
        if (rd > 0.7) {
            i = 0
            text = 'Tìm kiếm từ vựng ngay . . .'
            var a = document.getElementsByTagName('input')[0];
            const inv = setInterval(() => {
                if (i < text.length) {
                    a.setAttribute('placeholder', a.getAttribute('placeholder') + text[i])
                    i++;
                }
                else {
                    clearInterval(inv)
                }

            }, 60);
        }
        function send_data() {
            launch_toast('Gửi thành công')
            setTimeout(() => {
                document.forms[0].setAttribute('onsubmit','return true')
                document.forms[0].submit()
            }, 2000);
        }
        function launch_toast(text, bg = null) {
        var x = document.getElementById("toast")
        document.getElementById('desc').innerText = text
        if (bg) {
            x.style.background = bg
            document.getElementById('img').style.color = bg

        }
        x.className = "show";
        setTimeout(function () { x.className = x.className.replace("show", ""); }, 5000);
    }
        </script>
    