<?php

require_once "init.php";

use Respect\Validation\Validator;
use Respect\Validation\Exceptions\NestedValidationException;

// $article = new Article;
// $article->save();
// // $article->title = "Başlık";
// // $article->content = "İçerik";

// die(var_dump($article));

// die();

//////////////////
$errors = array();

$title = "";
$content = "";

if(isset($_POST['title']) && isset($_POST['content'])){
	$title = $_POST['title'];
	$content = $_POST['content'];


	$titleValidator = Validator::stringType()->length(3, 200)->validate($_POST['title']);
	$contentValidator = Validator::stringType()->length(50, null)->validate($_POST['content']);

	if( ! $titleValidator ){
		$errors[] = "Başlık 3 ile 200 karakter arasında olmalıdır";
	}

	if( ! $contentValidator ){
		$errors[] = "İçerik en az 50 karakter olmalıdır";
	}

	if(count($errors)===0){
		
		// $article = new Article;
		// $article->title = $_POST['title'];
		// $article->content = $_POST['content'];
		// $article->save();



		$newPost = array(
			"title" => trim($_POST['title']),
			"content" => trim($_POST['content']),
			);

		$articles[] = $newPost;

		$newRawData = json_encode($articles);


		file_put_contents("articles.json", $newRawData);

		// $articlesJsonFile = fopen("articles.json", "w");

		// fwrite($articlesJsonFile, $newRawData);

		// fclose($articlesJsonFile);

		header("Location: index.php");
		die();
	}
}
?>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
	<?php if(count($errors)>0):
			foreach($errors as $error): ?>
		<?=$error?><br>
	<?php endforeach; echo "<hr>"; endif; ?>
		<form method="post">
			<input type="text" name="title" value="<?=$title?>">
			<br>
			<textarea name="content"><?=$content?></textarea>
			<br>
			<input type="submit" value="Gönder">
		</form>
	</body>
	</html>