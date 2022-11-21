       <div style="margin-left: -120px">
            
            <div class="section">

                <div class="question">
                    <p>Hello</p>
                </div>
                <div class="answer">
                    <button onclick="correct(this)">Xin chào</button>
                    <button onclick="correct(this)">Cảm ơn</button>
                    <button onclick="correct(this)">Tạm biệt</button>
                    <button onclick="correct(this)">Vâng ạ</button>
                </div>
            </div>
            <div class="section">
<br><br>

                <div class="question">
                    <p>Hello</p>
                </div>
                <br><br>
                <div class="answer">
                    <input type="text" id="answer" placeholder="Nhập đáp án" spellcheck="false">
                </div>
            </div>
        </div>
        </div>


    </aside>

    <script>
        document.getElementsByClassName('section')[1].style.display = 'none'

                var audio = new Audio('<?= $home_path ?>/styles/audio/correct.mp3')
        document.getElementById('answer').oninput = function() {
            if(document.getElementById('answer').value == 'Xin chao') {
                document.getElementsByClassName('question')[1].style.background = '#2cbc63'
                audio.play()
                // document.getElementsByClassName('question')[1].style.background = '#CB2027'
            }
        }
        if(Math.random() > 0.7) {
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
     
        function correct(obj){
            obj.style.background = '#2cbc63'
            obj.style.color = 'white'
            audio.play()
            document.getElementsByClassName('question')[0].style.background = '#2cbc63'
            setTimeout(() => {
                document.getElementsByClassName('section')[0].style.display = 'none'
            }, 1000);
            setTimeout(() => {
                document.getElementsByClassName('section')[1].style.display = 'block'
            }, 1100);
        }
    </script>