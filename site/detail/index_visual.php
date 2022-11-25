<?php
$title = 'Chi tiết';
?>
<div id="toast"><div id="img">IGT</div><div id="desc">Thêm thành công</div></div>
     
        <div id="content">
        <div>
<span>#adj</span>
<span style="color: #8BBCCC ; margin-left: 1em" > <i class="fa-solid fa-2x fa-play" style="color: lightslategray"></i></span>
                <h2 id="detail_define">Hello 

                    <div style="display: inline-block" onclick="launch_toast()" class="checkbox-wrapper-26">
                        <input type="checkbox" id="_checkbox-26">
                        <label for="_checkbox-26">
                          <div class="tick_mark"></div>
                        </label>
                      </div>

                </h2>
                <h2 id="detail_meaning">Xin chào</h2>
            </div>
            <div>
                <p><ul id="des_word">
                    <li>Việc làm đầu tiên khi gặp một ai đó hoặc muốn bắt đầu một cuộc trò chuyện</li>
                    <li>Chào hỏi người lớn</li>
                    <li>Nhập tìm kiếm của google để truy cập dữ liệu</li>
                </ul></p>
            </div>  
            
            <div>
                <h2 style="font-size: 2em"># Một số ví dụ</h2>
                <div id="example">
                    <br>
                    <ol style="display: flex ; flex-direction: column; gap:1em">
                        <li style="margin-top: 10px">Hi. How <span style="color: #4481eb">Hello</span> you ? <br><br>Xin chào bạn có khoẻ không</li>
                         
                        <li style="margin-top: 10px"><span style="color: #4481eb">Hello</span> . Nice to meet you ?<br><br>Rất vui được gặp bạn  </li>
                        
                        <li style="margin-top: 10px"><span style="color: #4481eb">Hello</span> overthere . My name is Tunkit <br><br>Xin chào bạn có khoẻ không</li>
                    </ol>
                    <br>
                    </div>
                <h2 style="font-size: 2em"># Một số cách dùng</h2>
                <br>
                <div class="usage">
                    <p class="theory">Khi gặp gỡ ai đó lần đầu</p>
                    <div class="line"></div>
                    <p class="example">Hello , Are you fine ?</p>
                </div>
                <div class="usage">
                    <p class="theory">Khi gặp gỡ ai đó lần đầu</p>
                    <div class="line"></div>
                    <p class="example">Hello , Are you fine ?</p>
                </div>
                <div class="usage">
                    <p class="theory">Khi gặp gỡ ai đó lần đầu</p>
                    <div class="line"></div>
                    <p class="example">Hello , Are you fine ?</p>
                </div>
                </div>
       <script>
        function launch_toast() {
    var x = document.getElementById("toast")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
}
      </script>
    
</body>
</html>