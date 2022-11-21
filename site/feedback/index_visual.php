        <div>
            <div id="feedback" style="margin-left: -5em">
                <img src="../../styles/mail.png" width="40%">
                <div id="inputs">

                    <h2>Gửi yêu cầu</h2>
                    <input placeholder="Nhập tên" type="text">
                    <input type="text" placeholder="Nhập email">
                    <textarea cols="30" placeholder="Nhập yêu cầu của bạn" rows="10"></textarea>
                    <button class="btn5 btn5-hover" style="width: 530px">Gửi</button>
                </div>
            </div>
        </div>

    </aside>

    <script>
        rd = Math.random()
        if (rd > 0.7) {
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
    