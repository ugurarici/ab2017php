<?php

require_once "models/BlogPost.php";

if(!isset($_GET['id'])){
	header("Location: index.php");
	die();
}

$id = (int)$_GET['id'];
$post = BlogPost::find($id);

if(isset($_POST['title']) AND isset($_POST['content'])) {
	$post->title = $_POST['title'];
	$post->content = $_POST['content'];
	$post->save();

	header("Location: /?a=detail&id=".$post->id);
	die();
}
?>
<form method="POST">
	<input type="text" name="title" value="<?=$post->title?>">
	<br>
	<textarea name="content"><?=$post->content?></textarea>
	<br>
	<input type="submit" value="İçeriği Düzenle">
</form>