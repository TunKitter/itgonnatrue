<?php
$data = (getCustomData('SELECT voca_mg,level_mg FROM vocabulary_manager WHERE level_mg = "'. getCustomData('SELECT MIN(level_mg) FROM vocabulary_manager WHERE customer_mg = "'. $_COOKIE['username']   .'" ')[0][0]   .'" AND customer_mg = "' .  $_COOKIE['username']  .'"'));
if(isset($_GET['trained'])) {
  $arrrr =  (explode('_',rtrim($_GET['trained'],'_')));
  for ($i=0; $i < count($data); $i++) { 
    if($arrrr[$i] == '0') {
        if($data[$i][1] != '0') {
            editData('vocabulary_manager','level_mg',$data[$i][1]-=1 , 'voca_mg',$data[$i][0]);
        }
    }
    else {
        if($data[$i][1] != '5') {
            editData('vocabulary_manager','level_mg',$data[$i][1]+=1 , 'voca_mg',$data[$i][0]);
        }

    }
  }
  header('location: ' . $_SERVER['PHP_SELF']);
}
?>
<style>
    .circle {
        width: 250px;
        height: 250px;
        border-radius: 50%;
        background: conic-gradient(#4481eb 3.6deg, white 0deg);
        animation: demoo 1s;
        position: relative;
        font-size: 1.4em;
    }

    .circle p {
        position: absolute;
        top: 110;
        left: 100;
        animation: change 2s forwards;
    }

    .res_text {
        animation: fade 2s forwards ;
    }
    @keyframes fade {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    @keyframes change {
        from {
            color: black;
        }

        to {
            color: #4481eb;
        }
    }

    .circle::before {
        content: '';
        width: 230px;
        border-radius: 50%;
        left: 10;
        top: 10;
        height: 230px;
        background: white;
        position: absolute;
    }

    #finish {
        display: flex;
        flex-direction: column;
        align-items: center;
        row-gap: 10px;
    }
</style>
<div style="margin-left: -120px">
    <div class="section"
        style="display: flex; justify-content: center; align-items: center;flex-direction: column; margin-top: 7em;">
        <h2>Bạn đang có <span style="color: #4481eb">
                <?= count($data) ?>
            </span> từ cần ôn tập</h2>
            <?php
            if(count($data) != 0) {
                echo '<button class="btn5 btn5-hover" onclick="start_training()">Ôn tập</button>';
            }
            else {
                echo '<br>Hãy lưu từ để ôn tập';
            }
            ?>
    </div>



</div>
</div>
</aside>

<script>
    var audio = new Audio('<?= $home_path ?>/styles/audio/correct.mp3')
    var wrong = new Audio('<?= $home_path ?>/styles/audio/wrong.mp3')

    if (Math.random() > 0.7) {
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
    var total_count = <?= count($data) ?>;
    var count = 0;
    var result = []
    function correct(obj) {
        result.push(1)
        obj.style.background = '#2cbc63'
        obj.style.color = 'white'
        audio.play()
        document.getElementsByClassName('question')[0].style.background = '#2cbc63'
        setTimeout(() => {
            document.getElementsByClassName('section')[0].style.display = 'none'
        }, 1000);
        setTimeout(() => {
            count++;
            document.getElementsByTagName('div')[5].innerHTML = getLayout(Math.random() > 0.5 ? 1 : 0)

        }, 1100);
    }
    function getLayout(key) {
        if (total_count == count) {
            key = 2
        }
        switch (key) {
            case 0: {
                let btn = '';
                let rdd = parseInt(Math.random() * 4)
                let j = 0
                for (let i = 0; i < 4; i++) {
                    if (i == rdd) {
                        btn += '<button onclick="correct(this)">' + meaning[count] + '</button>'
                    }
                    else {
                        btn += '<button onclick="incorrect(this)">' + rd[count][j] + '</button>'
                        j++;
                    }

                }
                return '<div class="section">\
                    <div class="question">\
                    <p>' + arr[count] + '</p>\
                    </div>\
                    <div class="answer">'+ btn + '</div>\
                    </div>';

                break
            }
            case 1: {
                return ' <div class="section">\
                    <br><br>\
<div class="question">\
                    <p>'+  arr[count] +'</p>\
                </div>\
                <br><br>\
                <div class="answer">\
                    <input type="text" id="answer" oninput="check_typing(this)" placeholder="Nhập đáp án" spellcheck="false">\
                </div>\
            </div>'
                break
            }
            default: {

                setTimeout(() => {
                    finish()
                }, 10);
                return '<div id="finish">\
<div class="circle">\
    <p>1%</p>\
</div>\
<br>\
<p class="res_text">Bạn đã ôn được <span id="cr_w" style="color: white; font-weight: bold">10</span> từ</p>\
<p class="res_text">Số từ cần ôn lại : <span id="wr_w" style="color: white; font-weight: bold">3</span></p>\
<button class="btn5 btn5-hover" onclick="save_progess()">Tiếp tục</butoon>\
</div>'
            }

        }
    }
    function start_training() {

        document.getElementsByTagName('div')[5].innerHTML = getLayout(Math.random() > 0.5 ? 1 : 0)

    }
    function check_typing(obj) {
        if (obj.value == meaning[count]) {
            result.push(1)
            document.getElementsByClassName('question')[0].style.background = '#2cbc63'
            count++
            audio.play()
            setTimeout(() => {
                document.getElementsByTagName('div')[5].innerHTML = getLayout(0)
            }, 1100);
        }
        
    }
    function incorrect(obj) {
        result.push(0)
        obj.style.background = '#E0144C'
        obj.style.color = 'white'
        wrong.play()
        document.getElementsByClassName('question')[0].style.background = '#E0144C'
        setTimeout(() => {
            document.getElementsByClassName('section')[0].style.display = 'none'
        }, 1000);
        setTimeout(() => {
            count++;
            document.getElementsByTagName('div')[5].innerHTML = getLayout(Math.random() > 0.5 ? 1 : 0)
        }, 1100);
    }
    function finish() {
        let i = 0;
        let circle = document.getElementsByClassName('circle')[0]
        let value_circle = document.getElementsByTagName('p')[0]
        let count_true = 0
        for (let j = 0; j < result.length; j++) {
            if(result[j] == true) {
count_true++
            }
        }
        let cr = Math.ceil(100/result.length)*count_true 
        cr = cr > 100 ? 100 : cr
        // alert(cr)    
        let aa = setInterval(() => {
            circle.style.background = 'conic-gradient(#4481eb ' + i + 'deg, white 0deg)'
            if(i <= cr) {
                    value_circle.innerText = i + '%'
                }
            i += 2
            if (i > (3.6 * (100/result.length))*count_true) {
                value_circle.innerText = cr + '%'
                document.getElementById('cr_w').innerText = count_true
                document.getElementById('cr_w').style.color = '#4481eb'
                document.getElementById('wr_w').innerText = result.length - count_true
                document.getElementById('wr_w').style.color = '#e0144c'
                                clearInterval(aa)
            }
        }, 10);
    }
    function save_progess() {
        let txt_result = ''
        for (let i = 0; i < result.length; i++) {
            txt_result+= result[i] + '_'   
        }
        location.href = '<?= $_SERVER["PHP_SELF"] ?>?trained='+ txt_result  
    }

</script>
<?php
 $txt = '[';
 $rd = '[';
 $meaning = '[';
 for ($i=0; $i < count($data); $i++) { 
    $t = getCustomData('SELECT name_voca,meaning_voca FROM vocabulary WHERE id_voca = "'. $data[$i][0]. '"')[0];
     $txt.= "'".  $t[0] ."',";
     $meaning.= "'".$t[1] ."',";
 }

 for ($i=0; $i < count($data); $i++) { 
    $rd.= '[';
    for($j = 0 ; $j < 3 ; $j++) {
        $sds = rand(1,getCustomData('SELECT COUNT(id_voca) FROM vocabulary')[0][0]-1);
        $ss = getCustomData('SELECT meaning_voca FROM vocabulary LIMIT '. $sds-1 . ','. $sds)[0][0];
        $rd.= "'". $ss ."',";
    } 
    $rd.= '],';
    }
 $txt.= ']';
 $meaning.= ']';
 $rd .= ']';
     echo '<script>
     var arr = '. $txt .';
     var rd = '. $rd .';
     var meaning = '. $meaning .';
     </script>';
?>