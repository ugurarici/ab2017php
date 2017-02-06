<?php

//	bu bir basit blog sistemidir

//	ancak temel akışını OOP mantığıyla kurmak istiyoruz

//	temel işlemleri, talebi karşılayıp yanıt vereceğimiz alanda (MVC'de controller'a denk alan) belirli sınıflardan türetilmiş objeler ve bu objelerin yeteneğini kullanmamız gerekmekte

require "BlogPost.php";

header('Content-Type: text/html; charset=utf-8');

$postsOnPage = BlogPost::get('LAST', 10);

foreach ($postsOnPage as $post): ?>
	<a href="detail.php?id=<?=$post->id;?>">
		<?=$post->title;?>
	</a>
	<hr>
<?php endforeach;