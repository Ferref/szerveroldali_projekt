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

//Keresés
$searchContent = '
<div class="row m-0">
<div class="col-12 bg-book p-1 p-md-4 rounded-10 d-flex align-items-center" style="height: 150px;">
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

//Random kedvcsináló
include_once($ROOT."components/random_teaser.php");
include_once($ROOT."components/book_mini.php");
$kedvContent = $rt_element;
$kedvContainer = $homePage->createContainer($kedvContent,"Random Kedvcsináló", "bi-shuffle");
//---


$legnepszerubbKonyvek=new BookView();
$legnepszerubbKonyvek=$legnepszerubbKonyvek->showMostPopularBooks();


//Legnépszerűbb könyvek
$nKonyvekContent = "<div class=\"row\">";
foreach($legnepszerubbKonyvek as $konyv) {
    $nKonyvekContent.=book_mini($konyv,$ROOT);
}
    
$nKonyvekContent.="</div>";
$nKonyvekContainer = $homePage->createContainer($nKonyvekContent,"Legnépszerűbb könyvek", "bi-book");
//---


//Tartalom öszefűzése
$allContent = $searchContainer.$kedvContainer.$nKonyvekContainer;

//Oldal megjelenítése
echo $homePage->genFramedPage($allContent);
?>