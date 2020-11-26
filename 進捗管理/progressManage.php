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
<label for="date">試験予定日 </label>
<input type="date" name="date"><br>
<label for="pages">参考書ページ数 </label>
<input type="number" name="pages"><br>
<label for="土日">休日 </label>
<select name="土日" id="weekend">
<option value="">--選択してください--</option>
<option value="yes">土日を含む</option>
<option value="no">土日を除く</option>
</select>
<br>
<input type="submit" value="送信">
</form>
</body>
</html>