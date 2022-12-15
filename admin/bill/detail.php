<?php
if(isset($_GET['v']))
 {
    require_once('../../config/config.php');
    $data =  getCustomData('SELECT name_customer,content_feedback FROM customers INNER JOIN feedback ON username_customer = customer_feedback WHERE id_feedback LIKE "purchase%" AND customer_feedback = "'. $_GET['v'] .'" LIMIT 1');
 }
?>
<style>
    form {
        display: flex;
        flex-direction: column;
        width: 50vw;
        gap: 1.7em;
    }
    label {
        display: inline-block;
        min-width:300px;
        padding: 10px;
    } 
    select {
        border: none;
    }
    input[type=checkbox] {
        visibility: hidden;
    }
    label[for=sound]::after {
       content: '';
       width: 20px;
       height: 20px;
       background: #68B984;
       border-radius: 2px;
       position: relative;
       left: 250;
       display: inline-block;
    }
    button {
        background: white;
        border-width: 1px;
        box-sizing: border-box;
        padding: 10px;
    }
    form input[type=password] {
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
</style>
<div id="container">
    <form>
        <div>
            <label>Tên khách hàng</label>
            <span style="font-weight: bold;"><?= $data[0][0] ?> <span style="font-weight: normal; color:#4481eb; ">( <?= $_GET['v'] ?> )</span> </span>
        </div>
        <div>
            <label>Thời gian thanh toán</label>
            <span style="font-weight: bold;"><?= substr(explode(',',$data[0][1])[1],5) ?> </span>
        </div>
        <div>
            <label>Mã giao dịch</label>
            <span style="font-weight: bold;"><?= substr(explode(',',$data[0][1])[2],10) ?></span>
        </div>
        <div>
            <label for="sound">Trạng thái</label>
            <input id="sound" type="checkbox">
        </div>

    </form>
</div>
<script>
    function submit() {
        if(confirm('Bạn chắc chắn muốn xoá ?'))
         {
             document.forms[0].submit()
            }
            
    }
</script>
