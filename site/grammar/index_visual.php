        <div id="content">
            <a href="#1">Câu so sánh</a>
            <a href="#2">Câu ước</a>
            <a href="#3">Mệnh đề quan hệ</a>
            <a href="#4">Câu điều kiện</a>
            <a href="#5">Từ loại</a>
            <a href="#6">Khác</a>
            <a href="#7">Câu so sánh</a>
            <a href="#8">Câu ước</a>
            <a href="#9">Mệnh đề quan hệ</a>
            <a href="#10">Câu điều kiện</a>
            <a href="#11">Từ loại</a>
            <a href="#12">Khác</a>
            <a href="#13">Câu so sánh</a>
            <a href="#14">Câu ước</a>
            <a href="#15">Mệnh đề quan hệ</a>
            <a href="#16">Đề thi 9</a>
            <a href="#17">Đề thi 10</a>
            <a href="#18">Đề thi 11</a>
            <a href="#19">Đề thi 12</a>
            <a href="#20">Đề thi 13</a>
            <a href="#21">Đề thi 14</a>
            <a href="#22">Đề thi 15</a>
            <a href="#23">Đề thi 16</a>
            <a href="#24">Đề thi 17</a>
            <a href="#25">Đề thi 18</a>
            <a href="#26">Đề thi 19</a>
            <a href="#27">Đề thi 20</a>
            <a href="#28">Đề thi 21</a>
                </div>

    </aside>

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
    </script>