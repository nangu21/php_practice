<?php
$today = date("Y-m-d", time());
$xday = $_POST['date'];
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
<p><?= htmlspecialchars($today) ?></p>
<p><?= htmlspecialchars($xday) ?></p>
</body>
</html>