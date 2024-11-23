<?php
//----------------------
//  Oldal változók beállítása
//----------------------


$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
//$SRC = "https://localhost/szerveroldali_projekt/";
require_once($ROOT."generate.php"); //`generate.php` meghívása

$iroController=new AuthorController();

if(!isset($_SESSION['user']) || $_SESSION['user']['szerep']!="admin" || (isset($_GET['id']) && !($iroController->getIsWriterExist($_GET['id'])))){
    redirect($ROOT);
}

$_SESSION["rememberPage"]=$ROOT.'pages/author-manage.php' . (isset($_GET['id']) ? '?id='.$_GET['id'] : "");

$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Szerző Kezelés"; //title attributum értéke


if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit']) && !isset($_GET['id'])) {
    try {
        if(!($iroController->insertNewWriter(antiSql($_POST['nev']), antiSql($_POST['profilkep_url']), antiSql($_POST['szuletesi_ido']),
        antiSql($_POST['halal_ido']),antiSql ($_POST['szarmazas'])))) {
            throw new HibaException();
        }

        $_SESSION['message']="A szerző hozzáadása sikeres!";

        if(isset($_SESSION['rememberPage'])){
            redirect($_SESSION['rememberPage']);
        }

    }catch (HibaException $e) {
        $_SESSION['error']=nl2br("A szerző hozzáadása nem sikerült! \n").$e->getMessage();
    }
}

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit']) && isset($_GET['id'])) {
    try {
        if(!($iroController->updatingWriter($_GET['id'],antiSql($_POST['nev']), antiSql($_POST['profilkep_url']), antiSql($_POST['szuletesi_ido']),
    antiSql($_POST['halal_ido']),antiSql ($_POST['szarmazas'])))) {
            throw new HibaException();
        }

        $_SESSION['message']="A szerző szerkesztése sikeres!";

        if(isset($_SESSION['rememberPage'])){
            redirect($_SESSION['rememberPage']);
        }
    }catch (HibaException $e) {
        $_SESSION['error']=nl2br("A szerző szerkesztése nem sikerült! \n").$e->getMessage();
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
    $iro=new AuthorView();
    $iroInfo=$iro->showAuthorInfo($_GET['id']);
    $cim = "Szerző szerkesztése: ".$iroInfo['nev'];
}
else{
    $cim = "Új szerző felvitele";
}

$iroKezelesContent = '<div class="row">';
    $iroKezelesContent .= ((isset($_SESSION['error']) && !empty($_SESSION['error'])) ? '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>' : "");
    $iroKezelesContent .= ((isset($_SESSION['message']) && !empty($_SESSION['message'])) ? '<div class="alert alert-success" role="alert">'.$_SESSION['message'].'</div>' : "");
$iroKezelesContent .= '<form action="'.antiSql($_SERVER['PHP_SELF']).(isset($_GET['id']) ? "?id={$_GET['id']}" : "").'" method="post" class="row">
        <div class="mb-3 col-12">
            <label for="nev" class="form-label my-light-blue">Név</label>
            <input type="text" class="form-control" id="nev" name="nev" value="'.(isset($_GET['id']) ? $iroInfo['nev'] : "").'" required>
        </div>
        <div class="mb-3 col-6 col-lg-3">
            <label for="szuletesi_ido" class="form-label my-light-blue">Született</label>
            <input type="date" class="form-control" id="szuletesi_ido" name="szuletesi_ido" value="'.(isset($_GET['id']) ? $iroInfo['szuletesi_ido'] : "").'" required>
        </div>
        <div class="mb-3 col-6 col-lg-3">
            <label for="halal_ido" class="form-label my-light-blue">Meghalt</label>
            <input type="date" class="form-control" id="halal_ido" name="halal_ido" value="'.(isset($_GET['id']) ? $iroInfo['halal_ido'] : "").'">
        </div>
        <div class="mb-3 col-12 col-md-6">
            <label for="profilkep_url" class="form-label my-light-blue">Profilkép url</label>
            <input type="text" class="form-control" id="profilkep_url" name="profilkep_url" value="'.(isset($_GET['id']) ? $iroInfo['profilkep_url'] : "").'" required>
        </div>
        <div class="mb-3 col-12 col-md-6">
            <label for="szarmazas" class="form-label my-light-blue">Származás</label>
            <input type="text" class="form-control" id="szarmazas" name="szarmazas" value="'.(isset($_GET['id']) ? $iroInfo['szarmazas'] : "").'"/>
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