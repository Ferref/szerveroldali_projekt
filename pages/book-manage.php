<?php
//----------------------
//  Oldal változók beállítása
//----------------------


$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
//$SRC = "https://localhost/szerveroldali_projekt/";
require_once($ROOT."generate.php"); //`generate.php` meghívása

$bookController=new BookController();

if(!isset($_SESSION['user']) || $_SESSION['user']['szerep']!="admin" || (isset($_GET['id']) && !($bookController->getIsBookExist(antiSql($_GET['id']))))){
    redirect($ROOT);
}


$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Könyv Kezelés"; //title attributum értéke

$kategoria=new CategoryView();
$kategoriaControll=new CategoryController();
$kategoriak=$kategoria->showCategories();

$iro=new AuthorView();
$iroController=new AuthorController();
$irok=$iro->showAllWriter();

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit']) && !isset($_GET['id'])) {
    try {
        if(!($bookController->insertNewBook(antiSql($_POST['cim']), antiSql($_POST['leiras']), antiSql($_POST['oldalszam']),
        antiSql($_POST['kiadasev']),antiSql ($_POST['borito']), "", ""))) {
            throw new HibaException();
        }

        $newId=$bookController->latestBookId();

        if(empty($_POST['categories'])) throw new HibaException("Legalább egy kategóriát ki kell választani!");

        foreach($_POST['categories'] as $category) {
            $kategoriaControll->addBookCategory($newId['id'], $category);
        }

        if(empty($_POST['writers'])) throw new HibaException("Legalább egy írót ki kell választani!");

        foreach($_POST['writers'] as $writer) {
            $iroController->addBookWriter($newId['id'], $writer);
        }

        $_SESSION['message']="A könyv hozzáadása sikeres!";

        if(isset($_SESSION['rememberPage'])){
            redirect($_SESSION['rememberPage']);
        }

    }catch (HibaException $e) {
        $_SESSION['error']=nl2br("A könyv hozzáadása nem sikerült! \n").$e->getMessage();
    }
}

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit']) && isset($_GET['id'])) {
    try {
        if(!($bookController->updatingBook($_GET['id'],antiSql($_POST['cim']), antiSql($_POST['leiras']), antiSql($_POST['oldalszam']),
    antiSql($_POST['kiadasev']),antiSql ($_POST['borito']), "", ""))) {
            throw new HibaException();
        }

        if(empty($_POST['categories'])) throw new HibaException("Legalább egy kategóriát ki kell választani!");

        $kategoriaControll->removeBookCategories($_GET['id']);
        foreach($_POST['categories'] as $category) {
            $kategoriaControll->addBookCategory($_GET['id'], $category);
        }

        if(empty($_POST['writers'])) throw new HibaException("Legalább egy írót ki kell választani!");

        $iroController->removeBookWriters($_GET['id']);
        foreach($_POST['writers'] as $writer) {
            $iroController->addBookWriter($_GET['id'], $writer);
        }

        $_SESSION['message']="A könyv szerkesztése sikeres!";

        if(isset($_SESSION['rememberPage'])){
            redirect($_SESSION['rememberPage']);
        }
    }catch (HibaException $e) {
        $_SESSION['error']=nl2br("A könyv szerkesztése nem sikerült! \n").$e->getMessage();
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
    $konyv=new BookView();
    $konyvInfo=$konyv->showBookInfo($_GET['id']);
    $cim = "Könyv szerkesztése: ".$konyvInfo['cim'];
}
else{
    $cim = "Új könyv felvitele";
}

$konyvKezelesContent = '<div class="row">';
    $konyvKezelesContent .= ((isset($_SESSION['error']) && !empty($_SESSION['error'])) ? '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>' : "");
    $konyvKezelesContent .= ((isset($_SESSION['message']) && !empty($_SESSION['message'])) ? '<div class="alert alert-success" role="alert">'.$_SESSION['message'].'</div>' : "");
$konyvKezelesContent .= '<form action="'.antiSql($_SERVER['PHP_SELF']).(isset($_GET['id']) ? "?id={$_GET['id']}" : "").'" method="post" class="row">
        <div class="mb-3 col-12">
            <label for="cim" class="form-label my-light-blue">Cím</label>
            <input type="text" class="form-control" id="cim" name="cim" value="'.(isset($_GET['id']) ? $konyvInfo['cim'] : "").'" required>
        </div>
        <div class="mb-3 col-12">
            <label for="leiras" class="form-label my-light-blue">Leírás</label>
            <textarea class="form-control" id="leiras" name="leiras" rows="7" required>'.(isset($_GET['id']) ? $konyvInfo['leiras'] : "").'</textarea>
        </div>
        <div class="mb-3 col-6 col-lg-3">
            <label for="oldalszam" class="form-label my-light-blue">Oldalszám</label>
            <input type="number" class="form-control" id="oldalszam" name="oldalszam" value="'.(isset($_GET['id']) ? $konyvInfo['oldalszam'] : "").'" min="0" required>
        </div>
        <div class="mb-3 col-6 col-lg-3">
            <label for="kiadasev" class="form-label my-light-blue">Kiadási év</label>
            <input type="number" class="form-control" id="kiadasev" name="kiadasev" value="'.(isset($_GET['id']) ? $konyvInfo['kiadasi_ev'] : "").'" min="0" required>
        </div>

        <div class="mb-3 col-12 col-lg-6">
            <label for="borito" class="form-label my-light-blue">Borító</label>
            <input type="text" class="form-control" id="borito" name="borito" value="'.(isset($_GET['id']) ? $konyvInfo['boritokep_url'] : "").'" required>
        </div>

        <div class="mb-3 col-12">
            <fieldset class="border border-2 rounded-3 p-3">
                <legend class="float-none w-auto px-3 my-blue">Kategóriák</legend>
                <div class="row m-0">
                    <div class="col-12 col-md-6 col-lg-3"><input onkeyup="categoryFilter()" type="text" class="form-control" id="categoryInput" placeholder="Szűrés"/></div>
                </div>
                <div class="row mx-0 my-3">
                    <div class="col-12" id="categoriesContainer">';
                        foreach($kategoriak as $k) {
                            if(isset($_GET['id'])) {
                                if($kategoria->showIsCategoryInBook($_GET['id'],$k['id'])) {
                                    $konyvKezelesContent .= '<label class="category-frame rounded-10 py-1 px-3 c-pointer me-2 mb-2" for="kat'.$k['id'].'" style="background-color: rgb(75, 101, 135); color: white;">
                                        <input class="kat" type="checkbox" name="categories[]" value="'.$k['id'].'" id="kat'.$k['id'].'" hidden checked>
                                        <span>'.$k["nev"].'</span>
                                    </label>';
                                }
                                else {
                                    $konyvKezelesContent .= '<label class="category-frame rounded-10 py-1 px-3 c-pointer me-2 mb-2" for="kat'.$k['id'].'">
                                        <input class="kat" type="checkbox" name="categories[]" value="'.$k['id'].'" id="kat'.$k['id'].'" hidden>
                                        <span>'.$k["nev"].'</span>
                                    </label>';
                                }
                            }
                            else {
                                $konyvKezelesContent .= '<label class="category-frame rounded-10 py-1 px-3 c-pointer me-2 mb-2" for="kat'.$k['id'].'">
                                        <input class="kat" type="checkbox" name="categories[]" value="'.$k['id'].'" id="kat'.$k['id'].'" hidden>
                                        <span>'.$k["nev"].'</span>
                                    </label>';
                            }
                        }
$konyvKezelesContent.='</div>
                </div>
                <script src="'.$ROOT.'assets/js/categoryFilter.js"></script>
            </fieldset>
        </div>';

$konyvKezelesContent.='<div class="mb-3 col-12">
            <fieldset class="border border-2 rounded-3 p-3">
                <legend class="float-none w-auto px-3 my-blue">Írók</legend>
                <div class="row m-0">
                    <div class="col-12 col-md-6 col-lg-3"><input onkeyup="authorFilter()" type="text" class="form-control" id="authorInput" placeholder="Szűrés"/></div>
                </div>
                <div class="row mx-0 my-3">
                    <div class="col-12" id="authorsContainer">';
                        foreach($irok as $i) {
                            if(isset($_GET['id'])) {
                                if($iro->showIsWriterWroteBook($_GET['id'],$i['id'])) {
                                    $konyvKezelesContent .= '<label class="category-frame rounded-10 py-1 px-3 c-pointer me-2 mb-2" for="iro'.$i['id'].'" style="background-color: rgb(75, 101, 135); color: white;">
                                        <input class="kat" type="checkbox" name="writers[]" value="'.$i['id'].'" id="iro'.$i['id'].'" hidden checked>
                                        <span>'.$i["nev"].'</span>
                                    </label>';
                                }
                                else {
                                    $konyvKezelesContent .= '<label class="category-frame rounded-10 py-1 px-3 c-pointer me-2 mb-2" for="iro'.$i['id'].'">
                                        <input class="kat" type="checkbox" name="writers[]" value="'.$i['id'].'" id="iro'.$i['id'].'" hidden>
                                        <span>'.$i["nev"].'</span>
                                    </label>';
                                }
                            }
                            else {
                                $konyvKezelesContent .= '<label class="category-frame rounded-10 py-1 px-3 c-pointer me-2 mb-2" for="iro'.$i['id'].'">
                                        <input class="kat" type="checkbox" name="writers[]" value="'.$i['id'].'" id="iro'.$i['id'].'" hidden>
                                        <span>'.$i["nev"].'</span>
                                    </label>';
                            }
                        }
$konyvKezelesContent.='</div>
                </div>
                <script src="'.$ROOT.'assets/js/authorFilter.js"></script>
            </fieldset>
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