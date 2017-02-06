<?php
foreach ($postsOnPage as $post): ?>
<a href="?a=detail&id=<?=$post->id;?>">
	<?=$post->title;?>
</a>
<hr>
<?php endforeach; ?>
<a href="new-post.php">+++ Yeni İçerik</a>