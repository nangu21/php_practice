<h2>記事一覧</h2>
<ul>
<?php foreach ($posts as $post) : ?>
<li>
<?php
    //debug($post); //cake版print_r()

    //postの一覧をつくる
    echo h($post['Post']['title']); //cake版htmlspecialchars()
?>
</li>
<?php endforeach; ?>
</ul>