<?php
//レシピ管理用
function h($str){
  //特殊文字エスケープ
  return htmlspecialchars($str,ENT_QUOTES);
}

//楽天レシピのランキングAPIを取得
$response= file_get_contents("https://app.rakuten.co.jp/services/api/Recipe/CategoryRanking/20170426?format=json&applicationId=アプリケーションID");
$recipe= json_decode($response, true);
$items= array();
foreach($recipe["result"] as $item){
  $items[]= array(
    'name'=> $item['recipeTitle'],
    'img'=> $item['foodImageUrl'],
    'url'=> $item['recipeUrl'],
    'rank'=> $item['rank']
  );
}

//recipeManage.jsonを読み込んで配列にして$rowsに格納する
$rows= json_decode(file_get_contents("recipeManage.json"), true); //recipeManage.jsonの中身を$rowsに格納

//既存データの中で最大のidを取得する
//新規の投稿のidは数字で、既存の記事の中で最大のid+1とする
$max_id= 0; //暫定の最大idを0とする

foreach($rows as $key => $value){
  //記事のidが暫定最大より大きければそれを新しい暫定最大idとする
  if($value['id'] > $max_id){
    $max_id = $value['id'];
  }
}

//$_POST['write']が空でないとき+form送信されたとき
if(!empty($_POST['write'])){
  //id,入力内容と取得した時間で連想配列$rowを組み立てる
  $row= array(
    'id'=> $max_id + 1,
    'recipe_title'=> $_POST['recipe_title'],
    'ingredients'=> $_POST['ingredients'],
    'time'=> date("Y/m/d H:i:s"),
    'schedule'=> $_POST['schedule'],
    'selected'=> $_POST['select']
  );

  //$rowを配列$rowsの最初に加える
  array_unshift($rows, $row);

  //json形式にしてrecipeManage.jsonとして保存する
  file_put_contents("recipeManage.json", json_encode($rows));
}

//$_POST['delete']が空でないとき+削除がform送信されたとき
if(!empty($_POST['delete'])){
  foreach($rows as $key => $value){
    //記事のidがパラメータで渡されたidと一致するなら、その要素を削除する
    if($value['id'] == $_POST['id']){
      unset($rows[$key]);
    }
    //json形式にしてrecipeManage.jsonとして保存する
    file_put_contents('recipeManage.json', json_encode($rows));
  }
}

//$_POST['edit']が空でないとき+編集がform送信されたとき
if(!empty($_POST['edit'])){
  foreach($rows as $key => $value){
    //記事のidがパラメータで渡されたidと一致するなら、その要素の内容をdefaultに格納する    
    if($value['id'] == $_POST['id']){
      unset($rows[$key]);
      $default = $value;
    }
  }
  //json形式にしてrecipeManage.jsonとして保存する
  file_put_contents('recipeManage.json', json_encode($rows));
}

?>

<!DOCTYPE HTML>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>献立管理表</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <h1>献立管理表</h1>

  <h2>レシピを追加</h2>

  <!--ここから献立表(削除・編集機能付き)-->
  <?php if(!empty($_POST['edit'])){  //編集ボタンが押された場合のフォーム ?>
  <form method="post">
  日にち: <input type="date" name="schedule" value="<?= date('Y-m-d'); ?>"><br>
  時間帯: <select name="select">
    <option value="昼">昼</option>
    <option value="夜">夜</option>
    <option value="朝">朝</option>
  </select><br>
  料理名: <input type="text" name="recipe_title" value="<?php echo h($default['recipe_title']); ?>" style="width:250px;"><br>
  材料: <textarea name="ingredients" cols="60" rows="2" value="<?php echo h($default['ingredients']); ?>"></textarea><br>
  <br><input type="submit" name="write" value="送信">
  </form>

  <?php } else {  //通常フォーム?>
  <form method="post">
  日にち: <input type="date" name="schedule" value="<?= date('Y-m-d'); ?>"><br>
  時間帯: <select name="select">
    <option value="昼">昼</option>
    <option value="夜">夜</option>
    <option value="朝">朝</option>
  </select><br>
  料理名: <input type="text" name="recipe_title" style="width:250px;"><br>
  材料: <textarea name="ingredients" cols="60" rows="2"></textarea><br>
  <br><input type="submit" name="write" value="送信">
  </form>

  <?php } ?>

<hr>
<!--全ての投稿を表示する-->
<?php foreach($rows as $row): ?>
  <h3><strong><?php echo h($row['schedule']). " ". h($row['selected']) . "【 ". h($row['recipe_title']) . " 】" ?></strong></h3>
  <p><?php echo nl2br(h($row['ingredients']), false) ?></p>
  <form method="post">
  <small>投稿日：<?php echo h($row['time']) ?></small>
  <input type="submit" name="delete" value="削除">
  <input type="submit" name="edit" value="編集">
  <input type="hidden" name="id" value="<?php echo h($row['id']) ?>">
  </form>
<hr>
<?php endforeach ?>

<br><h2>(参考)楽天レシピ：リアルタイムランキング</h2>
  <?php
  //楽天APIの出力(ランキング4位まで)
  foreach($items as $desp){
    $i=1;
    $i++;
  ?>
  <a href="<?= $desp['url'] ?>"><p><?php echo $desp['rank']. "位: ". $desp['name']; ?></p></a>
  <img src= <?= $desp['img']; ?> width=160px height=120px>
  <?php } ?>

</body>
</html>