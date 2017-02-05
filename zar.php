<?php

$bulduMu = false;
$deneme = 0;

do{
	$deneme++;
	if(rand(1,6)==5){
		$bulduMu = true;
	}
}while(! $bulduMu);

echo $deneme . " denemede bulundu\n\r";