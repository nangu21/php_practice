<?php
//今日の日付取得
$today = time();
//終了予定日の日付取得
$xday = strtotime($_POST['date']);

//差を計算(秒数)
$result = $xday - $today;
//差を日数に変換(小数点以下切り捨て)
$interval = floor($result / (60*60*24));
//差を週の数に変換(小数点以下切り捨て)
$num_week = floor($interval / 7);

//進捗ペース(optionタグのvalueを取得)
if(isset($_POST['rest'])){
	$rest = $_POST['rest'];
}

//稼働日数計算
$active = $interval - ($rest * $num_week);

//ページ数取得
$pages = $_POST['pages'];

//進捗計算結果
$disp = $pages / $active;
?>

<!DOCTYPE html>
<html class="no-js" lang="ja">
<head>
<meta charset="utf-8">
<title>進捗管理アプリ</title>
<link rel="stylesheet" href="">
</head>
<body>
<h1>進捗管理アプリ</h1>
<p><?= $today ?></p>
<p><?= htmlspecialchars($xday) ?></p>
<p><?= "日数残り" .$interval ."日(". $num_week ."週間)"  ?></p>
<p><?= "週休" .$rest ?></p>
<p><?= "稼働日数" . $active ?></p>
<p><?=  "結果：1日" . $disp. "ページ"?></p>
</body>
</html>