<?php

$name = $_POST['name'];
$mediatype = $_POST['media_type'];
$filename = $_POST['filename'];
$caption = $_POST['caption'];
$status = $_POST['status'];

$tried = ($_POST['tried'] == 'yes');

if($tried){
    $validated = (!empty($name) && !empty($mediatype) && !empty($filename));

    if(!$validated){ ?>
        <p>名前、メディア形式、ファイル名は必須入力項目です。値を入力してください。</p>
    <?php }
}

if($tried && $validated){
    echo "<P>データが作成されました。</p>";
}

//メディア形式が選択されていた場合、選択状態にする
function mediaSelected($type){
    global $mediatype;

    if($mediatype == $type){
        echo "selected";
    }
} ?>

<form action= "<?= $_SERVER['PHP_SELF']; ?>" method="POST">
名前：<input type="text" name="name" value= "<?= $name; ?>"><br>
状態：<input type="checkbox" name="status" value="active" <?php if($status == "active"{ echo "checked"; } ?>)>公開<br>
メディア形式：<selected name="media_type">
    <option value="">選択してください</option>
    <option value="picture" <?php mediaSelected("picture"); ?>>静止画</option>
    <option value="audio" <?php mediaSelected("audio"); ?>>音声</option>
    <option value="movie" <?php mediaSelected("movie"); ?>>動画</option>
</selected><br>

ファイル名：<input type="text" name="filename" value="<?= $filename; ?>"><br>
見出し：<textarea name="caption"><?php $caption; ?></textarea><br>

<input type="hidden" name="tried" value="yes">
<input type="submit" value="<?= $tried ? "続行" : "作成"; ?>">
</form>