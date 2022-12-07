<?php
require_once('../../config/config.php');
if(isset($_POST['username'])) { 
    $file_name =$_POST['username'].'.' . explode('/',$_FILES['image']['type'])[1];
    move_uploaded_file($_FILES['image']['tmp_name'],'../../src/images/customers/'. $file_name);
    insertData('customers',$_POST['username'],$_POST['password'],$_POST['name'],$file_name,$_POST['email'],$_POST['admin'] );
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
elseif(isset($_POST['username_img']))
 { 
    $name_file = $_POST['username_img'].'.' . explode('/',$_FILES['img_change']['type'])[1];
    move_uploaded_file($_FILES['img_change']['tmp_name'],'../../src/images/customers/'. $name_file);
    editData('customers','image_customer',$name_file,'username_customer',$_POST['username_img']);
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

    table img {
        border-radius: 50%;
        width: 50px;
        height: 50px;
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

    td:not(:last-child):hover {
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
.is_admin {
    width: 20px;
    background-color: #E0144C;
    margin: 0 auto;
    transition-duration: 0.3s;
    border-radius: 3px;
    height: 20px;
}
.checked {
    background-color: #2cbc63;
}
</style>
<div id="toast"><div id="img">IGT</div><div id="desc">Xoá thành công</div></div>
<button id="add"> <i class="fa-solid fa-plus"></i> </button>
<button id="close"> <i class="fa-solid fa-close"></i> </button>
<form method="POST" id="img_form" enctype= "multipart/form-data">  
</form>
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
            <td class="add_data">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="username"/>
                    <input type="hidden" name="password"/>
                    <input type="hidden" name="name"/>
                    <input type="file" name="image"/>
                    <input type="hidden" name="email"/>
                    <input type="hidden" name="admin"/>
                </form>
            </td>
            <td class="add_data" contenteditable=""></td>
            <td style="" class="add_data" contenteditable=""></td>
        </tr>
        <?php
        
        $column = explode(',',getColumn('customers'));
            for ($i=0; $i < count($data); $i++) { 
                echo '<tr>';
                for ($j=0; $j < 5; $j++) { 
                    if(    $j == 3) {
                    echo '<td onclick="change_img('. $i .')"> <input type="hidden" name="username_img" value="'. $data[$i][0] .'" /> <input type="file" style="display:none" class="img_input" name="img_change" onchange="confirm_img(`'. $data[$i][0] .'`,'. $i .')"/> <img src="../../src/images/customers/'. $data[$i][3] .'"/></td>';
                    }
                    else {

                        echo '<td onmousedown="multi_select(event)" onfocusout="confirm_edit(this,`'. $data[$i][0] .' `,'. $j . ')" ondblclick="selected_db(this)" onclick="selected(this,'. $i .','. $j .',`'. $column[$j] . '`)">'. $data[$i][$j]  .'</td>'   ;
                    }
                    }
                $check_admin = '';
                if($data[$i][5] == '1') {
                    $check_admin = 'checked';
                }
                 echo '<td><div onclick="change_admin(this,`'. $data[$i][0] .'`)" class="is_admin '. $check_admin .'"></div></td>'   ;
                
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
    var is_submit = false
    function multi_select(event) {
        if (event.ctrlKey) {
            is_multi = true
        } else {
    is_multi = false

}
    }
    add.onclick = function () {
        // str = ''
        // for (let i = 0; i < add_data.length; i++) {
        //         str += field[i] + '=' + add_data[i].innerHTML + '&'
                
        // }
        if(!isConfirm) {
            change_button()
                document.getElementById('add_column').style.display = 'table-row'
                document.getElementById('close').style.visibility = 'visible'
                add_data[0].focus()
                document.getElementById('add_column').getElementsByTagName('td')[0].focus()   
                is_submit = true
        }
        else if (is_submit) {
            for(let i = 0 ; i < field.length ; i++) {
                if(i != 3) {

                    document.getElementsByName(field[i])[0].value = add_data[i].innerHTML
                }
            }
            // if(!str == 'username=&password=&name=&image=&email=&admin=&') {
                launch_toast('Thêm thành công','#68B984')
                setTimeout(() => {
                    document.forms[1].submit()
                }, 2000);
            }
        // }
    }
    document.getElementById('close').onclick = function () {
        document.getElementById('add_column').style.display = 'none'
        document.getElementById('close').style.visibility = 'hidden'
        is_submit = false
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
        
        document.getElementById('trash').style.top =  window.event.pageY + 'px'
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
function change_admin(obj,id)
 {
     let check = (obj.classList.toggle('checked') ? '1' : '0')
launch_toast('Cập nhật thành công',"#68b894")
setTimeout(() => {
    location.href = '<?= $_SERVER['PHP_SELF'] ?>?data_edit=' + check + '&col=admin&username='+id
}, 2000);
 }
 function change_img(obj) {
    document.getElementsByClassName('img_input')[obj].click()
 }
 function confirm_img(id,index) {
    document.getElementsByClassName('img_input')[index].setAttribute('form','img_form')
    document.getElementsByName('username_img')[index].setAttribute('form','img_form')
    document.forms[0].submit()
 }
</script>