<?php

require './vendor/autoload.php';

use System\Config\Request;


$app = new Request(); 

$app::route('GET', '/', function ($req, $res){
    include "./src/View/home.php";
});

$app::route('GET', '/home', function ($req, $res, $target){
    include $target;
}, "./src/View/");

$app::anyRoute('GET', function ($req, $target){ include $target; }, "./src/View/");

include "./src/View/page404.php";