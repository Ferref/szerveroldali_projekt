<?php
//----------------------
//  Oldal változók beállítása
//----------------------

$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
//$SRC = "https://localhost/szerveroldali_projekt/";
require_once($ROOT."generate.php"); //`generate.php` meghívása
$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Profil"; //title attributum értéke
//echo $ROOT."media/images/nincs-borito.jpg";
//----------------------
//      Tartalom
//----------------------

//Profil infó
include_once($ROOT."components/book_mini.php");
$kedvContent = '
<div class="container-fluid container-lg mb-4">
        <div class="container-fluid pe-2">
            <div class="row ">
                <div class="col-12 col-md-9 d-flex mb-3 mb-md-0">
                    <div class="pm-md-2 d-flex">
                        <div class="row p-2 bg-white rounded-20 me-md-1 ">
                        <div class="col-12 p-2"><p><span class="block-icon-circle bg-my-white-blue rounded-circle d-inline-block text-center me-2"><i class="w-100 text-center bi bi-person-fill my-blue"></i></span><span class="fw-bold my-blue fs-5">Profil infó</span></p></div>
 
                            <div class="col-12">
                                <div class="row justify-content-center">
                                    <div class="col-8 col-md-4 col-lg-3">
                                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="" class="rounded-10 img-fluid">
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-9 mt-4 mt-md-0">
                                        <p class="mb-2"><b class="my-blue">Felhasználónév:</b> Sensei</p>
                                        <p class="mb-2"><b class="my-blue">E-mail:</b> valami@gmail.com</p>
                                        <p class="mb-2"><b class="my-blue">Regisztrálva:</b> 2024.10.23.</p>
                                        <br>
                                        <p class="mb-2"><b class="my-blue">Kedvenc:</b> 12 <sub class="my-light-blue">db</sub></p>
                                        <p class="mb-2"><b class="my-blue">Olvasott:</b> 52 <sub class="my-light-blue">db</sub></p>
                                        <p class="mb-2"><b class="my-blue">Várólistás:</b> 19 <sub class="my-light-blue">db</sub></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn my-blue"><i class="bi bi-pencil me-2"></i>Szerkesztés</button>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                        </div>
                    </div>
                

                <div class="col-12 col-md-3 d-flex mb-3 mb-md-0">
                    <div class="w-100 d-flex">
                        <div class="w-100 row p-2 bg-white rounded-20 ms-md-1 ">
                        <div class="col-12 p-2"><p><span class="block-icon-circle bg-my-white-blue rounded-circle d-inline-block text-center me-2"><i class="w-100 text-center bi bi-book my-blue"></i></span><span class="fw-bold my-blue fs-5">Könyvek</span></p></div>
                        <div class="col-12">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="#"><i class="bi bi-heart my-blue me-2"></i><span class="my-light-blue">Kedvenc</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="bi bi-journal-check my-blue me-2"></i><span class="my-light-blue">Olvasott</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="bi bi-journal-bookmark-fill my-blue me-2"></i><span class="my-light-blue">Várólistás</span></a>
                                </li>
                            </ul>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
</div>
';
$kedvContainer = $kedvContent;
//---


//---


//Tartalom öszefűzése
$allContent = $kedvContainer;

//Oldal megjelenítése
echo $homePage->genFramedPage($allContent);
?>