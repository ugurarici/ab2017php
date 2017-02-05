<?php
	//	veri tipleri
	//	string
	//	integer
	//	float
	//	array
	//	boolean
	//	object
	//	resource

	//	==		!=
	//	===		!==
	//	> < <= >=
	//	!




$name = "Uğur ARICI";
$age = 23;
$height = 1.72;
$hobbies = ["kitap okumak", "müzik dinlemek"];
$hobbies = array("müzik dinlemek", "kitap okumak");
$salary = 100;
$isStudent = false;
$events = array(
	"ab2017" => (object)[
	"name" => "Akademik Bilişim 2017",
	"date" => (object)[
	"starts_at" => "2017-02-04",
	"ends_at" => "2017-02-07"
	],
	"city"=> "Aksaray",
	"course" => "Modern Web ve PHP"
	],
	"ab2016" => (object)[
	"name" => "Akademik Bilişim 2016",
	"date" => (object)[
	"starts_at" => "2016-01-31",
	"ends_at" => "2016-02-03"
	],
	"city"=> "Aydın",
	"course" => "PHP: Usulüne Uygun"
	],
	);

$key = "asdlıfuyahwjqw4r3ı4tqrwegfn";

	// var_dump($events);
	// echo $events["ab2017"]["name"];
	// echo $events->ab2017->name;
	// echo $events["ab2016"]->name;
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Çok güzel bir başlık</title>
</head>
<body>
	<strong>PAROLA!!!</strong> <?=$key?>
	<h1><?=$name?></h1>
	<ul>
		<li>
			<strong>Yaş:</strong>
			<?=$age?>
		</li>
		<li>
			<strong>Boy:</strong>
			<?=$height?>
		</li>
		<li>
			<strong>Hobileri:</strong>
			<?=$hobbies[0]?>, <?=$hobbies[1]?>
		</li>
		<li>
			<strong>Öğrenci mi?</strong>
			<?php
			if($isStudent) {
				echo "Evet";
			} else {
				echo "Hayır";
			}
			?>
		</li>
	</ul>
	<h2>Etkinlikler</h2>

	<?php foreach($events as $key => $event): ?>

	<h3><?=$event->name?> - <?=$key?></h3>
	<ul>
		<li>
			<strong>Tarihler:</strong>
			<?=$event->date->starts_at?>
			<?php if($event->date->starts_at!=$event->date->ends_at): ?>
				- <?=$event->date->ends_at?>
			<?php endif; ?>
		</li>
		<li>
			<strong>Şehir:</strong>
			<?=$event->city?>
		</li>
		<li>
			<strong>Kurs:</strong>
			<?=$event->course?>
		</li>
	</ul>

	<?php endforeach; ?>
	<strong>PAROLA!!!</strong> <?=$key?>
</body>
</html>