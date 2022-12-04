<?php
$title = 'Chi tiết';
require_once('../../config/config.php');
$data =  getOneData('vocabulary','id_voca',$_GET['w'])[0];
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
<div id="toast"><div id="img">IGT</div><div id="desc">Thêm thành công</div></div>
     
        <div id="content">
        <div>
<span>#<?=explode('_',($data[0]))[0] ?></span>
<span style="color: #8BBCCC ; margin-left: 1em" > <i class="fa-solid fa-2x fa-play" style="color: lightslategray; margin-right: 1em;"></i>  19 <img src="https://icons.veryicon.com/png/o/miscellaneous/two-color-icon-library/user-286.png" width="40px" /></span>
                <h2 id="detail_define"><?=$data[1] ?> 
                    <div style="display: inline-block" onclick="launch_toast()" class="checkbox-wrapper-26">
                        <input type="checkbox" id="_checkbox-26">
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
        function launch_toast() {
    var x = document.getElementById("toast")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
}
var ol = document.getElementsByTagName('ol')[0]
for (let i = 0; i < ol.children.length; i++) {
    ol.children[i].innerHTML = ol.children[i].innerHTML.replace('<?= $data[1] ?>'.toLowerCase(),'<span style="text-transform: lowercase"><?= $data[1] ?></span>').replace('<?= $data[1] ?>','<span><?= $data[1] ?></span>')
}
      </script>
    
</body>
</html>