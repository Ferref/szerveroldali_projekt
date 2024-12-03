<?php
//----------------------
//  Oldal változók beállítása
//----------------------

$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
require_once($ROOT."generate.php"); //`generate.php` meghívása

$kategoria=new CategoryView();
$kategoriak=$kategoria->showCategories();

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
        <div class="col-12" id="categoriesContainer">';
            foreach($kategoriak as $k) {
                $kategoriakContent .= '<label class="category-frame rounded-10 py-1 ps-3 pe-2 c-pointer me-2 mb-2" for="kat'.$k['id'].'">
                <a href="'.$ROOT.'pages/search.php?categoryId='.$k['id'].'" id="kat'.$k['id'].'" style="color: inherit;">
                <span>'.$k["nev"].'<span class="badge bg-my-light-blue ms-1">'.$kategoria->showSpecificCategoryNumber($k['id']).'</span></span></a>
            </label>';
            }
$kategoriakContent .='</div>
    </div>
    <script src="'.$ROOT.'assets/js/categoryFilter.js"></script>
';
$kategoriakContainer = $homePage->createContainer($kategoriakContent,"Kategóriák", "bi-grid");
//---

//Oldal megjelenítése
echo $homePage->genFramedPage($kategoriakContainer);