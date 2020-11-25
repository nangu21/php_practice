<?php
//ページをまたいだデータの保持：form, cookie, session(cookie,sessionは明示的に削除されない限り保持されない)

//セッション(サーバー側にデータを保存する)
//cookieと違い、中身の改ざんや中身を見られる可能性が低い

session_start();

$_SESSION['userName'] = "username";

//セッションを削除する
//unset($_SESSION['userName']);

echo $_SESSION['userName'];
?>