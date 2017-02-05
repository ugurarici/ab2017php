<?php

require_once "vendor/autoload.php";
$connection = new PDO("mysql:host=localhost;dbname=ogrencisecme_ab2017;charset=utf8", "root", "root");

$sqlString = "SELECT * from applications WHERE is_chosen = 1 AND class = 1 ORDER BY first_name";

$students = $connection->query($sqlString);
//	veritabanımızda katılımcılarımızın kaydı mevcut

//	katılımcılarımızın bilgilerini içerecek şekilde VCF kartları oluşturacağız
foreach ($students as $student) {
	
}

//	bunları indirmek yerine proje dizinine kaydedebilirsek daha güzel olur bence