<h1><?=$post->title?></h1>
<p><?=$post->content?></p>
<p><?=date('d-m-Y H:i:s', strtotime($post->created_at));?></p>
<hr>
<small><a href="edit-post.php?id=<?=$post->id?>">Bu içeriği düzenle</a></small>
<hr>
<a href="/">Ana Sayfaya Dön</a>