<?php
require_once('../../config/config.php');
// $data = getCustomData('SELECT name_customer,image_customer,count(voca_mg) FROM customers INNER JOIN vocabulary_manager ON vocabulary_manager.customer_mg = customers.username_customer GROUP BY customer_mg ORDER BY count(voca_mg) DESC ');
$data = getCustomData('SELECT name_customer,image_customer,count(voca_mg),username_customer FROM customers INNER JOIN vocabulary_manager ON vocabulary_manager.customer_mg = customers.username_customer GROUP BY customer_mg ORDER BY count(voca_mg) DESC ');
$lv5 = getCustomData('SELECT count(voca_mg),customer_mg FROM vocabulary_manager WHERE level_mg = 5  GROUP BY customer_mg ');

?>
        <div>
            <div id="rank_visual">
                <div class="rank_item">
                    <div class="ranking">1</div>
                    <div style="display: flex ; justify-content: space-between ; width: 100%"><p class="name"><?= $data[0][0] ?></p> <p><?= count($lv5) <= 0  ? 0 : $lv5[0][0] ?> <?= $data[0][2] ?></p></div>
                    <img  loading="lazy" id="congratulation" >
                    <img src="../../src/images/customers/<?= $data[0][1] ?>" style="border: 2px solid white;height: 80px;width: 80px;border-radius: 50%; top:20px ; left:10px" >
                </div>
                <div class="rank_item">
                    <div style="" class="ranking">3</div>
                    <img src="../../src/images/customers/<?= $data[2][1] ?>" style="border: 2px solid white;height: 80px;width: 80px;border-radius: 50%; top:-10px ; left:-1em" >
                    <div style="display: flex ; justify-content: space-between ; width: 100%"><p class="name"><?= $data[2][0] ?></p>  <p><?= count($lv5) <= 2  ? 0 : $lv5[2][0] ?> <?= $data[2][2] ?></p></div>

                </div>
                <div class="rank_item">
                    <div class="ranking">2</div>
                    <div style="display: flex ; justify-content: space-between ; width: 100%"><p class="name"><?= $data[1][0] ?></p> <p><p><?= count($lv5) <= 1  ? 0 : $lv5[1][0] ?> <?= $data[1][2] ?></p></div>
                    <img src="../../src/images/customers/<?= $data[1][1] ?>" style="border: 2px solid white;height:80px;width: 80px;border-radius: 50%; top:20px ; left:10px" >

                </div>
            </div>
            <br><br><br><br>
            <table> 
                <thead>

                    <tr>
                        <th>Rank</th>
                        <th>Tên tài khoản</th>
                        <th>Số từ đã học</th>
                        <th>Tổng số từ đang học</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                   for ($i=3; $i < count($data); $i++) { 
                    echo '<tr>
                    <td class="ranking">'. $i+1 .'</td>
                    <td  class="name">'. $data[$i][0]  .'</td>
                    <td>'. getCustomData('SELECT count(voca_mg) FROM vocabulary_manager WHERE customer_mg = "'. $data[$i][3]  .'" AND level_mg = 5')[0][0]  .'</td>
                    <td>'. $data[$i][2] .'</td>
                </tr>';
                   }
                   ?>

                    <tr id="your_rank">
                        <td id="rank_me">999</td>
                        <td><?php $name_me = getCustomData('SELECT name_customer FROM customers WHERE username_customer = "'. $_COOKIE['username']  .'"')[0][0]; echo $name_me ?></td>
                        <td><?= getCustomData('SELECT count(voca_mg) FROM vocabulary_manager WHERE customer_mg = "'. $_COOKIE['username']  .'" AND level_mg = 5')[0][0] ?></td>
                        <td><?= getCustomData('SELECT count(voca_mg) FROM vocabulary_manager WHERE customer_mg = "'. $_COOKIE['username']  .'"')[0][0] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>


    </aside>
<script>
    document.body.onload = function() {
    let setRank = document.getElementsByClassName('name')
    for (let i = 0; i < setRank.length; i++) {
        if(setRank[i].innerText == '<?= $name_me ?>') {
            // alert(setRank[i])
            document.getElementById('rank_me').innerText = parseInt(document.getElementsByClassName('ranking')[i].innerText)
        }
    }
            document.getElementById('congratulation').setAttribute('src','../../styles/happy.gif   ')
    }
</script>