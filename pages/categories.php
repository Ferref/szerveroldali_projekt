<?php
//----------------------
//  Oldal változók beállítása
//----------------------

$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
require_once($ROOT."generate.php"); //`generate.php` meghívása
$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Kategóriák | Booknav"; //title attributum értéke

//----------------------
//      Tartalom
//----------------------

//Legnépszerűbb könyvek
$kategoriakContent = '
    <div class="row m-0">
        <div class="col-12 col-md-6 col-lg-3">
            <input onkeyup="categoryFilter()" type="text" class="form-control" id="categoryInput" placeholder="Szűrés"/>
        </div>
    </div>
    <div class="row mx-0 my-3">
        <div class="col-12" id="categoriesContainer">
            <label class="category-frame rounded-10 py-1 ps-3 pe-2 c-pointer me-2" for="kat1">
                <input class="kat" type="checkbox" name="categories[]" value="1" id="kat1" hidden>
                <span>Fantasy<span class="badge bg-my-light-blue ms-1">4</span></span>
            </label>
            <label class="category-frame rounded-10 py-1 ps-3 pe-2 c-pointer me-2" for="kat1">
                <input class="kat" type="checkbox" name="categories[]" value="1" id="kat1" hidden>
                <span>Krimi<span class="badge bg-my-light-blue ms-1">1574</span></span>
            </label>
        </div>
    </div>
    <script src="'.$ROOT.'assets/js/categoryFilter.js"></script>
';
$kategoriakContainer = $homePage->createContainer($kategoriakContent,"Kategóriák", "bi-grid");
//---

//Oldal megjelenítése
echo $homePage->genFramedPage($kategoriakContainer);