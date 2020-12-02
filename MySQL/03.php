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
//$stmt = $dbh->prepare("insert into users (name,email,password) values (?,?,?)");
//$stmt->execute(array("n","e","p"));

$stmt = $dbh->prepare("insert into users (name,email,password) values (:name,:email,:password)");
$stmt->execute(array(":name"=>"n2",":email"=>"e2",":password"=>"p2"));

echo "done";


//切断
$dbh = null;
