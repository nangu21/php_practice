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
echo "success!";

//切断
$dbh = null;
