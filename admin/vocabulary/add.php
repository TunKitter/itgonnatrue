<?php
    require_once('../../config/config.php');
if(isset($_GET['name'])) {
    $usage = array();
    $a = explode(',',rtrim($_GET['usage'],','));
    for ($i=0; $i < count($a); $i++) { 
        $usage[$i] = $a[$i];
    }
    $usage = base64_encode(serialize($usage));
    $a =  explode(',',rtrim($_GET['example'],','));
    $example = array();
    for ($i=0; $i < count($a); $i++) { 
        $c = explode(':',$a[$i]);
        $example[$i] = array($c[0],$c[1]);
    }
    $example =  base64_encode(serialize($example));
    $same = '';
    if($_GET['same'] == '') {
        $same  =  $_GET['type'] . '_'.$_GET['name'] ;
    } 
    else {
        $arr = explode('_',(getOneData('vocabulary','name_voca',$_GET['same'])[0][0]));
        $same = $_GET['type'] .'_' . $_GET['name']. '_' . $arr[count($arr)-1];    
    // echo getOneData('vocabulary','name_voca',$_GET['same'])[0][0];
    // echo '<br>';
    echo $arr[count($arr)-1];
    }
    echo '<br>';
    echo $same;
    insertData('vocabulary',$same ,$_GET['name'],$_GET['cate'],$_GET['meaning'],$usage,$example,0);
    header('location: '. $_SERVER['PHP_SELF']);
}
?>
<style>
    body {
        background: rgba(0, 0, 0, 0.01);
    }
    form {
        display: flex;
        flex-flow: column wrap;
        gap: 1em 0 ;
    }
     label {
        min-width: 150px;
        display: inline-block;
        font-weight: bold;
    }
     input {
        width: 500px;
    font-family: inherit;
    height: 50px;
    border: none;
    border-radius: 12px;
    padding: 10px 20px;
    color: lightslategray;
    box-sizing: border-box;
    outline: none;
    letter-spacing: 1px;
    font-weight: bold;
    font-size: 1.2em;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
    }
    select {
        border: none;
        text-align: center;
        height: 40px;
width: 20%;
font-size: 1.03em;
        background: transparent;
        outline: none;
    }
    option {
        border: none;
    }
    #contain_inp3,#contain_inp4 {
        display: inline-flex;
        justify-content: center ;
        flex-wrap: wrap;
        gap: 1em;
    }
    #suggest {
        list-style: none;
        position: absolute;
        display: flex;
        flex-direction: column;
        background: white;
        width: 300px;
        top: 3.3em;
        overflow-y: hidden;
        padding: 10px;
        font-weight: bold;
        
        left: -20%;
        border-radius: 12px;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
    transition-duration: 0.4s;
opacity: 0;

    }
    #suggest li {
        padding: 10px;
        border-radius: 5px;
    }
    #suggest li:hover {
        background: lightslategray;
        color: white; 
    }

</style>
<h2 style="font-size: 2em">Thêm từ</h2>
<br>
<br>
<form>
    <div class="input">
        <label>Tên từ</label>
        <input type="text" name="name">
    </div>
    <div class="input">
        <label>Nghĩa</label>
        <input type="text" name="meaning">
    </div>
    <br>
    <div class="input">
        <label>Loại</label>
        <select name="cate">
            <?php
            $cate = getAllData('category');
            for ($i=0; $i < count($cate); $i++) { 
                echo '<option value="'.  $cate[$i][0] .'">'. $cate[$i][1] .'</option>';
            }
            ?>
        </select>
        <label style="margin-left: 1em">Từ loại</label>
        <select name="type">
            <option value="noun">Danh từ</option>
            <option value="verb">Động từ</option>
            <option value="adj">Tính từ</option>
            <option value="adv">Trạng từ</option>
            <option value="conj">Liên từ</option>
        </select>

    </div>
    <input type="hidden" name="create" value="1">
    <div class="input">
        <label>Cách dùng</label>
        <span id="contain_inp3">
            <input type="text" id="sss" style="width: 300px">
        </span>
     <input type="button" id="add_usage" value="+" style="margin-left: 1em; background: white;color:#4481eb;width: 50px; border-radius: 50%;height: 50px;">
    </div>
    <input type="hidden" id="usage_input" name="usage">
    <input type="hidden" id="example_input" name="example">
    <div class="input">
        <label>Ví dụ</label>
        <span id="contain_inp4">

            <span id="ssss">
                <input type="text" name="example_name" style="width: 300px;margin-right: 1em;">
                <span style="margin-right: 1em"><i class="fa-sharp  fa-solid fa-language"></i></span>
                <input type="text" name="example_meaning" style="width: 300px">
            </span>
        </span>
     <input type="button" id="add_example" value="+" style="margin-left: 1em; background: white;color:#4481eb;width: 50px; border-radius: 50%;height: 50px;">

    </div>
    <div class="input" style="position:relative">
        <label>Từ đồng nghĩa</label>
        <input type="text" autocomplete="off" name="same" oninput="suggest(this.value)" id="same_word">
        <ul id="suggest">
            <?php
            $data = getAllData('vocabulary');
            for ($i=0; $i < count($data); $i++) { 
                echo '<li>'. $data[$i][1]  .'</li>';
            }
            ?>
        </ul>
    </div>
    <br>
    <button style="margin: 0 auto"  class="btn5 btn5-hover">Thêm từ</button>
</form>
<br><br><br><br><br><br><br>
<script>
    inp3 = document.getElementById('contain_inp3') 
    ss =document.getElementById('sss').outerHTML
    inp4 = document.getElementById('contain_inp4') 
    sss =document.getElementById('ssss').outerHTML
    document.getElementById('add_usage').onclick = function() {
        inp3.innerHTML += ss
    }
    document.getElementById('add_example').onclick = function() {
        inp4.innerHTML += sss

    }
    var uls = document.getElementById('suggest')
    var arr_uls = ''
    for(let i = 0 ; i < uls.children.length ; i++) {
        arr_uls+= uls.children[i].innerText + ','
    }
    arr_uls = arr_uls.substring(0,arr_uls.length-1).split(',')
    function suggest(word_input) {
        uls.style.opacity = 1
        uls.style.left = '17%'
        let str = ''
        let count = 0
        for (let i = 0; i < arr_uls.length; i++) {
            if(arr_uls[i].includes(word_input)) {
                count++;
str+= '<li onclick="document.getElementById(`same_word`).value = this.innerText">' +  arr_uls[i] + '</li>'
            }   
            if(count >= 5) {
                break
            }
        }
        if(str) {
            uls.innerHTML = str
        }
        else {
            uls.style.opacity = 0
        }
        
    }
    
    document.getElementById('same_word').onblur = function() {
        uls.style.opacity = 0
        setTimeout(() => {
            
            uls.style.left = '-20%'
        }, 500);

    }
    document.getElementsByTagName('button')[1].onmouseenter = function() {
        let usage = ''
        let example = ''
        for(let i = 0 ; i < inp3.children.length ; i++) {
            usage+= (inp3.children[i].value)+','
        }
        let a1 = document.getElementsByName('example_name')
        let a2 = document.getElementsByName('example_meaning')
        for(let i = 0 ; i < inp4.children.length ; i++) {
            example+= a1[i].value+ ':' + a2[i].value + ',' 
        }
        document.getElementById('usage_input').setAttribute('value',usage)
        document.getElementById('example_input').setAttribute('value',example)
    }
</script>