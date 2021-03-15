<?php
//400 * 400のイメージを描画c
$image = imagecreatetruecolor(400, 400);
$white = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);

//線を引く
imagedashedline($image, 200, 100, 200, 300, $white);
imagedashedline($image, 100, 200, 300, 200, $white);

//イメージを出力する
header('Content-Type: image/png');
ImagePNG($image);

//イメージを保存する
imagepng($image, './dashedline.png');
imagedestroy($image);
?>
