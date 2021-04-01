<!DOCTYPE html>
<html class="no-js" lang="ja">
<head>
<meta charset="utf-8">
<title>progress-bar</title>
<link rel="stylesheet" href="">
</head>
<body>

<form enctype="multipart/form-data" action="" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    アップロードファイル： <input type="file" name="userfile" /><br>
    <input type="submit" value="送信" name="submit" />
</form>


<?php 
    if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
        if(move_uploaded_file($_FILES['userfile']['tmp_name'], "files/".$_FILES['userfile']['name'])){
            chmod("files/".$_FILES['userfile']['name'], 0644);
            echo $_FILES['userfile']['name']. "をアップロードしました。";
        }else {
            echo "ファイルをアップロードできません。";
        }
    }else{
            echo "ファイルが選択されていません";
    }
?>
</body>
</html>