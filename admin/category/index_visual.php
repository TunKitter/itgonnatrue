    <?php
require_once('../../config/config.php');
if(isset($_POST['id']) && isset($_POST['name']) && isset($_FILES['img'])) { 
    $name_file  = $_POST['id']. '.'.  explode('/',$_FILES['img']['type'])[1];
    move_uploaded_file($_FILES['img']['tmp_name'],'../../src/images/category/'.$name_file );
    insertData('category',$_POST['id'],$_POST['name'],$name_file);
    header('location: '. $_SERVER['PHP_SELF']);
}
elseif(isset($_GET['delete_data'])) {
    unlink('../../src/images/category/'. getOneData('category','id_category',$_GET['delete_data'])[2]);
    deleteData('category','id_category',$_GET['delete_data']);
    header('location: '. $_SERVER['PHP_SELF']);
}
elseif(isset($_GET['data_edit']) && isset($_GET['col']) && isset($_GET['username'])) {
    editData('category',$_GET['col'].'_category',$_GET['data_edit'],'id_category',$_GET['username']);
    header('location: '. $_SERVER['PHP_SELF']);
}
elseif(isset($_GET['delete_datas'])) {
    getCustomData('DELETE FROM category WHERE id_category IN ('. rtrim($_GET['delete_datas'],',') .')');
    header('location: '. $_SERVER['PHP_SELF']);
}
elseif(isset($_POST['file_name']) && isset($_FILES['img_change']))
{
    move_uploaded_file($_FILES['img_change']['tmp_name'],'../../src/images/category/'. $_POST['file_name']);
    header('location: '. $_SERVER['PHP_SELF']);
 }
$data = getAllData('category');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
<link rel="stylesheet" href="../../styles/storage.css">
<link rel="stylesheet" href="../../styles/detail.css">
<style>
    td input {
        border: none;
        background: transparent;
        width: 100px !important ;
        outline: none;
    }
    #toast {
        right: initial;
        left: 0;
    }
    table {
        width: 100%;
        height: 90vh;
    }

    thead tr th {
        background: lightslategray;
        color: white;
        padding: 10px;
    }

    td {
        text-align: center;
        padding: 10px;
        min-width: 100px;
        white-space: nowrap;
        overflow: auto;
        text-overflow: clip;
    }

    img {
        width: 100px;
        max-height: 60px;
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
        position: fixed;
        bottom: 2em;
        right: 2em;
        border-radius: 50%;
        z-index: 100;
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
#change_image {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
}
</style>
<div id="toast"><div id="img">IGT</div><div id="desc">Xoá thành công</div></div>
<button id="add" form="image_form"> <i class="fa-solid fa-plus"></i> </button>
<button id="close"> <i class="fa-solid fa-close"></i> </button>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Ảnh</th>
        </tr>
    </thead>
    <tbody>
        <tr id="add_column">
            <!-- <td class="add_data" contenteditable=""></td> -->
            <!-- <td class="add_data" contenteditable=""></td> -->
            <form method="post" enctype="multipart/form-data">
                <td> <input type="text" name="id"></td>
                <td> <input type="text" name="name"></td>
                <td class="add_data"><input name="img" type="file" ></td>
            </form>
        </tr>
        <?php
        $column = explode(',',getColumn('category'));
        
            for ($i=0; $i < count($data); $i++) { 
                echo '<tr>';
                for ($j=0; $j < 2; $j++) { 
                    echo '<td onmousedown="multi_select(event)" onfocusout="confirm_edit(this,`'. $data[$i][0] .' `,'. $j . ')" ondblclick="selected_db(this)" onclick="selected(this,'. $i .','. $j .',`'. $column[$j] . '`)">'. $data[$i][$j]  .'</td>'   ;
                }
            echo '<td style="position: relative"> <form method="post" enctype="multipart/form-data" >
            <input type="hidden" name="file_name" value="'. $data[$i][2] .'" />
            <input id="change_image" type="file" name="img_change" onchange="document.forms['. $i+1 .'].submit()" />
            </form> 
             <img src="../../src/images/category/'. $data[$i][2].'"/></td>';
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
    var field = ['id', 'name', 'image']
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
                document.getElementsByTagName('input')[1].focus()
                document.getElementById('add_column').getElementsByTagName('td')[0].focus()   
        }
        else if (str.length > 0) {
            // if(!str == 'username=&password=&name=&image=&email=&admin=&') {
                
                launch_toast('Thêm thành công','#68B984')
                setTimeout(() => {
                    document.forms[0].submit()
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
        
        document.getElementById('trash').style.top =  window.event.pageY + 'px'
        document.getElementById('trash').style.left =  window.event.clientX + 'px'
        console.log(window.event);
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
        x.style.background = bg
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