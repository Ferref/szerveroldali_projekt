<?php
//----------------------
//  Oldal változók beállítása
//----------------------

$ROOT = "./";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
require_once($ROOT."generate.php"); //`generate.php` meghívása
$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Booknav"; //title attributum értéke

//----------------------
//      Tartalom
//----------------------

//Random kedvcsináló
$kedvContent = "Ez a főoldal!";
$kedvContainer = $homePage->createContainer($kedvContent,"Random Kedvcsináló", "bi-shuffle");
//---

//Legnépszerűbb könyvek
$nKonyvekContent = "<div class=\"row\">
    <div class=\"col-12 col-sm-6 col-md-4 col-lg-2 p-3\">
        <div class=\"rounded-10 d-flex flex-column align-items-center text-center shadow c-pointer\">
            <div class=\"p-2 cover-container\">
                <img class=\"d-block mx-auto rounded\"src=\"https://s01.static.libri.hu/cover/f9/b/4841405_4.jpg\"/>
            </div>
            <p class=\"book-title\">Narnia 2. - Az oroszlán, a boszorkány és a ruhásszekrény - Illusztrált kiadás</p>
            <p class=\"font-roboto my-gray mb-2\">C. S. Lewis</p>
        </div>
    </div>
    <div class=\"col-12 col-sm-6 col-md-4 col-lg-2 p-3\">
        <div class=\"rounded-10 d-flex flex-column align-items-center text-center shadow c-pointer\">
            <div class=\"p-2 cover-container\">
                <img class=\"d-block mx-auto rounded\"src=\"https://s01.static.libri.hu/cover/f9/b/4841405_4.jpg\"/>
            </div>
            <p class=\"book-title\">Narnia 2. - Az oroszlán, a boszorkány és a ruhásszekrény - Illusztrált kiadás</p>
            <p class=\"font-roboto my-gray mb-2\">C. S. Lewis</p>
        </div>
    </div>
    <div class=\"col-12 col-sm-6 col-md-4 col-lg-2 p-3\">
        <div class=\"rounded-10 d-flex flex-column align-items-center text-center shadow c-pointer\">
            <div class=\"p-2 cover-container\">
                <img class=\"d-block mx-auto rounded\"src=\"https://s01.static.libri.hu/cover/f9/b/4841405_4.jpg\"/>
            </div>
            <p class=\"book-title\">Narnia 2. - Az oroszlán, a boszorkány és a ruhásszekrény - Illusztrált kiadás</p>
            <p class=\"font-roboto my-gray mb-2\">C. S. Lewis</p>
        </div>
    </div>
    <div class=\"col-12 col-sm-6 col-md-4 col-lg-2 p-3\">
        <div class=\"rounded-10 d-flex flex-column align-items-center text-center shadow c-pointer\">
            <div class=\"p-2 cover-container\">
                <img class=\"d-block mx-auto rounded\"src=\"https://s01.static.libri.hu/cover/f9/b/4841405_4.jpg\"/>
            </div>
            <p class=\"book-title\">Narnia 2. - Az oroszlán, a boszorkány és a ruhásszekrény - Illusztrált kiadás</p>
            <p class=\"font-roboto my-gray mb-2\">C. S. Lewis</p>
        </div>
    </div>
    <div class=\"col-12 col-sm-6 col-md-4 col-lg-2 p-3\">
        <div class=\"rounded-10 d-flex flex-column align-items-center text-center shadow c-pointer\">
            <div class=\"p-2 cover-container\">
                <img class=\"d-block mx-auto rounded\"src=\"https://s01.static.libri.hu/cover/f9/b/4841405_4.jpg\"/>
            </div>
            <p class=\"book-title\">Narnia 2. - Az oroszlán, a boszorkány és a ruhásszekrény - Illusztrált kiadás</p>
            <p class=\"font-roboto my-gray mb-2\">C. S. Lewis</p>
        </div>
    </div>
    <div class=\"col-12 col-sm-6 col-md-4 col-lg-2 p-3\">
        <div class=\"rounded-10 d-flex flex-column align-items-center text-center shadow c-pointer\">
            <div class=\"p-2 cover-container\">
                <img class=\"d-block mx-auto rounded\"src=\"https://s01.static.libri.hu/cover/f9/b/4841405_4.jpg\"/>
            </div>
            <p class=\"book-title\">Narnia 2. - Az oroszlán, a boszorkány és a ruhásszekrény - Illusztrált kiadás</p>
            <p class=\"font-roboto my-gray mb-2\">C. S. Lewis</p>
        </div>
    </div>
</div>";
$nKonyvekContainer = $homePage->createContainer($nKonyvekContent,"Legnépszerűbb könyvek", "bi-book");
//---


//Tartalom öszefűzése
$allContent = $kedvContainer.$nKonyvekContainer;

//Oldal megjelenítése
echo $homePage->genFramedPage($allContent);
?>