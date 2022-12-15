<?php
$title = 'Chi tiết';
require_once('../../config/config.php');
$data =  getOneData('vocabulary','id_voca',$_GET['w'])[0];
$is_save = false;
if(isset($_GET['view'])) {
    editData('vocabulary','click_voca',getOneData('vocabulary','id_voca',$_GET['w'])[0][6]+ 1 ,'id_voca' , $_GET['w']);
    header('location:' . $_SERVER['PHP_SELF'] . '?w='. $_GET['w']);
}
if(isset($_COOKIE['username'])) {
    $is_save = getCustomData('SELECT voca_mg FROM vocabulary_manager WHERE voca_mg = "'. $_GET['w'] .'" AND customer_mg = "'. $_COOKIE['username']   .'"');
    $is_premium = getCustomData('SELECT admin_customer FROM customers WHERE username_customer = "'. $_COOKIE['username']  .'"')[0][0];
    if(isset($_GET['add']))
    {
        if(!$is_save ) {
            $week = '';
            switch(date('l')) {
                case 'Monday' : {
                    $week = '1';
                    break;
                }
                case 'Tuesday' : {
                    $week = '2';
                    break;
                }
                case 'Wednesday' : {
                    $week = '3';
                    break;
                }
                case 'Thursday' : {
                    $week = '4';
                    break;
                }
                case 'Friday' : {
                    $week = '5';
                    break;
                }
                case 'Saturday' : {
                    $week = '6';
                    break;
                }
                case 'Sunday' : {
                    $week = '7';
                    break;
                }
                }
            
            insertData('vocabulary_manager',$_COOKIE['username'],$_GET['w'],0,$week);
            header('location:' . $_SERVER['PHP_SELF'] . '?w='. $_GET['w']);
        }
        else {
            if($is_premium) {
                global $connect;
                $execute = $connect->prepare('DELETE FROM vocabulary_manager WHERE voca_mg = "'. $_GET['w'] .'" AND customer_mg = "'. $_COOKIE['username'] .'"');
                $execute->execute();
                header('location:' . $_SERVER['PHP_SELF'] . '?w='. $_GET['w']);
            }
        }
 }
}

?>
<style>
    ol li {
        margin-top: 10px;
    }
    ol li span {
        color: #4481eb;
    }
</style>
<link rel="stylesheet" href="../../styles/storage.css">
<div id="toast"><div id="img">IGT</div><div id="desc">Thành công</div></div>
     
        <div id="content">
        <div>
<span>#<?=explode('_',($data[0]))[0] ?></span>
<span style="color: #8BBCCC ; margin-left: 1em" > <i class="fa-solid fa-2x fa-play" style="color: lightslategray; margin-right: 1em;" onclick="pronoun()"></i>  <?= $data[6] ?> <img src="https://icons.veryicon.com/png/o/miscellaneous/two-color-icon-library/user-286.png" width="40px" /></span>
                <h2 id="detail_define"><?=$data[1] ?> 
                
                    <div style="display: inline-block" onclick="launch_toast(<?= $is_save ? '1' : '0' ?>)" class="checkbox-wrapper-26">
                        <input type="checkbox" <?= $is_save ? 'checked disabled' : '' ?> id="_checkbox-26">
                        <label for="_checkbox-26">
                          <div class="tick_mark"></div>
                        </label>
                      </div>
                </h2>
                <h2 id="detail_meaning"><?=$data[3] ?></h2>
            </div>
            <div>
                <p><ul id="des_word">
                    <?php
                    $usage = unserialize(base64_decode($data[4]));
                    for ($i=0; $i < count($usage); $i++) { 
                        echo '<li>'. str_replace('verb','<span style="font-weight:bold">verb</span>', str_replace('somebody','<span style="font-weight:bold">somebody</span>', str_replace('something','<span style="font-weight:bold">something</span>', $usage[$i]))) . '</li>';
                    }
                    ?>
                </ul></p>
            </div>  
            
            <div>
                <h2 style="font-size: 2em"># Một số ví dụ</h2>
                <div id="example">
                    <br>
                    <ol style="display: flex ; flex-direction: column; gap:1em">
                        <?php
                        $example = unserialize(base64_decode($data[5]));
                        for ($i=0; $i < count($example); $i++) { 
                            echo '<li>'. $example[$i][0] .' <br><br>'. $example[$i][1] . '</li>';
                        }
                        ?>
                    </ol>
                    <br>
                    </div>
                    <br><br>
                <h2 style="font-size: 2em"># Từ đồng nghĩa</h2>
                <div id="content">
                    <ul>
                        <?php
                        $same = explode('_',$_GET['w']);
                        $same = $same[count($same)-1];
                        $arr = getCustomData('SELECT id_voca,name_voca FROM vocabulary WHERE id_voca LIKE "%'. $same .'" AND NOT id_voca = "'. $_GET['w'] .'"');
                        if(!$arr) {
                            echo ('Hiện tại chưa có');
                        } 
                        else {

                            for ($i=0; $i < count($arr); $i++) { 
                                echo '<li onclick="location.href= `'. $_SERVER['PHP_SELF'] .'?w='. $arr[$i][0] .'`">'. $arr[$i][1] .'</li>';
                            }
                        }
                            ?>
                    </ul>
                </div>
                <br><br>
                <h2 style="font-size: 2em"># Bạn có thể thích</h2>
                <div id="content">
                    <ul>
                        <?php
                        $same = explode('_',$_GET['w']);
                        $same = $same[count($same)-1];
                        $arr = getCustomData('SELECT id_voca,name_voca FROM vocabulary WHERE category_voca = "'. $data[2] .'" AND NOT id_voca = "'. $_GET['w'] .'" LIMIT 10');
                        for ($i=0; $i < count($arr); $i++) { 
                            echo '<li onclick="location.href= `'. $_SERVER['PHP_SELF'] .'?w='. $arr[$i][0] .'`">'. $arr[$i][1] .'</li>';
                        }
                        ?>
                    </ul>
                </div>
       <script>
        function launch_toast(check) {
            var x = document.getElementById("toast")
            x.className = "show";
            if(check == 1 && ('<?= $is_premium == '0' ? 'true' : ''?>' || <?= getCustomData('SELECT COUNT(voca_mg) FROM vocabulary_mg WHERE customer_mg = "'. $_COOKIE['username']  .'"')[0][0] > 20 ?>)) {
document.getElementById('desc').innerText = "Yêu cầu premium để xoá"
document.getElementById('img').style.color = "#fed049"
document.getElementById('toast').style.background = '#fed049'
}
else {
 setTimeout(() => {
     location.href = '<?= $_SERVER['PHP_SELF'] ?>?w=<?= $_GET['w'] ?>&add=1'
 }, 2000);   
}
setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);

}
var ol = document.getElementsByTagName('ol')[0]
for (let i = 0; i < ol.children.length; i++) {
    ol.children[i].innerHTML = ol.children[i].innerHTML.replace('<?= $data[1] ?>'.toLowerCase(),'<span style="text-transform: lowercase"><?= $data[1] ?></span>').replace('<?= $data[1] ?>','<span><?= $data[1] ?></span>')
}

      </script>
      <?php 
                if(!isset($_COOKIE['username']) ) {
                    echo '<script>document.getElementsByClassName(`checkbox-wrapper-26`)[0].style.display = "none"</script>';
                }
                ?>
    
    <script>
        function pronoun() {
            let intt = new SpeechSynthesisUtterance(document.getElementById('detail_define').innerText)
        speechSynthesis.speak(intt)
        }
    </script>
</body>
</html>