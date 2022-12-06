<?php
require_once('../../config/config.php');
// $data = getCustomData('SELECT name_customer,image_customer,count(voca_mg) FROM customers INNER JOIN vocabulary_manager ON vocabulary_manager.customer_mg = customers.username_customer GROUP BY customer_mg ORDER BY count(voca_mg) DESC ');
$data = getCustomData('SELECT name_customer,image_customer,count(voca_mg) FROM customers INNER JOIN vocabulary_manager ON vocabulary_manager.customer_mg = customers.username_customer GROUP BY customer_mg ORDER BY count(voca_mg) DESC ');
$lv5 = getCustomData('SELECT count(voca_mg) FROM vocabulary_manager WHERE level_mg = 5  GROUP BY customer_mg ORDER BY count(voca_mg) DESC');

?>
        <div>
            <div id="rank_visual">
                <div class="rank_item">
                    <div>1</div>
                    <div style="display: flex ; justify-content: space-between ; width: 100%"><p><?= $data[0][0] ?></p> <p><?= count($lv5) <= 0  ? 0 : $lv5[0][0] ?> <?= $data[0][2] ?></p></div>
                    <img  loading="lazy" id="congratulation" >
                    <img src="../../src/images/customers/<?= $data[0][1] ?>" style="border: 2px solid white;height: 80px;width: 80px;border-radius: 50%; top:20px ; left:10px" >
                </div>
                <div class="rank_item">
                    <div style="">3</div>
                    <img src="../../src/images/customers/<?= $data[2][1] ?>" style="border: 2px solid white;height: 80px;width: 80px;border-radius: 50%; top:-10px ; left:-1em" >
                    <div style="display: flex ; justify-content: space-between ; width: 100%"><p><?= $data[2][0] ?></p>  <p><?= count($lv5) <= 2  ? 0 : $lv5[2][0] ?> <?= $data[2][2] ?></p></div>

                </div>
                <div class="rank_item">
                    <div>2</div>
                    <div style="display: flex ; justify-content: space-between ; width: 100%"><p><?= $data[1][0] ?></p> <p><p><?= count($lv5) <= 1  ? 0 : $lv5[1][0] ?> <?= $data[1][2] ?></p></div>
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
                    
                    <tr>
                        <td>4</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr>
                    <tr id="your_rank">
                        <td>12</td>
                        <td>Tunkit</td>
                        <td>23</td>
                        <td>53</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr><tr>
                        <td>11</td>
                        <td>Lê Quang Thái</td>
                        <td>18</td>
                        <td>124</td>
                    </tr>
                </tbody>
            </table>
        </div>


    </aside>
<script>
    document.body.onload = function() {
            document.getElementById('congratulation').setAttribute('src','../../styles/happy.gif   ')
    }
</script>