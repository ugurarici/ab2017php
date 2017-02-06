<?php

require_once "models/BlogPost.php";

if(isset($_POST['title']) AND isset($_POST['content'])){
	$post = new BlogPost;
	$post->title = $_POST['title'];
	$post->content = $_POST['content'];
	$post->save();

	header("Location: /?a=detail&id=".$post->id);
	die();
}
?>
<form method="POST">
	<input type="text" name="title">
	<br>
	<textarea name="content"></textarea>
	<br>
	<input type="submit" value="İçerik Ekle">
</form>