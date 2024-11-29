<?php
//----------------------
//  Oldal változók beállítása
//----------------------


$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
//$SRC = "https://localhost/szerveroldali_projekt/";
require_once($ROOT."generate.php"); //`generate.php` meghívása

$reviewController=new ReviewController();

if(!isset($_GET['id']) || !isset($_SESSION['user']) || $_SESSION['user']['szerep']!="admin" || !($reviewController->getIsReviewExist(antiSql($_GET['id'])))){
    redirect($ROOT);
}

$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Vélemény Kezelés"; //title attributum értéke

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit']) && isset($_GET['id'])) {
    try {
        if(!($reviewController->refreshReview($_GET['id'],antiSql($_POST['velemeny'])))) {
            throw new HibaException();
        }

        $_SESSION['message']="A vélemény szerkesztése sikeres!";

        if(isset($_SESSION['rememberPage'])){
            redirect($_SESSION['rememberPage']);
        }
    }catch (HibaException $e) {
        $_SESSION['error']=nl2br("A vélemény szerkesztése nem sikerült! \n").$e->getMessage();
    }
    
}

//echo $ROOT."media/images/nincs-borito.jpg";
//----------------------
//      Tartalom
//----------------------

// Könyvek kezelése



$review=new ReviewView();
$reviewInfo=$review->showReview($_GET['id']);
$cim = "Vélemény szerkesztése:";


$iroKezelesContent = '<div class="row">';
    $iroKezelesContent .= ((isset($_SESSION['error']) && !empty($_SESSION['error'])) ? '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>' : "");
    $iroKezelesContent .= ((isset($_SESSION['message']) && !empty($_SESSION['message'])) ? '<div class="alert alert-success" role="alert">'.$_SESSION['message'].'</div>' : "");
$iroKezelesContent .= '<form action="'.antiSql($_SERVER['PHP_SELF']).(isset($_GET['id']) ? "?id={$_GET['id']}" : "").'" method="post" class="row">
        <div class="mb-3 col-12">
            <label for="velemeny" class="form-label my-light-blue">Leírás</label>
            <textarea class="form-control" id="velemeny" name="velemeny" rows="7" required>'.(isset($_GET['id']) ? $reviewInfo['velemeny'] : "").'</textarea>
        </div>';

$iroKezelesContent.='<div class="row">
            <div class="col-12 col-md-5 col-lg-4">
                <div class="row">';
$iroKezelesContent.='<div class="col-6"><button type="submit" class="w-100 btn my-3 shadow bg-my-blue my-white-blue" name="submit">'.(isset($_GET['id']) ? "Módosítás" : "Feltöltés").'</button></div>';
$iroKezelesContent.= '
                </div>
            </div>
        </div>
    </form>
</div>';

unsetMessages();

$iroKezelesContainer = $homePage->createContainer($iroKezelesContent,$cim, "bi-book");
//---


//Oldal megjelenítése
echo $homePage->genFramedPage($iroKezelesContainer);