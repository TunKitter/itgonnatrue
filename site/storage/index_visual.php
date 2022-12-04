<style>
    body {
        overflow: auto !important;
    }
</style>
<?php
require_once('../../config/config.php');
$data = getCustomData('SELECT voca_mg,level_mg FROM vocabulary_manager WHERE customer_mg = "'. unserialize( base64_decode( $_COOKIE['account']))[0] .'"');
$words = array(array(),array(),array(),array(),array(),array());
for ($i=0; $i < count($data); $i++) { 
    $words[$data[$i][1]][count($words[$data[$i][1]])] = $data[$i][0];
}
$index_count = 0;

// var_dump($words[0]);
// echo '<br>';
// var_dump($words[1]);
// echo '<br>';
// var_dump($words[2 ]);
?>
        <div>
            <div id="controls">
                <ul id="control">
                    <li style="color: #4481eb">Chưa học <i class="fa-solid fa-circle-xmark "></i></li>
                    <li>Mức độ 1</li>
                    <li>Mức độ 2</li>
                    <li>Mức độ 3</li>
                    <li>Mức độ 4</li>
                    <li>Đã học <i class="fa-solid fa-check-circle"></i></li>
                </ul>
                <hr>
            </div>
            <div id="content">

            </div>

        </div>



    <script>
        rd = Math.random()
        if(rd > 0.7) {
            i = 0 
            text = 'Tìm kiếm từ vựng ngay . . .'
            var a = document.getElementsByTagName('input')[0];
            const inv = setInterval(() => {
                if(i < text.length) {
                    a.setAttribute('placeholder',a.getAttribute('placeholder')+text[i])
                    i++;
                }
                else {
                    clearInterval(inv)
                }
                
            }, 60);
        }
        var check = true
        var index = 0
        var voca = ['','','','','','']
        li = document.querySelectorAll('#control li')
        for (let i = 0; i < li.length; i++) {
            li[i].onclick = function () {
                li[index].style.color = 'black'
                li[i].style.color = '#4481eb'
                index = i
                document.getElementsByTagName('hr')[0].style.left = ((3.5 + (17 * i) - ((i == 5 ? 3 : 0))).toString() + '%')
                document.getElementById('content').style.opacity = 0

                setTimeout(() => {
                    document.getElementById('content').innerHTML = voca[i]
                    document.getElementById('content').style.opacity = 1
                }, 300);
            }
        }
       
        
    </script>
    <?php
    echo '<script>';
    for ($i = 0; $i < 6; $i++) {
        $temp = '';
        for ($j=0; $j < count($words[$i]) ; $j++) { 
            $temp .= '<li>'.  getOneData('vocabulary','id_voca', $words[$i][$j])[0][1] .'</li>';
        };
        echo 'eval("voca['.$i .'] = `<ul>'.$temp. '</ul>` ");';
    }   
    echo '</script>';
    ?>
    <script>
        document.getElementById('content').innerHTML = voca[0]
    </script>
    