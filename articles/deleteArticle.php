<?php

require "data.php";

$idToDelete = (int)$_GET['id'];


if(! isset($articles[$idToDelete])){
	header("Location: index.php");
	die();
}

unset($articles[$idToDelete]);

file_put_contents("articles.json", json_encode($articles));

header("Location: index.php");
die();