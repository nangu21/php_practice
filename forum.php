<?php
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }//実体参照<>"などの特殊文字を変換する

$rows = json_decode(file_get_contents('bbs1.json'), true);
//bbs1.jsonを読み込んで配列にして$rowsに格納する

if (!empty($_POST['write'])) {
//$_POST['write']が空でないとき+form送信されたとき
    $row = array(
      'name' => $_POST['name'],
      'title' => $_POST['title'],
      'contents' => $_POST['contents'],
      'time' => date("Y/m/d H:i:s")
    );
    //入力された name+title+contentsと投稿時間で連想配列$rowを組み立てる
    array_unshift($rows, $row);
    //$rowを配列$rowsの最初に加える
    file_put_contents('bbs1.json', json_encode($rows));
    //json形式に変換してbbs1.jsonとして保存
    
    //必要に応じてjsonファイルのパーミッションを変更する！
    
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>掲示板１</title>
</head>
<body>
<form method="post">
お名前: <input name="name"><br>
題名: <input name="title"><br>
<textarea name="contents" cols="60" rows="5"></textarea><br>
<input type="submit" name="write" value="送信">
</form>
<hr>
<?php foreach($rows as $row): ?>
  <strong><?php echo h($row['title']) ?></strong>
  <br><small>投稿者：<?php echo h($row['name']) . ' ' . h($row['time']) ?></small>
  <p><?php echo nl2br(h($row['contents']), false) ?></p>
  <hr>
<?php endforeach ?>
</body>
</html>
