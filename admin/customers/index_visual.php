<?php
require_once('../../config/config.php');
if(isset($_GET['username']) && isset($_GET['password']) && isset($_GET['name']) && isset($_GET['image']) && isset($_GET['email']) && isset($_GET['admin'])) { 
    insertData('customers',$_GET['username'],$_GET['password'],$_GET['name'],$_GET['image'],$_GET['email'],$_GET['admin'] == "0");
    getCustomData('UPDATE customers SET admin_customer = 0 WHERE username_customer = "'. $_GET['username'] .'"');
    header('location: '. $_SERVER['PHP_SELF']);
}
elseif(isset($_GET['delete_data'])) {
    deleteData('customers','username_customer',$_GET['delete_data']);
    header('location: '. $_SERVER['PHP_SELF']);
}
elseif(isset($_GET['data_edit']) && isset($_GET['col']) && isset($_GET['username'])) {
    editData('customers',$_GET['col'].'_customer',$_GET['data_edit'] ,'username_customer',$_GET['username']);
    if($_GET['col'] == 'admin' && $_GET['data_edit'] == '0') {
        getCustomData('UPDATE customers SET admin_customer = 0 WHERE username_customer = "'. $_GET['username'] .'"');
    }
        header('location: '. $_SERVER['PHP_SELF']);
}
elseif(isset($_GET['delete_datas'])) {
    getCustomData('DELETE FROM customers WHERE username_customer IN ('. rtrim($_GET['delete_datas'],',') .')');
    header('location: '. $_SERVER['PHP_SELF']);
}
$data = getAllData('customers');
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
</style>
<div id="toast"><div id="img">IGT</div><div id="desc">Xoá thành công</div></div>
<button id="add"> <i class="fa-solid fa-plus"></i> </button>
<button id="close"> <i class="fa-solid fa-close"></i> </button>
<table>
    <thead>
        <tr>
            <th>Tên đăng nhập</th>
            <th>Mật khẩu</th>
            <th>Tên</th>
            <th>Ảnh</th>
            <th>Email</th>
            <th>Quản trị</th>
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
        </tr>
        <?php
        $column = explode(',',getColumn('customers'));
            for ($i=0; $i < count($data); $i++) { 
                echo '<tr>';
                for ($j=0; $j < 6; $j++) { 
                    echo '<td onmousedown="multi_select(event)" onfocusout="confirm_edit(this,`'. $data[$i][0] .' `,'. $j . ')" ondblclick="selected_db(this)" onclick="selected(this,'. $i .','. $j .',`'. $column[$j] . '`)">'. $data[$i][$j]  .'</td>'   ;
                }
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
    var field = ['username', 'password', 'name', 'image', 'email', 'admin']
    var is_multi = false;
    var multi  = new Set()
    function multi_select(event) {
        if (event.ctrlKey) {
            is_multi = true
        } else {
    is_multi = false

}
    }
    add.onclick = function () {
        str = ''
        for (let i = 0; i < add_data.length; i++) {
                str += field[i] + '=' + add_data[i].innerHTML + '&'
        }
        if(!isConfirm) {
            change_button()
                document.getElementById('add_column').style.display = 'table-row'
                document.getElementById('close').style.visibility = 'visible'
                add_data[0].focus()
                document.getElementById('add_column').getElementsByTagName('td')[0].focus()   
        }
        else if (str.length > 0) {
            // if(!str == 'username=&password=&name=&image=&email=&admin=&') {
                launch_toast('Thêm thành công','#68B984')
                setTimeout(() => {
                location.href = '<?= $_SERVER['PHP_SELF'] ?>?' + str
                }, 2000);
            // }
        }
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
    function confirm_edit(obj,username,col) {
        if(confirm('Xác nhận lưu?')) {
            setTimeout(() => {
                location.href = '<?=  $_SERVER['PHP_SELF']?>?data_edit='+obj.innerText+'&col='+field[col]+'&username='+ username
            }, 2000);
            launch_toast('Cập nhật thành công','#68B984')
        }
    }
    function selected(obj, o,index, field_2) {
        
        document.getElementById('trash').style.top =  window.event.clientY + 'px'
        document.getElementById('trash').style.left =  window.event.clientX + 'px'
        let tr  = document.getElementsByTagName('tr')
        tr[o+2].style.transitionDuration = '0.01s'
        tr[o+2].style.background = 'lightslategray'
        tr[o+2].style.color = 'white'
        if(!is_multi && multi.size != 0) {
            let temp = Array.from(multi)
            document.getElementsByTagName('tr')[o+2].style.background = 'white'
            document.getElementsByTagName('tr')[o+2].style.color = '#000000B3'
            for (let i = 0; i < multi.size; i++) {
                document.getElementsByTagName('tr')[temp[i]].style.background = 'white'
                document.getElementsByTagName('tr')[temp[i]].style.color = '#000000B3'
            }
            multi.clear()
            tr[indexed].style.background = 'white'
            tr[indexed].style.color = '#000000B3'
            if(indexed == o+2) {
                document.getElementById('trash').style.top =  '-100px'
            }
        }
        else {
            if(multi.has(o+2)) {
                tr[o+2].style.background = 'white'
            tr[o+2].style.color = '#000000B3'
                multi.delete(o+2)
            }
            else {

                multi.add(o+2)
            }
        }
        indexed = o+2;
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
    document.getElementById('trash').onclick = function() {
        launch_toast('Xoá thành công','#E0144C')
        if(multi.size == 1) {

setTimeout(() => {
    location.href = '<?= $_SERVER['PHP_SELF']?>?delete_data='+ (document.getElementsByTagName('tr')[row+2].firstChild.innerHTML);
}, 2000);
}
else {
setTimeout(() => {
    location.href = '<?= $_SERVER['PHP_SELF']?>?delete_datas='+ del_data(Array.from(multi));
}, 2000);

}
    }
    function launch_toast(text,bg = null) {
    var x = document.getElementById("toast")    
    document.getElementById('desc').innerText = text
    if(bg) {
        x.style.background =  bg
        document.getElementById('img').style.color = bg

    }
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
}
function del_data(text) {
    let result = ''
    let dom =  document.getElementsByTagName('tr')
    for(let i = 0 ; i < text.length ; i++)
{
result+= '"' + dom[Array.from(multi)[i]].firstChild.innerText + '",';

}
return result;
}
</script>