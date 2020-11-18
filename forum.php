<?php
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }//実体参照<>"などの特殊文字を変換する

$rows = json_decode(file_get_contents('bbs1.json'), true);
//bbs1.jsonを読み込んで配列にして$rowsに格納する

//既存データの中で最大のidを取得する
//新規の投稿のidは数字で、既存の記事の中で最大のid+1とする

$max_id= 0; //暫定の最大idを0とする

foreach($rows as $key => $value){
  //記事のidが暫定最大より大きければそれを新しい暫定最大idとする
  if($value['id'] > $max_id){
    $max_id = $value['id'];
  }

}

if (!empty($_POST['write'])) {
//$_POST['write']が空でないとき+form送信されたとき
    $row = array(
      'id' => $max_id + 1,
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
  }

  if (!empty($_POST['delete'])) {
    //$_POST['delete']が空でないとき+削除がform送信されたとき
        foreach($rows as $key => $value){
          
          //記事のidがパラメータで渡されたidと一致するなら、その要素を削除する
          if($value['id'] == $_POST['id']){
            unset($rows[$key]);
          }

          file_put_contents('bbs1.json', json_encode($rows));
          //削除後、json形式に変換してbbs1.jsonとして保存
        }
  }

  if (!empty($_POST['edit'])) {
    //$_POST['edit']が空でないとき+編集がform送信されたとき
    //編集ボタンを押して画面遷移した場合
        foreach($rows as $key => $value){
          
          //記事のidがパラメータで渡されたidと一致するなら、その要素の内容をdefaultに格納する
          //$default = $value;
          
          if($value['id'] == $_POST['id']){
            unset($rows[$key]);

            //記事のidがパラメータで渡されたidと一致するなら、その要素の内容をdefaultに格納する
          $default = $value;
          }

        file_put_contents('bbs1.json', json_encode($rows));
        //json形式に変換してbbs1.jsonとして保存
    }
  }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>掲示板１</title>
</head>
<body>

<?php if(!empty($_POST['edit'])){?>
<form method="post">
お名前: <input name="name" value="<?php echo h($default['name']); ?>"><br>
題名: <input name="title" value="<?php echo h($default['title']); ?>"><br>
<textarea name="contents" cols="60" rows="5"><?php echo h($default['contents']); ?></textarea><br>
<input type="submit" name="write" value="送信">
</form>
   
<?php } else { ?>

<form method="post">
お名前: <input name="name"><br>
題名: <input name="title"><br>
<textarea name="contents" cols="60" rows="5"></textarea><br>
<input type="submit" name="write" value="送信">
</form>

<?php } ?>

<hr>
<!--全ての投稿を表示する-->
<?php foreach($rows as $row): ?>
  <strong><?php echo h($row['id'].":".$row['title']) ?></strong>
  <br><small>投稿者：<?php echo h($row['name']) . ' ' . h($row['time']) ?></small>
  <p><?php echo nl2br(h($row['contents']), false) ?></p>
  <form method="post">
  <input type="submit" name="delete" value="削除">
  <input type="submit" name="edit" value="編集">
  <input type="hidden" name="id" value="<?php echo h($row['id']) ?>">
  </form>
  <hr>
<?php endforeach ?>
</body>
</html>