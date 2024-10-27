<?php
//----------------------
//  Oldal változók beállítása
//----------------------

$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.

require_once($ROOT."generate.php"); //`generate.php` meghívása
$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Keresés | Booknav"; //title attributum értéke

include_once($ROOT."components/book_mini.php");

//----------------------
//      Tartalom
//----------------------

//Keresés
$searchContent = '
<div class="row m-0">
<div class="col-12 bg-book p-4 rounded-10 d-flex align-items-center" style="height: 150px;">
    <div class="row d-flex justify-content-center w-100 m-0">
        <div class="col-12 col-md-9 col-lg-5  mb-3" >
            <div class="input-group" style="height: 30px; ">
                <input type="text" class="form-control" placeholder="Keresés" style="background-color: rgba(240,240,250,0.8);">
                <button class="btn btn-outline-secondary text-white bg-my-light-blue" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </div>
</div>
</div>';
$searchContainer = $homePage->createEmptyContainer($searchContent);
//---

//Találatok
$talalatokContent = '
    <div class="row">
        '.book_mini(1, $ROOT).'
    </div>
';
$talalatokContainer = $homePage->createContainer($talalatokContent,"Találatok", "bi-search");
//---


//Tartalom öszefűzése
$allContent = $searchContainer.$talalatokContainer;

//Oldal megjelenítése
echo $homePage->genFramedPage($allContent);
?>