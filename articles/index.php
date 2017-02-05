<?php

require_once "init.php";

$articles = Article::all();

// $articleObj = new Article;
// $articles = $articleObj->getAll();


?>
<?php if(isset($_SESSION['error'])): ?>
	
	<?=$_SESSION['error']?>
	<hr>
<?php session_destroy(); endif; ?>



<?php foreach($articles as $id => $article): ?>

	<a href="article.php?id=<?=$id?>"><?=$article['title']?></a> - <a href="deleteArticle.php?id=<?=$id?>">sil</a>
	<hr>

<?php endforeach; ?>

<a href="addArticle.php">+++ Yeni Makale Ekle</a>
