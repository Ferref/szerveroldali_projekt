<?php 
session_start();
require_once "functions.inc.php";
spl_autoload_register("autoloader");

function autoloader($classname) {

    $fullpath="./mvc/config/".strtolower($classname).".mvc.php";
    if (file_exists($fullpath)) {
        include_once $fullpath;  
        return; 
    }

    $fullpath="./mvc/controllers/".strtolower($classname).".mvc.php";
    if (file_exists($fullpath)) {
        include_once $fullpath;  
        return; 
    }

    $fullpath="./mvc/models/".strtolower($classname).".mvc.php";
    if (file_exists($fullpath)) {
        include_once $fullpath;  
        return; 
    }

    $fullpath="./mvc/views/".strtolower($classname).".mvc.php";
    if (file_exists($fullpath)) {
        include_once $fullpath;  
        return; 
    }

    $fullpath="../mvc/config/".strtolower($classname).".mvc.php";
    if (file_exists($fullpath)) {
        include_once $fullpath;  
        return; 
    }

    $fullpath="../mvc/controllers/".strtolower($classname).".mvc.php";
    if (file_exists($fullpath)) {
        include_once $fullpath;  
        return; 
    }

    $fullpath="../mvc/models/".strtolower($classname).".mvc.php";
    if (file_exists($fullpath)) {
        include_once $fullpath;  
        return; 
    }

    $fullpath="../mvc/views/".strtolower($classname).".mvc.php";
    if (file_exists($fullpath)) {
        include_once $fullpath;  
        return; 
    }
}