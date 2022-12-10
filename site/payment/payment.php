<link rel="stylesheet" href="../../styles/index.css">
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
        }
        h1  {
  background: -webkit-linear-gradient(#eea849, #f46b45);
  display: flex;
  justify-content: center;
  align-items: center;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
        }
        #content {
    transition-duration: 0.5s;
}

#content ul {
    width: 100%;
    list-style: none;
display: flex;  
gap: 2em;
flex-wrap: wrap;
padding: 1em;
}
#content > ul li 
{
    min-width: 30%;
    padding: 2em;
    border-radius: 12px;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    display: flex;
box-sizing: border-box;
align-items: center;
justify-content: space-between;
}
ul li img {
    width: 100px;
}
.pwd {
            background-image: linear-gradient(
        to right,
        #eea849,
        #eea849,
        #f46b45,
        #f46b45
      ) !important;
      box-shadow: 0 4px 15px 0 #eea849 !important;
        }
</style>
</head>

<body>
<?php
require_once('../../config/config.php');    

        ?> 

    <nav>
        <div id="logo" onclick="location.href = '../home/index.php'">IGT</div>
        <div id="search"><input type="text" placeholder="" spellcheck="false">
            <i class="fa-solid fa-magnifying-glass" style="font-size: 1.4em; color:var(--primary-color)"></i>
        </div>
        <div id="action">      
        <img onclick="location.href = '../payment/'" src="https://media.istockphoto.com/id/1357548429/vector/winner-medal-with-star-and-ribbon-3d-vector-icon-cartoon-minimal-style-premium-quality.jpg?s=612x612&w=0&k=20&c=hOII9S8YXRpnlGlEi7ig_Jnrctjk5FehXr99-F0w8dU=" id="banner" style="box-shadow: none" width="70px">
            <!-- <button onclick="location.href = '../training/index.php'"
                style="background: #FED049 ;border:none;color:white; border-radius: 4px">Premium</button> -->
            <?php
            if(isset($_COOKIE['username'] )) {
                $check = getOneData('customers','username_customer',$_COOKIE['username'])[0];
                echo '<div id="personal">'. $_COOKIE['username'] . '<img src="../../src/images/customers/'. $check[3] .'" style="width: 35px;height: 35px;border-radius: 50%;"></div>';   
            }
            ?>
            <!-- <i class="fa-solid fa-user-astronaut" style="font-size: 1.7em ;color:var(--primary-color)"></i> -->
        </div>
    </nav>
    <h1 style="color: lightslategray; text-align: center;">Khách hàng Premium
        <img src="https://cdn.dribbble.com/users/1194206/screenshots/12028922/media/144a31183a201089c07141d49e7ccf40.gif" id="vip" width="100px" style="box-shadow: none"> </h1>
    
        <div id="content">
            <ul>
                <li>
                    <div>

                        <h2>Lưu từ không giới hạn</h2>
                        <br>
                        <p>Lưu không giới hạn từ, <br>giúp tăng hiệu quả học từ vựng</p>
                    </div>
                    <div>
                        <img src="https://cdn.dribbble.com/users/1937255/screenshots/15183465/media/4c01a6d5fe79fbe70624f617aef600af.png?compress=1&resize=1200x900&vertical=top" >
                    </div>
                </li>
                    <li>
                        <div>

                            <h2>Loại bỏ từ</h2>
                            <br>
                            <p>Bạn có thể xoá <br> bất kỳ từ mà bạn đã lưu</p>
                        </div>
                        <div>
                            <img src="https://cdn.dribbble.com/users/129991/screenshots/4739382/media/a355fe186e48e0a17dae14ec8788dc9a.png?compress=1&resize=800x600&vertical=top" >
                        </div>
                    </li>
                <li>
                    <div>

                        <h2>Chế độ tối</h2>
                        <br>
                        <p>Thay đổi màu nền tối <br> giúp mắt đỡ mỏi hơn</p>
                    </div>
                    <div>
                        <img src="data:image/jpeg;base64,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" >
                    </div>
                </li>

            </ul>

        </div>
        <br><br>
        <?php
        if(isset($_COOKIE['username'])) {
            if(getOneData('customers','username_customer',$_COOKIE['username'])[0][5] == 1)  {
               echo '<button class="btn5 btn5-hover pwd" style="display: block; margin: 0 auto;" disabled>Bạn đã là Premium</button>'   ;
            }
            else {
                echo '<button class="btn5 btn5-hover" style="display: block; margin: 0 auto;" onclick="location.href = `index.php`">Tham gia ngay</button>';
            }
        }
        else {
            echo '<button class="btn5 btn5-hover" style="display: block; margin: 0 auto;"la>Đăng nhập ngay</button>';
        }
        ?>
        
        