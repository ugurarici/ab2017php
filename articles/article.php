<?php

require_once "init.php";

if(! isset($articles[$_GET['id']])){
	header("Location: index.php");
	die();
}
$article = $articles[$_GET['id']];

?>

<h1><?=$article['title']?></h1>
<p>
	<?=$article['content']?>
</p>
<hr>
<a href="index.php">Geri dön</a>