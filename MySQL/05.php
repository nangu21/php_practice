<?php

//データベースへの接続
//mysql
try{
    $dbh = new PDO('mysql:host=?;dbname=?','root','?');
}catch(PDOException $e){
    var_dump($e->getMessage());
    exit;
}

//処理
//$stmt = $dbh->prepare("update users set email = :email where name like :name"); //emailを:emailに変える
//$stmt->execute(array(":email"=>"dummy", ":name"=>"n%")); //n%->nの後ろは任意

$stmt = $dbh->prepare("delete from users where password = :password");
$stmt->execute(array(":password"=>"p10"));

echo $stmt->rowCount()." records deleted";

echo "done";


//切断
$dbh = null;
