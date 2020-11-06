<?php
$validation_error = "";
$user_url = "";
$form_message = "";

//フォームが送信されているか
if($_SERVER["REQUEST_METHOD"] === "POST"){
  $user_url= $_POST["url"];
  
  //正しいurl形式かどうか
  if(filter_var($user_url, FILTER_VALIDATE_URL)){
    $form_message= "Thank you for your submission.";
  }else{
    $validation_error= "* This is an invalid URL.";
    $form_message= "Please retry and submit your form again.";
  }
}



?>

<form method="post" action="">
Your Favorite Website: 
<br>
<input type="text" name="url" value="<?php echo $user_url;?>">
<span class="error"><?= $validation_error;?></span>
<br>
<input type="submit" value="Submit">
</form>
<p> <?= $form_message;?> </p> 

?>


//filter_var()については以下参照
//https://www.php.net/manual/en/filter.filters.validate.php
