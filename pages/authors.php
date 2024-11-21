<?php
//----------------------
//  Oldal változók beállítása
//----------------------

$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
require_once($ROOT."generate.php"); //`generate.php` meghívása

$iro=new AuthorView();
$irok=$iro->showAllWriter();

$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Kategóriák | Booknav"; //title attributum értéke

//----------------------
//      Tartalom
//----------------------

//Legnépszerűbb könyvek
$irokContent = '
    <div class="row m-0">
        <div class="col-12 col-md-6 col-lg-3">
            <input onkeyup="authorFilter()" type="text" class="form-control" id="authorInput" placeholder="Szűrés"/>
        </div>
    </div>
    <div class="row mx-0 my-3">
        <div class="col-12" id="authorsContainer">';
            foreach($irok as $i) {
                $irokContent .= '<label class="category-frame rounded-10 py-1 ps-3 pe-2 c-pointer me-2" for="kat'.$i['id'].'">
                <input class="kat" type="checkbox" name="irok[]" value="'.$i['id'].'" id="kat'.$i['id'].'" hidden>
                <span>'.$i["nev"].'<span class="badge bg-my-light-blue ms-1">'.$iro->showSpecificWriterBookNumber($i['id']).'</span></span>
            </label>';
            }
$irokContent .='</div>
    </div>
    <script src="'.$ROOT.'assets/js/authorFilter.js"></script>
';
$irokContainer = $homePage->createContainer($irokContent,"Kategóriák", "bi-grid");
//---

//Oldal megjelenítése
echo $homePage->genFramedPage($irokContainer);