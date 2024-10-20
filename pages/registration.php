<?php
//----------------------
//  Oldal változók beállítása
//----------------------

$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
//$SRC = "https://localhost/szerveroldali_projekt/";
require_once($ROOT . "generate.php"); //`generate.php` meghívása
$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Regisztráció"; //title attributum értéke
//echo $ROOT."media/images/nincs-borito.jpg";
//----------------------
//      Tartalom
//----------------------

//Bejelentkezés
$loginContent = '
 <div class="container">
     <div class="row m-0">
         <div class="col-12 bg-white rounded-20 p-3">
             <div class="row m-0">
                 <div class="col-6 py-4 px-5 bg-blue-wave rounded-10">
                     <form method="post" action="login_handler.php" id="login-form" class="w-100 max-w-500px">
                        <h2 class="mb-4 text-center text-white">Regisztráció</h2>    
                        <div class="bg-white rounded py-4 px-5">
                            <div class="mb-3">
                                <label for="email" class="form-label my-light-blue">E-mail:</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label my-light-blue">Felhasználónév:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label my-light-blue">Jelszó:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password2" class="form-label my-light-blue">Jelszó ismét:</label>
                                <input type="password" class="form-control" id="password2" name="password2" required>
                            </div>
                            <button type="submit" class="btn d-block mx-auto shadow bg-my-blue my-white-blue">Regisztrálok</button>
                        </div>
                    </form>
                 </div>
                 <div class="col-6 py-4 px-5 d-flex flex-column justify-content-center">
                     
                        <h2 class="mb-4 text-center my-blue">Már van fiókja?</h2>    
                        <p class="text-center my-light-blue my-3 ">
                            Ha már van fiókja csak lépjen be, és máris élvezheti oldalunkat!
                        </p>
                        <a href="login.php" class="my-3 btn d-block mx-auto shadow bg-my-white-blue my-blue">Belépek</a>                
                 </div>
             </div>
         </div>
     </div>
 </div>
';

//---

//Oldal megjelenítése
echo $homePage->genFramedPage($loginContent);
