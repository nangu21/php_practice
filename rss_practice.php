<!DOCTYPE html>
<html class="no-js" lang="ja">
<head>
<meta charset="utf-8">
<title>RSS</title>
<link rel="stylesheet" href="">
</head>
<body>

<?php
//金融庁と総務省で日付取得の仕方が違うので注意(pubDateとde:date)(バージョン1.1と1.0)
//参考URL("https://on-ze.com/archives/1778")
//金融庁
    $xml = simplexml_load_file('https://www.fsa.go.jp/fsaNewsListAll_rss2.xml');
//総務省
    $xml2 = simplexml_load_file("https://www.soumu.go.jp/news.rdf");
//ITmedia
    $xml3 = simplexml_load_file("https://rss.itmedia.co.jp/rss/2.0/topstory.xml");
?>

<h1>金融庁</h1>
<ul>
<?php foreach($xml->channel->item as $item){ //各アイテムを取得し$itemに格納 ?>
<li>
<a href="<?php echo $item->link;?>"><?php echo $item->title;?></a>
<?php //Cookie形式の日付をフォーマットで変換
    $timezone = new DateTimeZone('Asia/Tokyo'); //DateTimeクラスの第二引数を指定
    $d = new DateTime($item->pubDate, $timezone);
    echo $d->format('Y/m/d(D) H:i:s');
    //date date("Y年 n月 j日", strtotime($item->pubDate)); でもOK
?>
<?php } ?>
</li>
</ul>

<h1>総務省</h1>
<ul>
<?php foreach($xml2->item as $item2){ ?>
<li>
<a href="<?php echo $item2->link; ?>"><?php echo $item2->title; ?></a>
<?php
    $d2 = date('Y/m/d(D) H:i:s', strtotime($item2->children("http://purl.org/dc/elements/1.1/")->date));
    echo $d2;
?>
<?php } ?>
</li>
</ul>

<h1>ITmedia総合</h1>
<ul>
<?php foreach($xml3->channel->item as $item3){ ?>
<li>
<a href="<?php echo $item3->link; ?>"><?php echo $item3->title; ?></a>
<?php
    $d3 = new DateTime($item3->pubDate, $timezone);
    echo $d3->format('Y/m/d(D) H:i:s'). "<br>";
?>
<?php echo $item3->description; ?>
<?php } ?>
</li>
</ul>


</body>
</html>
