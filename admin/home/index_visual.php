<?php
require_once('../../config/config.php');
$top = getCustomData('SELECT voca_mg,COUNT(voca_mg) FROM vocabulary_manager GROUP BY voca_mg ORDER BY COUNT(voca_mg) DESC LIMIT 10');
$click = getCustomData('SELECT name_voca,click_voca FROM vocabulary GROUP BY id_voca ORDER BY click_voca DESC LIMIT 10');
$top_cate = getCustomData('SELECT name_category,sum(click_voca) FROM vocabulary INNER JOIN category ON id_category = category_voca GROUP BY category_voca ');
$top_customer = getCustomData('SELECT customer_mg,COUNT(customer_mg) FROM vocabulary_manager GROUP BY customer_mg ORDER BY count(customer_mg) DESC LIMIT 1');
$category = getCustomData('SELECT name_category,COUNT(id_voca) FROM category INNER JOIN vocabulary ON id_category = category_voca GROUP BY name_category');
$cate_text = '[';
$cate_number = '[';
for ($i=0; $i < count($category); $i++) { 
    $cate_text.= '"'. $category[$i][0] . '",';
    $cate_number.= ''. $category[$i][1] . ',';
}
$cate_number .= ']';
$cate_text .= ']' ;
$count_word = array();
$top_word_name = array();
$top_click_name = array();
$click_word_name = array();
for ($i=0; $i < count($click); $i++) { 
    $top_click_name[count($top_click_name)] =  $click[$i][0];
    $click_word_name[count($click_word_name)] = $click[$i][1];
}
for ($i=0; $i < count($top); $i++) { 
    $count_word[count($count_word)] =  $top[$i][1];
    $top_word_name[count($top_word_name)] = getOneData('vocabulary','id_voca',$top[$i][0])[0][1];
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../../styles/storage.css">
    <style>
.infors {
    flex-wrap: wrap;
}
#controls hr {
    width: 400px;
}
#controls {
    position: relative;
}
#category {
}
</style>
    
        <div style="margin-left: -4em">
            <div class="infors">
                <div class="infor"><span><?= getCustomData('SELECT COUNT(id_category) FROM category')[0][0] ?></span> <span>chủ điểm từ</span></div>
                <div class="infor"><span><?= getCustomData('SELECT COUNT(id_voca) FROM vocabulary')[0][0] ?></span></span> <span>từ vựng</span></div>
                <div class="infor"><span><?= getCustomData('SELECT COUNT(username_customer) FROM customers')[0][0] ?></span></span> <span>khách hàng</span></div>
                <div class="infor"><span><?= getCustomData('SELECT COUNT(id_feedback) FROM feedback')[0][0] ?></span> <span>feedback</span></div>
            </div>


            <canvas id="myChart" style="width:100%"></canvas>
            <br><br>
            <div id="controls">
                <ul id="control">
                    <li style="color: #4481eb">Lưu nhiều nhất</li>
                    <li>Click nhiều nhất</li>
                </ul>
                <hr>
            </div>
                <script>
                var xValues = [0,'<?= $top_word_name[0] ?>', '<?= $top_word_name[1] ?>', '<?= $top_word_name[2] ?>', '<?= $top_word_name[3] ?>', '<?= $top_word_name[4] ?>', '<?= $top_word_name[5] ?>', '<?= $top_word_name[6] ?>', '<?= $top_word_name[7] ?>', '<?= $top_word_name[8] ?>', '<?= $top_word_name[9] ?>'];

                var xValuesClick = [0,'<?= $top_click_name[0] ?>', '<?= $top_click_name[1] ?>', '<?= $top_click_name[2] ?>', '<?= $top_click_name[3] ?>', '<?= $top_click_name[4] ?>', '<?= $top_click_name[5] ?>', '<?= $top_click_name[6] ?>', '<?= $top_click_name[7] ?>', '<?= $top_click_name[8] ?>', '<?= $top_click_name[9] ?>'];

                var yValues = [0,<?= $count_word[0] ?> , <?= $count_word[1] ?>, <?= $count_word[2] ?>, <?= $count_word[3] ?>, <?= $count_word[4] ?>, <?= $count_word[5] ?>, <?= $count_word[6] ?>, <?= $count_word[7] ?>, <?= $count_word[8] ?>, <?= $count_word[9] ?> ];
                
                var yValuesClick = [0,<?= $click_word_name[0] ?> , <?= $click_word_name[1] ?>, <?= $click_word_name[2] ?>, <?= $click_word_name[3] ?>, <?= $click_word_name[4] ?>, <?= $click_word_name[5] ?>, <?= $click_word_name[6] ?>, <?= $click_word_name[7] ?>, <?= $click_word_name[8] ?>, <?= $click_word_name[9] ?> ];
                
                
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
        var index = 0
                li = document.querySelectorAll('#control li')
        for (let i = 0; i < li.length; i++) {
            li[i].onclick = function () {
                li[index].style.color = 'black'
                li[i].style.color = '#4481eb'
                index = i
                document.getElementsByTagName('hr')[0].style.left = ((5 + (50 * i) ).toString() + '%')
                analytic(i)
            }
        }
        function analytic(index) {
            switch(index) {
                case 0 : {
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
                    break;
                }
                case 1 : {
                    new Chart("myChart", {
                    type: "line",
                    data: {
                        labels: xValuesClick,
                        datasets: [{
                            fill: false,
                            lineTension: 0,
                            backgroundColor: "white",
                            borderColor: "#4481eb",
                            borderWidth: '2',
                            data: yValuesClick,
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
                break
                }
            }
        }
            </script>
            <br><br><br><br>
            <ul id="recommend">
                <li>
                    <h2>Đã có <span style="color: #eea849"><?= getCustomData('SELECT COUNT(username_customer) FROM customers WHERE admin_customer = 1')[0][0] ?></span> khách hàng <span style="color: #eea849;">Premium</span></h2>
                </li>
                <li>

                    <h2>Chủ điểm đang được quan tâm nhiều nhất là <span style="color: #4481eb"><?= $top_cate[0][0] ?></span> </h2>
                </li>
                <li>
                    <h2>Chủ điểm ít được quan tâm nhất là <span style="color: #4481eb"><?= $top_cate[count($top_cate)-1][0] ?></span> </h2>
                </li>

                <li>

                    <h2>Top khách hàng lưu nhiều nhất là <span style="color: #4481eb"><?= $top_customer[0][0] ?></span> với  <span style="color: #4481eb"><?= $top_customer[0][1] ?></span> từ</h2>
                </li>
                

            </ul>
            <br><br><br>
            <h2 style="font-size: 2em; background: #4481eb; color: white; padding: 10px; border-radius:12px;">Các từ ít được tra cứu nhất</h2>
            <div style="margin-left: -1em">

                <div id="controls">
                </div>
                <link rel="stylesheet" href="../styles/storage.css">
                <div id="content">
                    <ul>
                        <?php 
                    $bottom_ranking = getCustomData('SELECT name_voca FROM vocabulary ORDER BY click_voca LIMIT 10');

                    for ($i=0; $i < count($bottom_ranking); $i++) { 
                        echo '<li>'. $bottom_ranking[$i][0]  .'</li>';
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
                var xValues2 = <?= $cate_text ?>;
                var yValues2 = <?= $cate_number ?>;

                new Chart("myChart2", {
                    type: "doughnut",
                    data: {
                        labels: xValues2,
                        datasets: [{
                            backgroundColor: ['#277BC0','#AEBDCA','#06283D','#7FBCD2'],
                            data: yValues2,
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