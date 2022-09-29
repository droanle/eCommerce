<?php
/*
 * * Este arquivo é executado em todos os arquivos do sistema.
 * File: systemConfig
 * Description: Estabelece definições e funções constantes no sistema.
*/

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
    $url = "https://";
else  
    $url = "http://";

$url .= $_SERVER['HTTP_HOST'];

if (file_exists("./localConfig.php")) include "./localConfig.php";
else if (file_exists("../localConfig.php")) include "../../localConfig.php";
else if (file_exists("../../localConfig.php")) include "../../localConfig.php";
else if (file_exists("../../../localConfig.php")) include "../../../localConfig.php";
else {
    $url = "https://";
    $url .= $_SERVER['HTTP_HOST'];
    
    define("SYSTEM_URL", $url);
}