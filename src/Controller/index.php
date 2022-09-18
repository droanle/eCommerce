<?php

require '../../vendor/autoload.php';

use System\Config\Request;


$app = new Request(); 

// $app::route('GET', 'controller/', function ($req, $res){
//     include "../src/Controller/*";
// });

include "./src/View/page404.php";