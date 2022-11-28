<div id="content">
            <div id="slideshow">
                <img src="<?= $home_path?>/src/images/banner.gif" id="banner">
</div>
<br>
<br>
<div id="login_require">

    <h2>Đăng nhập để khám phá nhiều tính năng</h2>
    <br>
    <a href="#"><button class="btn5-hover btn5">Đăng nhập</Button></a>
</div>
<br>
<br>
<div id="content_words">
    <?php
    require_once('../../config/config.php');
    $data = getAllData('vocabulary');
    for ($i=0; $i < count($data); $i++) { 
        echo '<div onclick="detail(this)" oncontextmenu="remove_item(this)"  class="word_item">
        <div>
            <p class="define">'. $data[$i][1] .'</p>
            <p class="meaning">'. $data[$i][3] .'</p>
        </div>
        <div class="interaction">
            <p>#adj</p>
            <p style="text-align: center">'. $data[$i][5] .'</p>    
            <!-- <i class="fa-solid fa-plus fa-2xl"></i> -->
            <img src="../../src/images/category/id'. $i .'.jpeg" width="30px">

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
            document.location.href = '../detail/index.php' 
        }       
    </script>