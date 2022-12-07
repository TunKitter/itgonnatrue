<?php
require_once('../../config/config.php');
$learned = getCustomData('SELECT COUNT(voca_mg) FROM vocabulary_manager WHERE level_mg = 5 AND customer_mg =  "'.  $_COOKIE['username']  .'"')[0][0];
$all_learned = getCustomData('SELECT COUNT(voca_mg) FROM vocabulary_manager WHERE customer_mg =  "'.  $_COOKIE['username']  .'"')[0][0];
?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../../styles/storage.css">
    
        <div style="margin-left: -4em">
            <div class="infors">

                <div class="infor"><span><?= $learned ?></span> <span>Từ đã học</span></div>
                <div class="infor"><span><?= $all_learned ?></span> <span>Toàn bộ từ</span></div>
            </div>


            <canvas id="myChart" style="width:100%"></canvas>

            <script>
                var xValues = [0, 1, 2, 3, 4, 5, 6, 7];
                var yValues = [0, 8, 15, 20, 10, 2, 50];

                new Chart("myChart", {
                    type: "line",
                    data: {
                        labels: xValues,
                        datasets: [{
                            fill: false,
                            lineTension: 0,
                            backgroundColor: "white",
                            borderColor: "#4481eb",
                            borderWidth: '2',
                            data: yValues,
                        }]
                        ,
                    },
                    options: {
                        legend: { display: false, position: 'bottom' },
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    color: "rgba(0, 0, 0, 0)",
                                }
                            }],
                            yAxes: [{
                                gridLines: {
                                    color: "rgba(0, 0, 0, 0)",
                                }
                            }]
                        }
                    }
                });
            </script>
            <br><br><br><br>
            <ul id="recommend">
                <li>

                    <h2>Có <span style="color: red">332</span> từ cần ôn lại </h2>
                </li>
                <li>

                    <h2>Theo tiến trình hiện tại thì bạn sẽ học được <span style="color: #4481eb">332</span> từ mỗi
                        tháng </h2>
                </li>
                <li>
                    <h2>Sau <span style="color: #4481eb">1 năm</span> bạn sẽ có thể đạt được vốn từ vựng giao tiếp cơ bản</h2>
                </li>

                <li>
                    <h2>Bạn sẽ đạt được vốn từ vựng giao tiếp nâng cao sau <span style="color: #4481eb">3 năm</span></h2>
                </li>

            </ul>
            <br><br><br>
            <h2 style="font-size: 2em; background: #4481eb; color: white; padding: 10px; border-radius:12px;">Các từ hay sai</h2>
            <div style="margin-left: -1em">

                <div id="controls">
                </div>
                <link rel="stylesheet" href="../styles/storage.css">
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
<br><br><br>
<h2 style="font-size: 2em; background: #4481eb; color: white; padding: 10px; border-radius:12px;">Phân loại theo chủ đề</h2>
    <br><br><br>
            <canvas id="myChart2" style="width:100%"></canvas>

            <script>
                var xValues = ['Red','Blue','Green','Yellow'];
                var yValues = [3, 8, 15, 20];

                new Chart("myChart2", {
                    type: "doughnut",
                    data: {
                        labels: xValues,
                        datasets: [{
                            backgroundColor: ['#277BC0','#AEBDCA','#06283D','#7FBCD2'],
                            data: yValues,
                        }]
                        ,
                    },
                    options: {
                        legend: { display: false},
                    }
                });
            </script>

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

    </script>