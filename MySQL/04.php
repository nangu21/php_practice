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
$stmt = $dbh->prepare("insert into users (name,email,password) values (:name,:email,:password)");
$stmt->bindParam(":name", $name);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":password", $password);

$name = "n10";
$email = "e10";
$password = "p10";

$stmt->execute(); //実行

echo $dbh->lastInsertId();

echo "done";


//切断
$dbh = null;
