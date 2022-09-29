<?php

require '../../vendor/autoload.php';

use System\Config\Request;

$app = new Request(); 

$app::route('GET', '/controller/register', function ($req, $res){
    include "./UserRegister/UserRegister.php";
});

include "../View/page404.php";