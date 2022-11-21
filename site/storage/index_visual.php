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
                <ul>
                    <li>Hello</li>
                    <li>Abstract</li>
                    <li>Trial</li>
                    <li>Hacker</li>
                    <li>Something</li>
                    <li>Angular</li>
                    <li>Headshort</li>
                    <li>Training</li>
                    <li>Guitar</li>
                    <li>Name</li>
                </ul>
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
    </script>