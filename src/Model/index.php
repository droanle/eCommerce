<?php

require '../../vendor/autoload.php';


use System\Config\Request;


$app = new Request(); 

// $app::route('GET', 'model/', function ($req, $res){
//     include "../src/Model/*";
// });

include "./src/View/page404.php";