<?php
$validation_error = "";
$username = "";
$users = ["abc" => "password1", "abc2" => "password2", "abc3" => "password3"];

 if ($_SERVER["REQUEST_METHOD"] === "POST") {
   $username = $_POST["username"];
   $password  = $_POST["password"];
   if (isset($users[$username]) && $users[$username] === $password){
   //再ルーティング
    header("Location: リダイレクトするURL");
   //現在のスクリプトを終了する
    exit;
   } else {
     $validation_error = "※ユーザー名かパスワードが間違っています";
     //どちらが間違っているかは敢えて明記しない cf)codecademy.formValidation.10
   }
 }

?>
  
<h3>Welcome back!</h3>
<form method="post" action="">
Username:<input type="text" name="username" value="<?php echo $username;?>">
<br>
Password:<input type="text" name="password" value="">
<br>
<span class="error"><?= $validation_error;?></span>
<br>
<input type="submit" value="Log in">
</form>
  
  
