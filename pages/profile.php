<?php
//----------------------
//  Oldal változók beállítása
//----------------------

$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
//$SRC = "https://localhost/szerveroldali_projekt/";
require_once($ROOT."generate.php"); //`generate.php` meghívása
$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Profil"; //title attributum értéke
//echo $ROOT."media/images/nincs-borito.jpg";
//----------------------
//      Tartalom
//----------------------

//Profil infó
include_once($ROOT."components/book_mini.php");
$kedvContent = '
    <div class="row">
        <div class="col-12">
            <button class="btn my-blue"><i class="bi bi-pencil me-2"></i>Szerkesztés</button>
        </div>
    </div>
';
$kedvContainer = $homePage->createContainer($kedvContent,"Profil info", "bi-person-fill");
//---


//---


//Tartalom öszefűzése
$allContent = $kedvContainer;

//Oldal megjelenítése
echo $homePage->genFramedPage($allContent);
?>