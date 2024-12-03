<?php
//----------------------
//  Oldal változók beállítása
//----------------------


$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
//$SRC = "https://localhost/szerveroldali_projekt/";
require_once($ROOT."generate.php"); //`generate.php` meghívása

$categoryController=new CategoryController();

if(!isset($_SESSION['user']) || $_SESSION['user']['szerep']!="admin" || (isset($_GET['id']) && !($categoryController->getIsCategoryExist(antiSql($_GET['id']))))){
    redirect($ROOT);
}


$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Kategória Kezelés"; //title attributum értéke


if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit']) && !isset($_GET['id'])) {
    try {
        if($categoryController->getIsCategoryExistByName(antiSql($_POST['nev']))) {
            throw new HibaException("Ilyen nevű kategória már van!");
        }
        
        if(!($categoryController->createCategory(antiSql($_POST['nev'])))) {
            throw new HibaException();
        }

        $_SESSION['message']="A kategória hozzáadása sikeres!";

        if(isset($_SESSION['rememberPage'])){
            redirect($_SESSION['rememberPage']);
        }

    }catch (HibaException $e) {
        $_SESSION['error']=nl2br("A kategória hozzáadása nem sikerült! \n").$e->getMessage();
    }
}

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit']) && isset($_GET['id'])) {
    try {
        if(!($categoryController->modifyCategory(antiSql($_GET['id']),antiSql($_POST['nev'])))) {
            throw new HibaException();
        }

        $_SESSION['message']="A kategória szerkesztése sikeres!";

        if(isset($_SESSION['rememberPage'])){
            redirect($_SESSION['rememberPage']);
        }
    }catch (HibaException $e) {
        $_SESSION['error']=nl2br("A kategória szerkesztése nem sikerült! \n").$e->getMessage();
    }
    
}

//echo $ROOT."media/images/nincs-borito.jpg";
//----------------------
//      Tartalom
//----------------------

// Könyvek kezelése

// Új vagy Szerkesztés vagy NotFound!
if(isset($_GET['id']) && !empty($_GET['id']))
{
    // Adatbázis ellenörzés, hogy létezik-e a könyv
    // Ha igen, akkor SZERKESZTÉS
    // Ha nem,  akkor NotFound!
    $categoryView=new CategoryView();
    $kategoriaInfo=$categoryView->showCategoryInfo(antiSql($_GET['id']));
    $cim = "Kategória szerkesztése: ".$kategoriaInfo['nev'];
}
else{
    $cim = "Új kategória felvitele";
}

$konyvKezelesContent = '<div class="row">';
    $konyvKezelesContent .= ((isset($_SESSION['error']) && !empty($_SESSION['error'])) ? '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>' : "");
    $konyvKezelesContent .= ((isset($_SESSION['message']) && !empty($_SESSION['message'])) ? '<div class="alert alert-success" role="alert">'.$_SESSION['message'].'</div>' : "");
$konyvKezelesContent .= '<form action="'.antiSql($_SERVER['PHP_SELF']).(isset($_GET['id']) ? "?id={$_GET['id']}" : "").'" method="post" class="row">
        <div class="mb-3 col-12">
            <label for="nev" class="form-label my-light-blue">Név</label>
            <input type="text" class="form-control" id="nev" name="nev" value="'.(isset($_GET['id']) ? $kategoriaInfo['nev'] : "").'" required>
        </div>';

$konyvKezelesContent.='<div class="row">
            <div class="col-12 col-md-5 col-lg-4">
                <div class="row">';
$konyvKezelesContent.='<div class="col-6"><button type="submit" class="w-100 btn my-3 shadow bg-my-blue my-white-blue" name="submit">'.(isset($_GET['id']) ? "Módosítás" : "Feltöltés").'</button></div>';
$konyvKezelesContent.= '
                </div>
            </div>
        </div>
    </form>
</div>';

unsetMessages();

$konyvKezelesContainer = $homePage->createContainer($konyvKezelesContent,$cim, "bi-book");
//---


//Oldal megjelenítése
echo $homePage->genFramedPage($konyvKezelesContainer);