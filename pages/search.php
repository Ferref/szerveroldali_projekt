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
    <div class="row d-flex w-100 m-0">
        <form action="'.antiSql($_SERVER['PHP_SELF']).'" method="post">
            <div class="col-12 col-md-9 col-lg-5  mb-3" >
                <div class="input-group" style="height: 30px; ">
                    <input name="kereses" type="text" class="form-control" placeholder="Keresés" style="background-color: rgba(240,240,250,0.8);">
                    <button class="btn btn-outline-secondary text-white bg-my-light-blue" type="submit" name="keresesKuldese" id="button-addon2"><i class="bi bi-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>';
$searchContainer = $homePage->createEmptyContainer($searchContent);
//---

//Találatok

$konyvek=new BookView();

if(isset($_GET['categoryId']) && !empty($_GET['categoryId'])){

    $categoryController=new CategoryController();
    if($categoryController->getIsCategoryExist(antiSql($_GET['categoryId']))){
        $talaltkonyvek=$konyvek->showBookByCategorySearch(antiSql($_GET['categoryId']));
    } else {
        $talaltkonyvek=$konyvek->showAllBook();
    }
}
else if(isset($_GET['favouriteId']) && !empty($_GET['favouriteId'])){

    $userController=new UserController();
    if($userController->isIdExists(antiSql($_GET['favouriteId']))){
        $talaltkonyvek=$konyvek->showFavouriteBooks(antiSql($_GET['favouriteId']));
    } else {
        $talaltkonyvek=$konyvek->showAllBook();
    }
}
else if(isset($_GET['readId']) && !empty($_GET['readId'])){

    $userController=new UserController();
    if($userController->isIdExists(antiSql($_GET['readId']))){
        $talaltkonyvek=$konyvek->showReadBooks(antiSql($_GET['readId']));
    } else {
        $talaltkonyvek=$konyvek->showAllBook();
    }
}
else if(isset($_GET['waitId']) && !empty($_GET['waitId'])){

    $userController=new UserController();
    if($userController->isIdExists(antiSql($_GET['waitId']))){
        $talaltkonyvek=$konyvek->showWaitBooks(antiSql($_GET['waitId']));
    } else {
        $talaltkonyvek=$konyvek->showAllBook();
    }
}
else {
    
    if(isset($_POST['keresesKuldese']) && !empty($_POST['kereses'])) {
        $talaltkonyvek=$konyvek->showBookBySearch(antiSql($_POST['kereses']));
    }
    
    if(!isset($_POST['keresesKuldese']) || empty($_POST['kereses'])) {
        $talaltkonyvek=$konyvek->showAllBook();
    }
}




$talalatokContent = '<div class="row">';
foreach($talaltkonyvek as $konyv) {
    $talalatokContent.=book_mini($konyv,$ROOT);
}
$talalatokContent .='</div>
';
$talalatokContainer = $homePage->createContainer($talalatokContent,"Találatok", "bi-search");
//---


//Tartalom öszefűzése
$allContent = $searchContainer.$talalatokContainer;

//Oldal megjelenítése
echo $homePage->genFramedPage($allContent);