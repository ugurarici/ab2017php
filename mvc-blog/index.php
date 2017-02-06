<?php

//	bu bir basit blog sistemidir

//	ancak temel akışını OOP mantığıyla kurmak istiyoruz

//	temel işlemleri, talebi karşılayıp yanıt vereceğimiz alanda (MVC'de controller'a denk alan) belirli sınıflardan türetilmiş objeler ve bu objelerin yeteneğini kullanmamız gerekmekte

require "models/BlogPost.php";
require "controllers/MainController.php";

$action = "homepage";

if(isset($_GET['a'])) {
	if( method_exists('MainController',$_GET['a']) ) {
		$action = $_GET['a'];
	}
}

MainController::$action();





