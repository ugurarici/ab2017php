<?php

require_once "vendor/autoload.php";

use JeroenDesloovere\VCard\VCard;

$connection = new PDO("mysql:host=localhost;dbname=ogrencisecme_ab2017;charset=utf8", "root", "root");

$sqlString = "SELECT * from applications WHERE is_chosen = 1 AND class = 1 ORDER BY first_name";

$students = $connection->query($sqlString);
//	veritabanımızda katılımcılarımızın kaydı mevcut

//	katılımcılarımızın bilgilerini içerecek şekilde VCF kartları oluşturacağız
foreach ($students as $student) {
	// define vcard
	$vcard = new VCard();

// define variables
	$lastname = $student['last_name'];
	$firstname = $student['first_name'];
	$additional = '';
	$prefix = '';
	$suffix = '';

// add personal data
	$vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

// add work data
	$vcard->addCompany($student['institution']);
	$vcard->addJobtitle($student['title']);
	$vcard->addNote("AB2017 Modern Web ve PHP Sınıfından. ".$student['university']." ".$student['university_department']. " öğrencisi.");

	$vcard->addEmail($student['email']);
	
	if(! is_null($student['phone']))
		$vcard->addPhoneNumber("+90".$student['phone'], 'PREF;HOME');

	if(! is_null($student['facebook_id'])){
		$vcard->addPhoto("http://graph.facebook.com/v2.8/".$student['facebook_id']."/picture?type=large");
		$vcard->addURL('https://fb.com/'.$student['facebook_id']);
	}

	$vcard->setFilename($student['first_name']." ".$student['last_name']);
	$vcard->save();
	print($student['first_name']." ".$student['last_name']." created\r\n");
}

//	bunları indirmek yerine proje dizinine kaydedebilirsek daha güzel olur bence