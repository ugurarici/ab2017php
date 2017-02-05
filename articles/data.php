<?php

$rawData = file_get_contents("articles.json");
$articles = json_decode($rawData, true);