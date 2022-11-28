<?php
try {
    $connect = new PDO('mysql:host=localhost;dbname=igt','root','');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $temp = '';
function getAllData($column) {
    global $connect;
    $exe = $connect->prepare('SELECT * FROM '. $column);
            $exe->execute();
            $exe = $exe->fetchAll();
    return $exe;
 }
function getCustomData($code) {
    global $connect;
    $exe = $connect->prepare($code);
            $exe->execute();
            $exe = $exe->fetchAll();
    return $exe;
 }
 
function getColumn($field) {
    global $connect;
    $exe = $connect->query('SHOW COLUMNS FROM '. $field );
            $exe = $exe->fetchAll(MYSQLI_BOTH);
            $str = '';
            for ($i=0; $i < count($exe); $i++) { 
                $str.= $exe[$i][0]. ',';
            }
    return rtrim($str,',');
 }

function getOneData($column,$field,$content) {
    global $connect;
    $exe = $connect->prepare('SELECT * FROM '. $column . ' WHERE '. $field . ' = ' .  '"'. $content .'" LIMIT 1');
            $exe->execute();
            $exe = $exe->fetchAll();
    return $exe;
 }
function insertData(...$arr) {
    global $connect;
    global $temp ;
    for ($i=1; $i < count($arr); $i++) { 
        $temp.= ',"'. $arr[$i] .'"';
    }
    $temp = substr($temp,1);
            $connect->prepare('INSERT INTO '. $arr[0] . '('. getColumn($arr[0]) .') VALUES('. $temp .')')->execute();
    
}
function deleteData($column,$felid,$content) {
    global $connect;
            $connect->prepare('DELETE FROM '. $column .' WHERE '. $felid . ' = "' . $content .'"')->execute();
    }
function editData($column,$felid,$content,$key,$key_content) {
    global $connect;
            $connect->prepare('UPDATE '. $column  .' SET '. $felid . ' = "' . $content .'" WHERE '. $key .' = "'. $key_content .'"')->execute();
}
  } catch(PDOException $e) {
    die("Kết nối không thành công . Chi tiết : " . $e->getMessage());
  }

?>