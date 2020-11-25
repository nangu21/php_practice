<?php
//Cookie(ブラウザにデータを保存)

//有効期限を2週間に設定(設定しない場合、ブラウザを閉じると無効になる)
setcookie('userName', 'username', time()+60*60*24*14);

//マイナスで設定すると、削除される
//setcookie('userName', '', time()-60);

echo $_COOKIE['userName'];

?>