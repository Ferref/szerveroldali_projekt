<?php
//----------------------
//  Oldal változók beállítása
//----------------------

$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
//$SRC = "https://localhost/szerveroldali_projekt/";
require_once($ROOT . "generate.php"); //`generate.php` meghívása
$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Belépés"; //title attributum értéke
//echo $ROOT."media/images/nincs-borito.jpg";
//----------------------
//      Tartalom
//----------------------

//Bejelentkezés
$loginContent = '
 <div class="container-fluid container-lg">
     <div class="row m-0">
         <div class="col-12 bg-white rounded-20 p-3">
             <div class="row m-0">';
                $loginContent .= ((isset($_SESSION['error']) && !empty($_SESSION['error'])) ? '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>' : "");
$loginContent .= '
                 <div class="col-12 col-md-6 py-4 px-3 px-lg-5 bg-blue-wave rounded-10">
                     <form method="post" action="../handlers/login_handler.php" id="login-form" class="w-100 max-w-500px">
                        <h2 class="mb-4 text-center text-white">Bejelentkezés</h2>    
                        <div class="bg-white rounded py-4 px-2 px-lg-5">
                            <div class="mb-3">
                                <label for="username" class="form-label my-light-blue">Felhasználónév:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label my-light-blue">Jelszó:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn d-block mx-auto shadow bg-my-blue my-white-blue" name="login">Belépés</button>
                        </div>
                    </form>
                 </div>
                 <div class="mt-5 mt-md-0 col-12 col-md-6 py-4 px-2 px-lg-5 d-flex flex-column justify-content-center">
                     
                        <h2 class="mb-4 text-center my-blue">Még nincs fiókja?</h2>    
                        <p class="text-center my-light-blue my-3 ">
                            Készítse el fiókját néhány pillanat alatt, hogy számontarthassa könyveit!
                        </p>
                        <a href="registration.php" class="my-3 btn d-block mx-auto shadow bg-my-white-blue my-blue">Regisztrálok</a>                
                 </div>
             </div>
         </div>
     </div>
 </div>
';

//---
unsetMessages();

//Oldal megjelenítése
echo $homePage->genFramedPage($loginContent);
