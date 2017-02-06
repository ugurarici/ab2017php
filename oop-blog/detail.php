<?php

//	bu bir basit blog sistemidir

//	ancak temel akışını OOP mantığıyla kurmak istiyoruz

//	temel işlemleri, talebi karşılayıp yanıt vereceğimiz alanda (MVC'de controller'a denk alan) belirli sınıflardan türetilmiş objeler ve bu objelerin yeteneğini kullanmamız gerekmekte

require "BlogPost.php";

header('Content-Type: text/html; charset=utf-8');

$id = (int)$_GET['id'];

$post = BlogPost::find($id);

?>
<h1><?=$post->title?></h1>
<p><?=$post->content?></p>
<p><?=date('d-m-Y H:i:s', strtotime($post->created_at));?></p>
<hr>
<a href="index.php">Ana Sayfaya Dön</a>