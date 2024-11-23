<?php
//----------------------
//  Oldal változók beállítása
//----------------------


$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
//$SRC = "https://localhost/szerveroldali_projekt/";
require_once($ROOT."generate.php"); //`generate.php` meghívása

$userController=new UserController();

if(!isset($_SESSION['user']) || !isset($_GET['id']) || (isset($_GET['id']) && !($userController->isIdExists($_GET['id']))) || ($_SESSION['user']['id']!=$_GET['id'] && $_SESSION['user']['szerep']!='admin')){
    redirect($ROOT);
}


$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Felhasználó Kezelés"; //title attributum értéke

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit']) && isset($_GET['id'])) {
    try {
        if($_POST['jelszo'] == "") {
            if(!$userController->modifyUserWithoutPassword($_GET['id'], antiSql($_POST['nev']), antiSql($_POST['email']), antiSql($_POST['profilkep_url']))) {
                throw new HibaException();
            }
            $_SESSION['message']="A felhasználó szerkesztése sikeres!";
        } else {
            if(!$userController->modifyUserWithPassword($_GET['id'], antiSql($_POST['nev']), antiSql($_POST['email']), antiSql($_POST['jelszo']), antiSql($_POST['profilkep_url']))) {
                throw new HibaException();
            }
            $_SESSION['message']="A felhasználó szerkesztése sikeres!";
        }
    }catch (HibaException $e) {
        $_SESSION['error']=nl2br("A felhasználó szerkesztése nem sikerült! \n").$e->getMessage();
    }
    
}

//echo $ROOT."media/images/nincs-borito.jpg";
//----------------------
//      Tartalom
//----------------------

// Könyvek kezelése

// Új vagy Szerkesztés vagy NotFound!
    // Adatbázis ellenörzés, hogy létezik-e a könyv
    // Ha igen, akkor SZERKESZTÉS
    // Ha nem,  akkor NotFound!
$userView=new UserView();
$userInfo=$userView->showUserInfoById($_GET['id']);
$cim = "Felhasználó szerkesztése: ".$userInfo['nev'];


$userKezelesContent = '<div class="row">';
    $userKezelesContent .= ((isset($_SESSION['error']) && !empty($_SESSION['error'])) ? '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>' : "");
    $userKezelesContent .= ((isset($_SESSION['message']) && !empty($_SESSION['message'])) ? '<div class="alert alert-success" role="alert">'.$_SESSION['message'].'</div>' : "");
$userKezelesContent .= '<form action="'.antiSql($_SERVER['PHP_SELF']).(isset($_GET['id']) ? "?id={$_GET['id']}" : "").'" method="post" class="row">
        <div class="mb-3 col-12">
            <label for="nev" class="form-label my-light-blue">Név</label>
            <input type="text" class="form-control" id="nev" name="nev" value="'.$userInfo['nev'].'" required>
        </div>
        <div class="mb-3 col-12">
            <label for="email" class="form-label my-light-blue">E-mail cím</label>
            <input type="text" class="form-control" id="email" name="email" value="'.$userInfo['email'].'" required>
        </div>
        <div class="mb-3 col-12">
            <label for="profilkep_url" class="form-label my-light-blue">Profilkép url</label>
            <input type="text" class="form-control" id="profilkep_url" name="profilkep_url" value="'.$userInfo['profilkep_url'].'">
        </div>
        <div class="mb-3 col-12">
            <label for="jelszo" class="form-label my-light-blue">Új jelszó</label>
            <input type="password" class="form-control" id="jelszo" name="jelszo" value=""/>
        </div>';

$userKezelesContent.='<div class="row">
            <div class="col-12 col-md-5 col-lg-4">
                <div class="row">';
$userKezelesContent.='<div class="col-6"><button type="submit" class="w-100 btn my-3 shadow bg-my-blue my-white-blue" name="submit">Módosítás</button></div>';
$userKezelesContent.= '
                </div>
            </div>
        </div>
    </form>
</div>';

unsetMessages();

$userKezelesContainer = $homePage->createContainer($userKezelesContent,$cim, "bi-book");
//---


//Oldal megjelenítése
echo $homePage->genFramedPage($userKezelesContainer);