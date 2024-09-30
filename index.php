<?php
//Oldal változók beállítása
$ROOT = "./";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
require_once($ROOT."generate.php"); //`generate.php` meghívása
$testPage = new Generate();
$testPage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$testPage->name = "Booknav"; //title attributum értéke


//Tartalom
$content = "Ez a főoldal!";
$container = $testPage->createContainer($content,"Random Kedvcsináló!", "bi-shuffle");

//Oldal megjelenítése
echo $testPage->genFramedPage($container);
?>