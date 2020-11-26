<!DOCTYPE html>
<html class="no-js" lang="ja">
<head>
<meta charset="utf-8">
<title>進捗管理アプリ</title>
<link rel="stylesheet" href="">
</head>
<body>
<h1>進捗管理アプリ</h1>
<form action="post_info.php" method="post">
<label for="date">終了予定日 </label>
<input type="date" name="date"><br>
<label for="pages">ページ数 </label>
<input type="number" name="pages"><br>
<label for="rest">ペース </label>
<select name="rest">
<option value="">--選択してください--</option>
<option value="0">毎日</option>
<option value="1">週6日</option>
<option value="2">週5日</option>
<option value="3">週4日</option>
<option value="4">週3日</option>
<option value="5">週2日</option>
<option value="6">週1日</option>
</select>
<br>
<input type="submit" value="送信">
</form>
</body>
</html>