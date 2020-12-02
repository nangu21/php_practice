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
$sql = "select * from users"; //usersテーブルから全列(*)をselect(抽出)する
$stmt = $dbh->query($sql); //mysqlで実行

foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $user){
    //$tmt->fetchAll(PDO::FETCH_ASSOC) sql実行結果を連想配列で取り出す
    var_dump($user['name']);
}

echo $dbh->query("select count(*) from users")->fetchColumn()." records count";


//切断
$dbh = null;
