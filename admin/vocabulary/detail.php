<?php
require_once('../../config/config.php');    
$data = getCustomData('SELECT id_voca,name_voca,meaning_voca,category_voca,click_voca,usage_voca,example_voca FROM vocabulary WHERE id_voca= "'. $_GET['v'] .'"');
if(isset($_GET['add_usage'])) { 
    $arr = unserialize(base64_decode(getCustomData('SELECT usage_voca FROM vocabulary WHERE id_voca = "'. $_GET['v'] .'"')[0][0]));
    array_push($arr, $_GET['add_usage']);
    editData('vocabulary','usage_voca',base64_encode(serialize($arr)),'id_voca',$_GET['v']);
    header('location:'. $_SERVER['PHP_SELF'] . '?v='. $_GET['v']. '&t=1' );
}
elseif(isset($_GET['delete_usage'])) {
    $arr = unserialize(base64_decode(getCustomData('SELECT usage_voca FROM vocabulary WHERE id_voca = "'. $_GET['v'] .'"')[0][0]));
    $index = 0;
    $new_arr = array();
    for ($i=0; $i < count($arr); $i++) { 
        if($i == $_GET['delete_usage']) {
            continue;
        }
        $new_arr[$index] = $arr[$i];
        $index++;
    }
    editData('vocabulary','usage_voca',base64_encode(serialize($new_arr)),'id_voca',$_GET['v']);
    header('location:'. $_SERVER['PHP_SELF'] . '?v='. $_GET['v']. '&t=1');
    
}
elseif(isset($_GET['edit_usage'])) {
    $arr = unserialize(base64_decode(getCustomData('SELECT usage_voca FROM vocabulary WHERE id_voca = "'. $_GET['v'] .'"')[0][0]));
    $arr[$_GET['index']] = $_GET['edit_usage'];
    // var_dump($arr);  
    editData('vocabulary','usage_voca',base64_encode(serialize($arr)),'id_voca',$_GET['v']);
    header('location:'. $_SERVER['PHP_SELF'] . '?v='. $_GET['v']. '&t=1');
}
elseif(isset($_GET['add_example'])) {
    $arrr = unserialize(base64_decode($data[0][6]));
    array_push($arrr,array($_GET['add_example'],$_GET['meaning_example']));
    editData('vocabulary','example_voca',base64_encode(serialize($arrr)),'id_voca',$_GET['v']);
    header('location:'. $_SERVER['PHP_SELF'] . '?v='. $_GET['v']. '&t=2');
}
elseif(isset($_GET['delete_exam'])) {
    $arr = unserialize(base64_decode(getCustomData('SELECT example_voca FROM vocabulary WHERE id_voca = "'. $_GET['v'] .'"')[0][0]));
    $index = 0;
    $new_arr = array();
    for ($i=0; $i < count($arr); $i++) { 
        if($i == $_GET['delete_exam']) {
            continue;
        }
        $new_arr[$index] = $arr[$i];
        $index++;
    }
    editData('vocabulary','example_voca',base64_encode(serialize($new_arr)),'id_voca',$_GET['v']);
    header('location:'. $_SERVER['PHP_SELF'] . '?v='. $_GET['v']. '&t=2');
    
}
elseif(isset($_GET['edit_exam'])) {
    $arr = unserialize(base64_decode(getCustomData('SELECT example_voca FROM vocabulary WHERE id_voca = "'. $_GET['v'] .'"')[0][0]));

    $arr[$_GET['index']][$_GET['jndex']] = $_GET['edit_exam'];
    var_dump($arr);
    editData('vocabulary','example_voca',base64_encode(serialize($arr)),'id_voca',$_GET['v']);
    header('location:'. $_SERVER['PHP_SELF'] . '?v='. $_GET['v']. '&t=2');

}

?>
<link rel="stylesheet" href="../../styles/storage.css">
<link rel="stylesheet" href="../../styles/detail.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
<style>
.btn_delete {
        background: white;
    padding: 5px 10px;
    box-sizing: border-box;
    border-width: 1px;
    border-radius: 2px;
    }
    
      #add {
        background: #4481eb;
        color: white;
        border: none;
        width: 50px;
        height: 50px;
        position: fixed;
        bottom: 2em;
        right: 2em;
        border-radius: 50%;
        z-index: 100;
        text-align: center;
        font-size: 1.2em;
    }
li span {
    color: red;
    display: block;
    text-align: right;
}
li span:last-child {
margin-top: 10px;
color: rgb(44, 188, 99);
}
li p {
    outline: none;
    text-overflow: ellipsis;
}
    table {
        width: 100%;
    }

    thead tr th {
        background: lightslategray;
        color: white;
        padding: 10px;
    }

    td {
        text-align: center;
        padding: 10px;
        max-width: 100px;
        white-space: nowrap;
        overflow: auto;
        text-overflow: clip;
    }

       td:hover {
        background: lightslategray;
        transition-duration: 0.01s;
        color: white;
    }
    select {
        border: none;
        padding: 10px;
        background: transparent;
    }
    #content ul li {
width: 80%;
    }
    #add_usage_input {
        font-family:inherit;
        text-align:center;
        width:100%;
        height:100% ;
         border:none;
         background:transparent;
         outline:none
    }
    #add_usage {
        display: none;
    }
    
</style>

<div>
    <div id="controls">
        <ul id="control">
            <li style="color: #4481eb">Thông tin cơ bản</li>
            <li>Cách dùng</li>
            <li>Ví dụ</li>
            <li>Tài khoản đã lưu</li>
            <li>Từ đồng nghĩa</li>
            <li>Lượt dùng</li>
        </ul>
        <hr>
    </div>
    <div id="content">
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên từ</th>
                    <th>Nghĩa</th>
                    <th>Loại</th>
                    <th>Lượt click</th>
                    <!-- <th>Ví dụ</th> -->
        
                </tr>
            </thead>
            <tbody>
                <?php
                $cate = getCustomData('SELECT name_category FROM category WHERE id_category = "'. $data[0][3] .'"');
                $column = explode(',',getColumn('vocabulary'));
                for ($i=0; $i < count($data); $i++) { 
                        echo '<tr>';
                        for ($j=0; $j < 5; $j++) { 
                          if($j == 3) {
                              echo '<td>'.  $cate[0][0].'</td>'   ;
                          }
                          else {

                              echo '<td>'. $data[$i][$j]  .'</td>'   ;
                            }
                            
                            }
                            
                        echo '</tr>';
                    }
                    ?>
            </tbody>
        
        </table>
        
        <img id="the-end" style="margin-top: -8em;width: 100%; transform: scale(0.6);" src="https://cdn.dribbble.com/users/523410/screenshots/1949657/cloudman_drbl.gif  " >
    </div>
</div>

<script>
var check = true
var index = 0
li = document.querySelectorAll('#control li')

content_default = document.getElementById('content').outerHTML
for (let i = 0; i < li.length; i++) {
    li[i].onclick = function () {
        li[index].style.color = 'black'
        li[i].style.color = '#4481eb'
        index = i
        document.getElementsByTagName('hr')[0].style.left = ((5 + (18 * i) - ((i == 2 ? 5 : 0))- ((i >= 3 ? 7 : 0))).toString() + '%')
        document.getElementById('content').style.opacity = 0

        setTimeout(() => {
            document.getElementById('content').innerHTML = getDataIndex(i)
            document.getElementById('content').style.opacity = 1

        }, 300);
    }
}
function getDataIndex(index) {
    switch (index) {
        case 0:  {
            return content_default;
        }
        case 1:{
            return "<ul id='usage_ul'><?php
            $usage = unserialize(base64_decode($data[0][5])); 
            for ($i=0; $i < count($usage); $i++) { 
                echo '<li><p onfocusout=' . "'" . 'confirm_usage('.    $i .')' ."'".'   class='. "'".  'usage_li' ."'". '> '. $usage[$i] .' </p><span onclick=' . "'" . 'delete_usage('. $i .')' ."'".'>Xoá</span><span onclick=' . "'" . 'edit_usage('. $i .')' ."'".'>Sửa</span></i></li>';
            }
                ?><li id='add_usage'><input type='text' id='add_usage_input'/></li><li style='background:#4481eb;color:white' onclick='add_usage(this)'>Thêm</li></ul>"
            
            break;
        }
        case 2 : {
            return '<?php   $example = unserialize(base64_decode($data[0][6]));
                    echo '<button onclick="add_example()" id="add">+</button><div id="example">';
                    echo '<table><thead><tr><th>Cách dùng</th><th>Ví dụ</th><th>Xoá</th></tr></thead><tbody><tr id="add_example_form" style="display:none"><td id="theory"></td><td id="theory2"></td></tr>';
                    for ($i=0; $i < count($example); $i++) { 
                        echo '<tr>';
                        echo '<td ondblclick="this.setAttribute(`contenteditable`,`true`);this.focus()" onfocusout="confirm_exam(this,'. $i.',0)">'. $example[$i][0] .'</td>';
                        echo '<td ondblclick="this.setAttribute(`contenteditable`,`true`);this.focus()" onfocusout="confirm_exam(this,'. $i.',1)">'. $example[$i][1] .'</td>';
                        echo '<td><button class="btn_delete" onclick="location.href=`'. $_SERVER['PHP_SELF'] .'?v='. $_GET['v'] .'&delete_exam='.$i .'`">Xoá</button></td>';
                        echo '</tr>';
                    }
                    echo '</tbody></table>';
                                     ?>';
            break;
        }
        case 3 : {
            return `
            <div id="content">
            <ul>
            <?php 
                $customer =  getCustomData('SELECT customer_mg FROM vocabulary_manager WHERE voca_mg = "'. $_GET['v'] .'"');
                for ($i=0; $i < count($customer); $i++) { 
                    echo '<li style="width:100px">'. $customer[$i][0] . '</li>';
                }
            ?>
            </ul>
            </div>

            
            `
            break;
        }
        case 4 : {
            return `
            <div id="content">
            <ul>
            <?php 
            $same = explode('_',$_GET['v']);
            $same = $same[count($same)-1];
                $same_word = getCustomData('SELECT name_voca FROM vocabulary WHERE id_voca LIKE "%'. $same .'" AND NOT id_voca = "'. $_GET['v'] .'"');
                for ($i=0; $i < count($same_word); $i++) { 
                    echo '<li style="width:100px">'. $same_word[$i][0] . '</li>';
                }
            ?>
            </ul>
            </div>            
            `
            break;
        }
        
        case 5 : {
            return `
            <div id="content">
            <ul>
            <?php 
            $same = explode('_',$_GET['v']);
            $same = $same[count($same)-1];
                $same_word = getCustomData('SELECT name_voca,click_voca FROM vocabulary WHERE id_voca LIKE "%'. $same .'"    ORDER BY click_voca DESC');
                for ($i=0; $i < count($same_word); $i++) { 
                    echo '<li style="width:100px"> <span style="color: #4481eb; display:inline">'. $same_word[$i][1] .'</span> '. $same_word[$i][0] . ' </li>';
                }
            ?>
            </ul>
            </div>            
            `
            break;
        }

    }
}
var is_usage = false
function add_usage(obj) {
    if(!is_usage) {
        document.getElementById('add_usage').style.display = 'block'
        document.getElementById('add_usage_input').focus()
        obj.style.background = 'rgb(44, 188, 99)'
    }
    else if(document.getElementById('add_usage_input').value.length ==0) {
        document.getElementById('add_usage').style.display = 'none'
        obj.style.background = '#4481e3'
    }
    else {
        location.href = '<?= $_SERVER['PHP_SELF'] ?>?v=<?=$_GET['v']?>&add_usage='+ document.getElementById('add_usage_input').value
    }
    is_usage = !is_usage
     

}
function delete_usage(index) {
    location.href = '<?= $_SERVER['PHP_SELF'] ?>?v=<?=$_GET['v']?>&delete_usage='+ index

}
function edit_usage(obj) {
        document.getElementsByClassName('usage_li')[obj].setAttribute('contenteditable','true')
        document.getElementsByClassName('usage_li')[obj].focus()

}
function confirm_usage(obj,index) {
    if(confirm('Xác nhận lưu ?')){
    location.href = '<?= $_SERVER['PHP_SELF'] ?>?v=<?=$_GET['v']?>&index='+ obj + '&edit_usage='+ document.getElementsByClassName('usage_li')[obj].innerText
}

}
var is_confirm = false
function add_example() {
    if(!is_confirm) {
        document.getElementById('add_example_form').style.display = 'table-row'
        document.getElementById('theory').setAttribute('contenteditable','true')
        document.getElementById('theory2').setAttribute('contenteditable','true')
        document.getElementById('theory').focus()
        document.getElementById('add').innerHTML = '<i class="fa-solid fa-check"></i>'
        document.getElementById('add').style.background = 'rgb(44, 188, 99)'
        is_confirm = true
    }
    else {
        location.href = '<?= $_SERVER['PHP_SELF']?>?v=<?=$_GET['v'] ?>&add_example='+ document.getElementById('theory').innerText + '&meaning_example='+
        document.getElementById('theory2').innerText

    }
}
function selected(obj,index) {
    obj.style.background = '#4481eb'
    obj.style.borderColor = '#4481eb'
    obj.style.color = 'white'
    // document.getElementsByClassName('usage')[index].style.background = 'red'
    let exa =document.getElementsByClassName('example')[index]
    exa.style.background = '#4481eb'
    exa.style.borderColor = '#4481eb'
    exa.style.color = 'white'
    
}
function confirm_exam(obj,index,jndex) {
    if(confirm('Xác nhận lưu ? ')) {
        location.href  = '<?= $_SERVER['PHP_SELF']?>?v=<?=$_GET['v'] ?>&edit_exam='+obj.innerText + '&index='+index + '&jndex=' + jndex
    }
}
</script>
<?php
if(isset($_GET['t'])) {
    echo '<script>li['. $_GET['t'] .'].click()</script>';

}
?>