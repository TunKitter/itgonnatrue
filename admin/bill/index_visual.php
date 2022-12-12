<?php
require_once('../../config/config.php');

if(isset($_GET['delete_data'])) {
    deleteData('feedback','id_feedback',$_GET['delete_data']);
    header('location: '. $_SERVER['PHP_SELF']);
}
elseif(isset($_GET['delete_datas'])) {
    getCustomData('DELETE FROM feedback WHERE id_feedback IN ('. rtrim($_GET['delete_datas'],',') .')');
    header('location: '. $_SERVER['PHP_SELF']);
}

$data = getCustomData('SELECT * FROM feedback WHERE id_feedback LIKE "purchase%"');
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
<div id="toast">
    <div id="img">IGT</div>
    <div id="desc">Xoá thành công</div>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Tên</th>
            <th>Nội dung</th>
            <th>Email</th>


        </tr>
    </thead>
    <tbody>
       <?php
        $column = explode(',',getColumn('feedback'));
            for ($i=0; $i < count($data); $i++) { 
                echo '<tr>';
                for ($j=0; $j < 5; $j++) { 
                    echo '<td onmousedown="multi_select(event)" onclick="selected(this,'. $i .','. $j .',`'. $column[$j] . '`)">'. $data[$i][$j]  .'</td>'   ;
                }
                echo '</tr>';
            }
            ?>
    </tbody>

</table>
<img src="https://cdn-icons-png.flaticon.com/512/5028/5028066.png" id="trash" alt="">
<script>
    var isConfirm = false
    var indexed = 0
    var row = 0
    var field = ['id', 'customer', 'name', 'content', 'email']
    var is_multi = false;
    var multi  = new Set()
    function multi_select(event) {
        if (event.ctrlKey) {
            is_multi = true
        } else {
    is_multi = false

}         
    }  
    
    function selected(obj, o,index, field_2) {
        
        document.getElementById('trash').style.top =  window.event.clientY + 'px'
        document.getElementById('trash').style.left =  window.event.clientX + 'px'
        let tr  = document.getElementsByTagName('tr')
        tr[o+1].style.transitionDuration = '0.01s'
        tr[o+1].style.background = 'lightslategray'
        tr[o+1].style.color = 'white'
        if(!is_multi && multi.size != 0) {
            let temp = Array.from(multi)
            document.getElementsByTagName('tr')[o+1].style.background = 'white'
            document.getElementsByTagName('tr')[o+1].style.color = '#000000B3'
            for (let i = 0; i < multi.size; i++) {
                document.getElementsByTagName('tr')[temp[i]].style.background = 'white'
                document.getElementsByTagName('tr')[temp[i]].style.color = '#000000B3'
            }
            multi.clear()
            tr[indexed].style.background = 'white'
            tr[indexed].style.color = '#000000B3'
            if(indexed == o+1) {
                document.getElementById('trash').style.top =  '-100px'
            }
        }
        else {
            if(multi.has(o+1)) {
                tr[o+1].style.background = 'white'
            tr[o+1].style.color = '#000000B3'
                multi.delete(o+1)
            }
            else {

                multi.add(o+1)
            }
        }
        indexed = o+1;
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
        if(multi.size == 1) {

setTimeout(() => {
    location.href = '<?= $_SERVER['PHP_SELF']?>?delete_data='+ (document.getElementsByTagName('tr')[row+1].firstChild.innerHTML);
}, 2000);
}
else {
setTimeout(() => {
    location.href = '<?= $_SERVER['PHP_SELF']?>?delete_datas='+ del_data(Array.from(multi));
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
    let dom =  document.getElementsByTagName('tr')
    for(let i = 0 ; i < text.length ; i++)
{
result+= '"' + dom[Array.from(multi)[i]].firstChild.innerText + '",';

}
return result;
}
</script>