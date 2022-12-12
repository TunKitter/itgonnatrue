<?php
require_once('../../config/config.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');

$learned = getCustomData('SELECT COUNT(voca_mg) FROM vocabulary_manager WHERE level_mg = 5 AND customer_mg =  "'.  $_COOKIE['username']  .'"')[0][0] ;
$all_learned = getCustomData('SELECT COUNT(voca_mg) FROM vocabulary_manager WHERE customer_mg =  "'.  $_COOKIE['username']  .'"')[0][0];
$week_word = getCustomData('SELECT week_mg,COUNT(voca_mg) FROM vocabulary_manager WHERE customer_mg = "'. $_COOKIE['username'] .'" AND week_mg > 0 GROUP BY week_mg ORDER BY week_mg');

$week_count  = array(0,0,0,0,0,0,0);
for ($i=0; $i < count($week_word); $i++) { 
    $week_count[$week_word[$i][0]] = $week_word[$i][1];

}
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
                var xValues = [1, 2, 3, 4, 5, 6, 7];
                var yValues = [ <?= $week_count[0] ?>, <?= $week_count[1] ?>, <?= $week_count[2] ?>, <?= $week_count[3] ?>, <?= $week_count[4] ?>, <?= $week_count[5] ?>, <?= $week_count[6] ?>];
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

                    <h2>Có <span style="color: red"><?= getCustomData('SELECT COUNT(voca_mg) FROM vocabulary_manager WHERE customer_mg = "'. $_COOKIE['username']  .'" AND NOT level_mg = 5')[0][0] ?></span> từ cần ôn lại </h2>
                </li>
                <li>

                    <h2>Theo tiến trình hiện tại thì bạn sẽ học được <span style="color: #4481eb"><?= $all_learned*30 ?></span> từ mỗi
                        tháng </h2>
                </li>
                <li>
                    <h2>Sau <span style="color: #4481eb"><?= $all_learned != 0 ? round(1000/($all_learned*30)) : '?' ?> tháng</span> bạn sẽ có thể đạt được vốn từ vựng giao tiếp cơ bản</h2>
                </li>

                <li>
                    <h2>Bạn sẽ đạt được vốn từ vựng giao tiếp nâng cao sau <span style="color: #4481eb"><?= $all_learned != 0 ? round(8000/($all_learned*30)) : '?'?> tháng</span></h2>
                </li>

            </ul>
            <br><br><br>
            <h2 style="font-size: 2em; background: #4481eb; color: white; padding: 10px; border-radius:12px;">Các từ gần đây</h2>
            <div style="margin-left: -1em">

                <div id="controls">
                </div>
                <link rel="stylesheet" href="../styles/storage.css">
                <div id="content">
                    <ul>
                        <?php 
                        $cate = getCustomData('SELECT name_category,count(id_category) FROM category INNER JOIN vocabulary ON id_category = category_voca INNER JOIN vocabulary_manager ON id_voca = voca_mg WHERE customer_mg = "'. $_COOKIE['username']  .'" GROUP BY name_category ');
                        $name_cate = '';
                        $value_cate = '';
                        for ($i=0; $i < count($cate); $i++) { 
                            $name_cate.= '"'.$cate[$i][0]. '",';
                            $value_cate.= '"'.$cate[$i][1]. '",';
                        }
                        $recent = getCustomData('SELECT name_voca FROM vocabulary INNER JOIN vocabulary_manager ON id_voca = voca_mg WHERE customer_mg = "'. $_COOKIE['username']  .'" ORDER BY level_mg LIMIT 10');
                        for ($i=0; $i < count($recent); $i++) { 
                            echo '<li>'. $recent[$i][0]  .'</li>';
                        }
                        ?>
                    </ul>
                </div>


            </div>
<br><br><br>
<h2 style="font-size: 2em; background: #4481eb; color: white; padding: 10px; border-radius:12px;">Phân loại theo chủ đề</h2>
    <br><br><br>
            <canvas id="myChart2" style="width:100%"></canvas>

            <script>
                var xValues = [ <?= $name_cate ?> ];
                var yValues = [ <?= $value_cate ?> ];

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
    