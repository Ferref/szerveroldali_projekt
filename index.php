<?php
//----------------------
//  Oldal változók beállítása
//----------------------

$ROOT = "./";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
//$SRC = "https://localhost/szerveroldali_projekt/";
require_once($ROOT."generate.php"); //`generate.php` meghívása
$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Booknav"; //title attributum értéke
//echo $ROOT."media/images/nincs-borito.jpg";
//----------------------
//      Tartalom
//----------------------

//Random kedvcsináló
include_once($ROOT."components/random_teaser.php");
include_once($ROOT."components/book_mini.php");
$kedvContent = $rt_element;
$kedvContainer = $homePage->createContainer($kedvContent,"Random Kedvcsináló", "bi-shuffle");
//---

//Legnépszerűbb könyvek
$nKonyvekContent = "<div class=\"row\">
    <div class=\"col-12 col-sm-6 col-md-4 col-lg-12_5 p-3\">
        <a href=\"".$ROOT."pages/book-overview.php?id=0"."\">
            <div class=\"book-card rounded border d-flex flex-column align-items-center text-center c-pointer\">
                <div class=\"py-2 px-2 px-md-0 px-lg-3 cover-container\">
                    <img class=\"d-block mx-auto rounded\"src=\"".$ROOT."media/images/nincs-borito.jpg\"/>
                </div>
                <p class=\"book-title m-2\">Narnia 2. - Az oroszlán, a boszorkány és a ruhásszekrény - Illusztrált kiadás</p>
                <p class=\"font-roboto my-gray mb-2\">C. S. Lewis</p>
            </div>
        </a>
    </div>
    <div class=\"col-12 col-sm-6 col-md-4 col-lg-12_5 p-3\">
        <a href=\"".$ROOT."pages/book-overview.php?id=0"."\">
            <div class=\"book-card d-flex flex-column align-items-center text-center c-pointer\">
                <div class=\"py-2 px-2 px-md-0 px-lg-3 cover-container\">
                    <img class=\"d-block mx-auto rounded\"src=\"https://s01.static.libri.hu/cover/f9/b/4841405_4.jpg\"/>
                </div>
                <p class=\"book-title m-2\">Narnia 2. - Az oroszlán, a boszorkány és a ruhásszekrény - Illusztrált kiadás</p>
                <p class=\"font-roboto my-gray mb-2\">C. S. Lewis</p>
            </div>
        </a>
    </div>
    <div class=\"col-12 col-sm-6 col-md-4 col-lg-12_5 p-3\">
        <a href=\"".$ROOT."pages/book-overview.php?id=0"."\">
            <div class=\"book-card d-flex flex-column align-items-center text-center c-pointer\">
                <div class=\"py-2 px-2 px-md-0 px-lg-3 cover-container\">
                    <img class=\"d-block mx-auto rounded\"src=\"https://s01.static.libri.hu/cover/f9/b/4841405_4.jpg\"/>
                </div>
                <p class=\"book-title m-2\">Narnia 2. - Az oroszlán, a boszorkány és a ruhásszekrény - Illusztrált kiadás</p>
                <p class=\"font-roboto my-gray mb-2\">C. S. Lewis</p>
            </div>
        </a>
    </div>
    <div class=\"col-12 col-sm-6 col-md-4 col-lg-12_5 p-3\">
        <a href=\"".$ROOT."pages/book-overview.php?id=0"."\">
            <div class=\"book-card d-flex flex-column align-items-center text-center c-pointer\">
                <div class=\"py-2 px-2 px-md-0 px-lg-3 cover-container\">
                    <img class=\"d-block mx-auto rounded\"src=\"https://s01.static.libri.hu/cover/f9/b/4841405_4.jpg\"/>
                </div>
                <p class=\"book-title m-2\">Narnia 2. - Az oroszlán, a boszorkány és a ruhásszekrény - Illusztrált kiadás</p>
                <p class=\"font-roboto my-gray mb-2\">C. S. Lewis</p>
            </div>
        </a>
    </div>
    ".book_mini(1,$ROOT)."
</div>";
$nKonyvekContainer = $homePage->createContainer($nKonyvekContent,"Legnépszerűbb könyvek", "bi-book");
//---


//Tartalom öszefűzése
$allContent = $kedvContainer.$nKonyvekContainer;

//Oldal megjelenítése
echo $homePage->genFramedPage($allContent);
?>