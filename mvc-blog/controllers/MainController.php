<?php

class MainController{

	public static function homepage()
	{
		header('Content-Type: text/html; charset=utf-8');

		$postsOnPage = BlogPost::get('LAST', 10);

		include "views/homepage.php";
	}

	public static function detail()
	{
		header('Content-Type: text/html; charset=utf-8');

		$id = (int)$_GET['id'];

		$post = BlogPost::find($id);

		include "views/postDetail.php";
	}

}