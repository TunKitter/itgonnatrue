<div style="margin-left: -120px">
    <div class="section"
        style="display: flex; justify-content: center; align-items: center;flex-direction: column; margin-top: 7em;">
        <h2>Bạn đang có <span style="color: #4481eb">
                <?= getCustomData('SELECT COUNT(voca_mg) FROM vocabulary_manager WHERE customer_mg = "'. unserialize(base64_decode($_COOKIE['account']))[0]    .'" AND level_mg = 0')[0][0] ?>
            </span> từ cần ôn tập</h2>
        <button class="btn5 btn5-hover" onclick="start_training()">Ôn tập</button>
    </div>



</div>
</div>


</aside>

<script>
    var audio = new Audio('<?= $home_path ?>/styles/audio/correct.mp3')
     
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
    var check = true
    var index = 0
    li = document.querySelectorAll('#control li')
    for (let i = 0; i < li.length; i++) {
        li[i].onclick = function () {
            li[index].style.color = 'black'
            li[i].style.color = '#4481eb'
            index = i
            document.getElementsByTagName('hr')[0].style.left = ((3.5 + (17 * i) - ((i == 5 ? 3 : 0))).toString() + '%')
            document.getElementById('content').style.opacity = 0

            setTimeout(() => {
                document.getElementById('content').innerHTML = '<ul>\
                        <li>Demo 1</li>\
                        <li>Demo 2</li>\
                        <li>Demo 3</li>\
                        <li>Demo 6</li>\
                        <li>Demo 7</li>\
                        <li>Demo 8</li>\
                        <li>Demo 9</li>\
                        <li>Demo 10</li>\
                    </ul>'
                document.getElementById('content').style.opacity = 1
            }, 300);
        }
    }

    function correct(obj) {
        obj.style.background = '#2cbc63'
        obj.style.color = 'white'
        audio.play()
        document.getElementsByClassName('question')[0].style.background = '#2cbc63'
        setTimeout(() => {
            document.getElementsByClassName('section')[0].style.display = 'none'
        }, 1000);
        setTimeout(() => {
            document.getElementsByTagName('div')[5].innerHTML = getLayout(1)
        }, 1100);
    }
    function getLayout(key) {
        switch (key) {
            case 0: {
                return '<div class="section">\
                    <div class="question">\
                    <p>Hello</p>\
                    </div>\
                    <div class="answer">\
                    <button onclick="correct(this)">Xin chào</button>\
                    <button onclick="correct(this)">Cảm ơn</button>\
                    <button onclick="correct(this)">Tạm biệt</button>\
                    <button onclick="correct(this)">Vâng ạ</button>\
                    </div>\
                    </div>'
                break
            }
            case 1: {
                return ' <div class="section">\
                    <br><br>\
<div class="question">\
                    <p>Hello</p>\
                </div>\
                <br><br>\
                <div class="answer">\
                    <input type="text" id="answer" oninput="check_typing(this)" placeholder="Nhập đáp án" spellcheck="false">\
                </div>\
            </div>'
                break
            }

        }
    }
    function start_training() {
        document.getElementsByTagName('div')[5].innerHTML = getLayout(0)
    }
    function check_typing(obj) {
        if (obj.value == 'Xin chao') {
            document.getElementsByClassName('question')[0].style.background = '#2cbc63'
            audio.play()
            setTimeout(() => {
                
                document.getElementsByTagName('div')[5].innerHTML = getLayout(0)
            }, 1100);
        }
    }
</script>