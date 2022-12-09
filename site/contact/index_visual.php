            <style>
                .box {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    transition-duration: 0.5s;
                    font-size: 1.5em;
                    gap: 1em;
                    color: gray;
                    justify-content: center;
                }
                .box img {
                    transition-duration: 0.5s;
                    width: 240px;
                    border-radius: 22px;

                }
                .box:hover img{
                    /* box-shadow: rgba(243, 152, 186) 0px 1px 30px 0px; */
                    filter: drop-shadow(0 0 10px  var(--color   ) );
                    
                }
                .box:hover {
                    color: var(--color);
                    
                }
            </style>
                <div id="boxes" style="display: flex; gap: 3em ; flex-wrap: wrap; align-items:center;">
                <div class="box" style=" --color : rgba(102,123,243)" onclick="location.href = 'https://www.facebook.com/daienglish.sound/'">
                    <img style="border-radius: 22px;" src="https://img.freepik.com/free-vector/colorful-icons-collection_79603-1270.jpg?w=900&t=st=1668921870~exp=1668922470~hmac=9acb53c5bcd1b57fc0eb1545857b2c2cbbf331be22794fe19cda2c0676dc1c45" >
                    <p>Facebook</p>
                </div>
                <div onclick="location.href = 'https://twitter.com/GrammarUpdates'" class="box" style="--color : rgba(61,205,254)">
                    <img  src="https://img.freepik.com/free-vector/colorful-icons-set-concept_79603-1267.jpg?w=900&t=st=1668922224~exp=1668922824~hmac=038a0dd11b85c995a7732fdaf4a3e18608fbd6fa61b4aff7ac8aab75b4d4bbd5" alt="">
                    <p>Twitter</p>
                </div>
                <div class="box" onclick="location.href = 'https://web.tel.onl/#@OKXOfficial_English'"  style="--color : rgba(243, 152, 186)"  >
                    <img  src="https://img.freepik.com/premium-photo/telegram-icon-screen-smartphone-mobile-phone-3d-render_41204-18020.jpg?w=900" alt="">
                    <p>Telegram</p>
                </div>
                <div class="box" style="--color : rgba(249 182 21);" onclick="clboard(this,'igt@contact.com')" >
                    <img src="https://img.freepik.com/premium-vector/open-envelope-icon-with-notification-number-alarm-symbol-isolated-yellow-background-yellow-bell-sign-with-new-subscriber-social-media-reminder-email-reminder-3d-vector-illustration-style_38364-209.jpg?w=1060" alt="">
                    <p>igt@contact.com</p>
                </div>
                
                <div onclick="clboard(this,'+84342243323')" class="box" style="--color : rgba(109,208,188);"  >
                    <img  src="https://img.freepik.com/free-photo/yellow-telephone-receiver-turquoise-background_181624-60649.jpg?w=900&t=st=1668924176~exp=1668924776~hmac=bdb4d7b8c8db74dca957e3e7f66853fa0bada9073fbf3467a8f0efa9526fbb4e" height="140px">
                    <p>+84 342 243 323</p>
                </div>
                <div class="box" style="--color :transparent ; opacity: 0.29;"  >
                    <img  src="https://img.freepik.com/free-vector/colorful-coming-soon-background_23-2148889963.jpg?w=900&t=st=1668924708~exp=1668925308~hmac=b2a41f72f02429fa3a112ab38a6875efb59ec9610d3f1565aa5d503c432aee68" height="140px">
                    <p style="color: whitesmoke !important">Đang cập nhật</p>
                </div>
                
            </div>
        </div>


    </aside>

    <script>
        function clboard(obj,text) {
            navigator.clipboard.writeText(text)
            obj.style.opacity= '0.5'
            obj.children[1].innerText = 'Đã lưu';

        }
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
        
    </script>