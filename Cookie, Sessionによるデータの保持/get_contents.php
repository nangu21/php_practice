<?php

$birthday = $_POST['birthday'];

//l:曜日
//strtotimeでタイムスタンプ秒数を取得し、dateで変換する
$youbi = date("l", strtotime($birthday));

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>PHPの練習</title>
</head>
<body>
    <h1>PHPの練習</h1>
    <!--htmlspecialcharsでエスケープ-->
    <p><?php echo htmlspecialchars($youbi); ?></p>
</body>
</html>