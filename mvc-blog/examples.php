<?php

//	bu bir basit blog sistemidir

//	ancak temel akışını OOP mantığıyla kurmak istiyoruz

//	temel işlemleri, talebi karşılayıp yanıt vereceğimiz alanda (MVC'de controller'a denk alan) belirli sınıflardan türetilmiş objeler ve bu objelerin yeteneğini kullanmamız gerekmekte

require "models/BlogPost.php";


// $post = new BlogPost;
// $post->title = "Başlık olsun";
// $post->content = "İçerik olsun";
// $post->save();

// echo $post->id;



// $post = BlogPost::find(1);

// echo $post->title;

// $post->title = 123123123123;

// $post->save();

// die(var_dump($post));


// $blog = new BlogPost;
// $posts = $blog->getPosts('LAST', 1, 0);

// foreach ($posts as $post) {
// 	echo $post->title;
// 	echo "<hr>";
// }

// //////////////////

// $post = BlogPost::find(2);
// $post->title = "Yeni Başlık";
// $post->save();

//////////////////

// $allPosts = BlogPost::get('LAST', 10);

// die(var_dump($allPosts));

//////////////////

// $newPost = new BlogPost;

// $newPost->title = "Yeni Başlık";
// $newPost->content = "İçerik";

// $newPost->save();

// $newPost->title = "DEĞİŞTİRDİİİK";
// $newPost->save();

// echo $newPost->id;

// //////////////////////

// $post = BlogPost::find(1);
// $post->title = "İlkinin başlığını değiştirdik";
// $post->save();

// /////////////////


// $allPosts = BlogPost::all();
