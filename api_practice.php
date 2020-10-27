<?php
  //db接続
    $pdo = new PDO("mysql:host=localhost;dbname=mydb;charset=utf8","root","", [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);


  //やること追加
    if (isset($_POST['submit'])) 
    {
      $description = $_POST['description'];
      $sth = $pdo->prepare("INSERT INTO todos (description) VALUES (:description)");
      $sth->bindValue(':description', $description, PDO::PARAM_STR);
      $sth->execute();
    }
  //やること削除
      elseif (isset($_POST['delete']))
    { 
      $id = $_POST['id'];
      $sth = $pdo->prepare("delete from todos where id = :id");
      $sth->bindValue(':id', $id, PDO::PARAM_INT);
      $sth->execute();
    }
  //やること完了
    elseif (isset($_POST['complete']))
    {
      $id = $_POST['id'];
      $sth = $pdo->prepare("UPDATE todos SET complete = 1 where id = :id");
      $sth->bindValue(':id', $id, PDO::PARAM_INT);
      $sth->execute();
    }
?>


<?php
  
  //boredapi取得,やることを$resultに格納
    $response= file_get_contents("http://www.boredapi.com/api/activity/");
    $info= json_decode($response);
    $result= $info->activity;

?>

<!DOCTYPE HTML>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>todo list</title>
  <link rel="stylesheet" href="style.css">
  <!--JavaScript-->
  <script type="text/javascript">
        var result= <?php echo json_encode($result); ?>;
        function event_function(){
            document.getElementById("display").innerHTML= result;
        }
  </script>
</head>
<body>
    <div class="form">
    <h1>やることリスト</h1>
    <!--やることを追加-->
    <form method="POST" action="">
        <input type="text" name="description">
        <input type="submit" name="submit" value="追加">
    </form>
        <p>もしくは： <button onclick="event_function()">やることを見つける</button></p>
        <!--API結果を出力-->
        <p id="display"></p>
    </div>
    
    <!--リストを表示-->
    <div class="container">
    <table>
    <thead><th>やること</th><th></th><th></th></thead>
    <tbody>
    <?php
        $sth = $pdo->prepare("SELECT * FROM todos ORDER BY id DESC");
        $sth->execute();

        foreach ($sth as $row) {
    ?> 

    <tr>
      <td>
          <?= "・". htmlspecialchars($row['description'])?></td>
      <td>
    <?php
        if (!$row['complete']){
    ?>
    <form method="POST">
      <button type="submit" name="complete">完了</button>
      <input type="hidden" name="id" value="<?=$row['id']?>">
      <input type="hidden" name="complete" value="true">
    </form>
    <?php
        }else{
    ?>
    タスク完了！
    <?php
        }
    ?>
    </td>
    <td>
    <form method="POST">
      <button type="submit" name="delete">削除</button>
      <input type="hidden" name="id" value="<?=$row['id']?>">
      <input type="hidden" name="delete" value="true">
    </form>
    </td>
    </tr>
    <?php
        }
    ?>
    </tbody>
  　</table>
    </div>

</body>
</html>