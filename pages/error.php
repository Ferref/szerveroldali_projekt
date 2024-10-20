<?php
//----------------------
//  Oldal változók beállítása
//----------------------

$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
//$SRC = "https://localhost/szerveroldali_projekt/";
require_once($ROOT."generate.php"); //`generate.php` meghívása
$homePage = new Generate();
$homePage->root = "https://localhost/szerveroldali_projekt/";     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Error"; //title attributum értéke
//echo $ROOT."media/images/nincs-borito.jpg";
//----------------------
//      Tartalom
//----------------------

//Hiba oldalak
if(isseT($_GET['code']) && $_GET['code'] == '403') {
    $errorContent ='
    <style>
    body{
        justify-content: center;
    }
    </style>
    <dic class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 col-lg-4 bg-white p-3 rounded-20 shadow text-center mx-auto" >
                <div class="row my-blue">
                    <div class="col-12"><h1>403!</h1></div>
                    <div class="col-12 my-4"><p>Nincs hozzáférése az elemhez!<br>Esetleg próbáljon meg bejelentkezni, megfelelő hozzáférésű fiókkal...</p></div>
                    <div class="col-12"><h1><i style="font-size: 20vh;" class="my-white-blue bi bi-dash-circle-fill"></i></h1></div>
                    <div class="col-12"><a class="my-light-blue my-3 d-block" href="/szerveroldali_projekt/index.php">Vissza a főoldalra</a></div>
                </div>
            </div>
        </div>
    </dic>
    ';
    $homePage->name = "403!";
}
else if(isseT($_GET['code']) && $_GET['code'] == '404') {
    $errorContent ='
    <style>
    body{
        justify-content: center;
    }
    </style>
    <dic class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 col-lg-4 bg-white p-3 rounded-20 shadow text-center mx-auto" >
                <div class="row my-blue">
                    <div class="col-12"><h1>404!</h1></div>
                    <div class="col-12 my-4"><p>A keresett elem nem található!</p></div>
                    <div class="col-12"><h1><i style="font-size: 20vh;" class="my-white-blue bi bi-cone-striped"></i></h1></div>
                    <div class="col-12"><a class="my-light-blue my-3 d-block" href="/szerveroldali_projekt/index.php">Vissza a főoldalra</a></div>
                </div>
            </div>
        </div>
    </dic>
    ';
    $homePage->name = "404!";
}
else if(isseT($_GET['code']) && $_GET['code'] == '500') {
    $errorContent ='
    <style>
    body{
        justify-content: center;
    }
    </style>
    <dic class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 col-lg-4 bg-white p-3 rounded-20 shadow text-center mx-auto" >
                <div class="row my-blue">
                    <div class="col-12"><h1>500!</h1></div>
                    <div class="col-12 my-4"><p>Szerver Hiba!</p></div>
                    <div class="col-12"><h1><i style="font-size: 20vh;" class="my-white-blue bi bi-hdd-stack-fill"></i></h1></div>
                    <div class="col-12"><a class="my-light-blue my-3 d-block" href="/szerveroldali_projekt/index.php">Vissza a főoldalra</a></div>
                </div>
            </div>
        </div>
    </dic>
    ';
    $homePage->name = "500!";
}
else {
    $errorContent ='
    <style>
    body{
        justify-content: center;
    }
    </style>
    <dic class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 col-lg-4 bg-white p-3 rounded-20 shadow text-center mx-auto" >
                <div class="row my-blue">
                    <div class="col-12"><h1>Hiba történt!</h1></div>
                    <div class="col-12 my-4"><p>Valamilyen hiba lépett fel!</p></div>
                    <div class="col-12"><h1><i style="font-size: 20vh;" class="my-white-blue bi bi-emoji-frown-fill"></i></h1></div>
                    <div class="col-12"><a class="my-light-blue my-3 d-block" href="/szerveroldali_projekt/index.php">Vissza a főoldalra</a></div>
                </div>
            </div>
        </div>
    </dic>
    ';
    $homePage->name = "Hiba!";
}

//---

//Oldal megjelenítése
echo $homePage->genEmptyPage($errorContent);
?>