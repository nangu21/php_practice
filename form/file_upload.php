<!DOCTYPE html>
<html class="no-js" lang="ja">
<head>
<meta charset="utf-8">
<title>file_upload</title>
<link rel="stylesheet" href="">
<style>
    #preview img{
        width: 100px;
    }
</style>
</head>
<body>

<!--アップロードファイルの選択と送信フォーム-->
<form enctype="multipart/form-data" action="" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    アップロードファイル： <input type="file" name="userfile" /><br>
    <input type="submit" value="送信" name="submit" />
</form>

<?php 
    if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
        if(move_uploaded_file($_FILES['userfile']['tmp_name'], "files/".$_FILES['userfile']['name'])){
            //権限の付与
            chmod("files/".$_FILES['userfile']['name'], 0644);
            echo $_FILES['userfile']['name']. "をアップロードしました。";

            //画像のプレビュー
            echo "<div id='preview'><img src='files/". $_FILES['userfile']['name'] ."'></div>";
        }else {
            echo "ファイルをアップロードできません。";
        }
    }else{
            echo "ファイルが選択されていません";
    }
?>
</body>
</html>
