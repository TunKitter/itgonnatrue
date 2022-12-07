<?php
require_once('../../config/config.php');
if(isset($_GET['id']) && isset($_GET['name']) && isset($_GET['category']) && isset($_GET['meaning'])&& isset($_GET['usage']) && isset($_GET['example']) && isset($_GET['click'])  ) { 
    insertData('vocabulary',$_GET['id'],$_GET['name'],$_GET['category'],$_GET['meaning'],$_GET['usage'],$_GET['example'],$_GET['click']);
    header('location: '. $_SERVER['PHP_SELF']);
}
elseif(isset($_GET['delete_data'])) {
    deleteData('vocabulary','id_voca',$_GET['delete_data']);
    header('location: '. $_SERVER['PHP_SELF']);
}
elseif(isset($_GET['data_edit']) && isset($_GET['col']) && isset($_GET['username'])) {
    editData('vocabulary',$_GET['col'].'_voca',$_GET['data_edit'],'id_voca',$_GET['username']);
    header('location: '. $_SERVER['PHP_SELF']);
}
elseif(isset($_GET['delete_datas'])) {
    getCustomData('DELETE FROM vocabulary WHERE id_voca IN ('. rtrim($_GET['delete_datas'],',') .')');
    header('location: '. $_SERVER['PHP_SELF']);
}
elseif(isset($_GET['cate_edit']) && isset($_GET['username'])) {
    editData('vocabulary','category_voca',$_GET['cate_edit'],'id_voca',$_GET['username']);
    header('location: '. $_SERVER['PHP_SELF']);
}
elseif(isset($_GET['detail'])) {
    header('location: index.php?v='. $_GET['detail']);
}
$data = getCustomData('SELECT id_voca,name_voca,meaning_voca,category_voca,click_voca FROM vocabulary');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
<link rel="stylesheet" href="../../styles/storage.css">
<link rel="stylesheet" href="../../styles/detail.css">
<style>
    #toast {
        right: initial;
        left: 0;
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

    img {
        border-radius: 50%;
        width: 50px;
        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
    }

    tbody tr:first-child {
        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
    }

    #add,
    #close {
        background: #4481eb;
        color: white;
        border: none;
        width: 50px;
        height: 50px;
        position: absolute;
        bottom: 2em;
        right: 2em;
        border-radius: 50%;
        text-align: center;
        font-size: 1.2em;
    }
    #add {
        position: fixed;
    }

    #close {
        background-color: #E0144C;
        right: 6em;
        visibility: hidden;
    }

    #add:hover {
        filter: brightness(1.1)
    }

    #add_column {
        display: none;
        outline: none;
    }

    td:hover {
        background: lightslategray;
        transition-duration: 0.01s;
        color: white;
    }

    #trash {
        width: 30px;
        position: absolute;
        filter: grayscale(1);
        top: -100px;
    }

    #trash:hover {
        filter: none;
    }

    select {
        border: none;
        padding: 10px;
        background: transparent;
    }

    a {
        color: #4481eb;
        text-decoration: none;
    }
</style>
<div id="toast">
    <div id="img">IGT</div>
    <div id="desc">Xoá thành công</div>
</div>
<button id="add"> <i class="fa-solid fa-plus"></i> </button>
<button id="close"> <i class="fa-solid fa-close"></i> </button>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên từ</th>
            <th>Nghĩa</th>
            <th>Loại</th>
            <th>Lượt click</th>
            <th>Chi tiết</th>
            <!-- <th>Ví dụ</th> -->

        </tr>
    </thead>
    <tbody>
        <tr id="add_column">
            <td class="add_data" contenteditable=""></td>
            <td class="add_data" contenteditable=""></td>
            <td class="add_data" contenteditable=""></td>
            <td class="add_data" contenteditable=""></td>
            <td class="add_data" contenteditable=""></td>
            <td class="add_data" contenteditable=""></td>
            <td class="add_data" contenteditable=""></td>
        </tr>
        <?php
        $column = explode(',',getColumn('vocabulary'));
            for ($i=0; $i < count($data); $i++) { 
                echo '<tr>';
                for ($j=0; $j < 5; $j++) { 
                    if($j == 3) {
                        echo '<td><select onchange="change_cate(this.value,`'. $data[$i][0] .'`)">';
                        $cate = getCustomData('SELECT id_category,name_category FROM category');
                        for ($k=0; $k < count($cate); $k++) { 
                            if($data[$i][3] == $cate[$k][0]) {
                                echo '<option selected value="'. $cate[$k][0] .'">'. $cate[$k][1]  .'</option>';
                            }
                            else {

                                echo '<option value="'. $cate[$k][0] .'">'. $cate[$k][1]  .'</option>';
                            }
                        }
                        
                        echo'</select></td>';                                    ;
                    }
                
                    elseif($j == 4) {
                        echo '<td>'. $data[$i][$j]  .'</td>'   ;
                        
                    }
                    
                    else {

                        echo '<td onmousedown="multi_select(event)" onfocusout="confirm_edit(this,`'. $data[$i][0] .' `,'. $j . ')" ondblclick="selected_db(this)" onclick="selected(this,'. $i .','. $j .',`'. $column[$j] . '`)">'. $data[$i][$j]  .'</td>'   ;
                    }
                    }
                    echo '<th><a href="'. $_SERVER['PHP_SELF'] .'?detail='. $data[$i][0] .'">Chi tiết</a></th>';
                echo '</tr>';
            }
            ?>
    </tbody>

</table>
<img src="https://cdn-icons-png.flaticon.com/512/5028/5028066.png" id="trash" alt="">
<script>
    var isConfirm = false
    var add = document.getElementById('add')
    var add_data = document.getElementsByClassName('add_data')
    var str = ''
    var indexed = 0
    var row = 0
    var field = ['id', 'name', 'meaning', 'category', 'click']
    var is_multi = false;
    var multi = new Set()
    function multi_select(event) {
        if (event.ctrlKey) {
            is_multi = true
        } else {
            is_multi = false

        }
    }
    add.onclick = function () {
        location.href = '<?=$_SERVER['PHP_SELF'] ?>?create=1'
    }
    document.getElementById('close').onclick = function () {
        document.getElementById('add_column').style.display = 'none'
        document.getElementById('close').style.visibility = 'hidden'
        for (let i = 0; i < add_data.length; i++) {
            add_data[i].innerHTML = ''
        }
        change_button()
    }
    function selected_db(obj) {
        obj.setAttribute('contenteditable', 'true')
        obj.focus()
    }
    function confirm_edit(obj, username, col) {
        if (confirm('Xác nhận lưu?')) {
            setTimeout(() => {
                location.href = '<?=  $_SERVER['PHP_SELF']?>?data_edit=' + obj.innerText + '&col=' + field[col] + '&username=' + username
            }, 2000);
            launch_toast('Cập nhật thành công', '#68B984')
        }
    }
    function selected(obj, o, index, field_2) {

        document.getElementById('trash').style.top = window.event.pageY + 'px'
        document.getElementById('trash').style.left = window.event.clientX + 'px'
        let tr = document.getElementsByTagName('tr')
        tr[o + 2].style.transitionDuration = '0.01s'
        tr[o + 2].style.background = 'lightslategray'
        tr[o + 2].style.color = 'white'
        if (!is_multi && multi.size != 0) {
            let temp = Array.from(multi)
            document.getElementsByTagName('tr')[o + 2].style.background = 'white'
            document.getElementsByTagName('tr')[o + 2].style.color = '#000000B3'
            for (let i = 0; i < multi.size; i++) {
                document.getElementsByTagName('tr')[temp[i]].style.background = 'white'
                document.getElementsByTagName('tr')[temp[i]].style.color = '#000000B3'
            }
            multi.clear()
            tr[indexed].style.background = 'white'
            tr[indexed].style.color = '#000000B3'
            if (indexed == o + 2) {
                document.getElementById('trash').style.top = '-100px'
            }
        }
        else {
            if (multi.has(o + 2)) {
                tr[o + 2].style.background = 'white'
                tr[o + 2].style.color = '#000000B3'
                multi.delete(o + 2)
            }
            else {

                multi.add(o + 2)
            }
        }
        indexed = o + 2;
        row = o
    }
    function change_button() {
        if (!isConfirm) {
            add.innerHTML = '<i class="fa-solid fa-check"></i>'
            add.style.background = 'rgb(44, 188, 99)'
            isConfirm = true
        }

        else {
            add.innerHTML = '<i class="fa-solid fa-plus"></i>'
            add.style.background = '#4481eb'
            isConfirm = false
        }
    }
    document.getElementById('trash').onclick = function () {
        launch_toast('Xoá thành công', '#E0144C')
        if (multi.size == 1) {

            setTimeout(() => {
                location.href = '<?= $_SERVER['PHP_SELF']?>?delete_data=' + (document.getElementsByTagName('tr')[row + 2].firstChild.innerHTML);
            }, 2000);
        }
        else {
            setTimeout(() => {
                location.href = '<?= $_SERVER['PHP_SELF']?>?delete_datas=' + del_data(Array.from(multi));
            }, 2000);

        }
    }
    function launch_toast(text, bg = null) {
        var x = document.getElementById("toast")
        document.getElementById('desc').innerText = text
        if (bg) {
            x.style.background = bg
            document.getElementById('img').style.color = bg

        }
        x.className = "show";
        setTimeout(function () { x.className = x.className.replace("show", ""); }, 5000);
    }
    function del_data(text) {
        let result = ''
        let dom = document.getElementsByTagName('tr')
        for (let i = 0; i < text.length; i++) {
            result += '"' + dom[Array.from(multi)[i]].firstChild.innerText + '",';

        }
        return result;
    }
    function change_cate(value, username) {
        setTimeout(() => {
            location.href = '<?=  $_SERVER['PHP_SELF']?>?cate_edit=' + value + '&username=' + username
        }, 2000);
        launch_toast('Cập nhật thành công', '#68B984')

    }
</script>