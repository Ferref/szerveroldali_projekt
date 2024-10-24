<?php
//----------------------
//  Oldal változók beállítása
//----------------------

$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
//$SRC = "https://localhost/szerveroldali_projekt/";
require_once($ROOT."generate.php"); //`generate.php` meghívása
$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Felhasználó kezelés"; //title attributum értéke
//echo $ROOT."media/images/nincs-borito.jpg";
//----------------------
//      Tartalom
//----------------------

//Random kedvcsináló

$kedvContent = '
<style>
    input[type="text"]{
    font-size: 12px;
    }
    table td{
        vertical-align: middle;
    }
</style>

        <div class="row mb-4">
            <div class="col-12 my-blue d-flex justify-content-center">
                <span class="me-3 align-items-center d-flex">Szűrés:</span>
                <input type="text" name="filterName" id="filterName" placeholder="Felhasználónév..." class="ps-2 me-3 rounded">
                <input type="text" name="filterEmail" id="filterEmail" placeholder="E-mail cím..." class="ps-2 me-3 rounded">
                <input type="button" name="filterUsersSubmit" id="filterUsersSubmit" value="Keresés" class="btn btn-primary px-4 me-3 rounded">
                <span class=" align-items-center d-flex">Találatok: -</span>
            </div>
        </div>
   
<nav class="">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">...</a></li>
    <li class="page-item"><a class="page-link" href="#">42</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
<table class="table table-striped table-hover table-primary ">
    <thead>
        <tr class="table-light"><th>#</th><th>Id</th><th>Név</th><th>E-mail</th><th>Jelszó</th><th>Módosítás</th></tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Id</td><td>Név</td><td>E-mail</td><td>Jelszó</td><td><input type="button" value="Szerk" class="btn btn-outline-primary me-2"><input type="submit" value="Törlés" class="btn btn-outline-danger"></td></tr>
        <tr><td>2</td><td>Id</td><td>Név</td><td>E-mail</td><td>Jelszó</td><td><input type="button" value="Szerk" class="btn btn-outline-primary me-2"><input type="submit" value="Törlés" class="btn btn-outline-danger"></td></tr>
        <tr><td>3</td><td>Id</td><td>Név</td><td>E-mail</td><td>Jelszó</td><td><input type="button" value="Szerk" class="btn btn-outline-primary me-2"><input type="submit" value="Törlés" class="btn btn-outline-danger"></td></tr>
        <tr><td>4</td><td>Id</td><td>Név</td><td>E-mail</td><td>Jelszó</td><td><input type="button" value="Szerk" class="btn btn-outline-primary me-2"><input type="submit" value="Törlés" class="btn btn-outline-danger"></td></tr>
        <tr><td>5</td><td>Id</td><td>Név</td><td>E-mail</td><td>Jelszó</td><td><input type="button" value="Szerk" class="btn btn-outline-primary me-2"><input type="submit" value="Törlés" class="btn btn-outline-danger"></td></tr>
        <tr><td>6</td><td>Id</td><td>Név</td><td>E-mail</td><td>Jelszó</td><td><input type="button" value="Szerk" class="btn btn-outline-primary me-2"><input type="submit" value="Törlés" class="btn btn-outline-danger"></td></tr>
        <tr><td>7</td><td>Id</td><td>Név</td><td>E-mail</td><td>Jelszó</td><td><input type="button" value="Szerk" class="btn btn-outline-primary me-2"><input type="submit" value="Törlés" class="btn btn-outline-danger"></td></tr>
        <tr><td>8</td><td>Id</td><td>Név</td><td>E-mail</td><td>Jelszó</td><td><input type="button" value="Szerk" class="btn btn-outline-primary me-2"><input type="submit" value="Törlés" class="btn btn-outline-danger"></td></tr>
        <tr><td>9</td><td>Id</td><td>Név</td><td>E-mail</td><td>Jelszó</td><td><input type="button" value="Szerk" class="btn btn-outline-primary me-2"><input type="submit" value="Törlés" class="btn btn-outline-danger"></td></tr>
        <tr><td>10</td><td>Id</td><td>Név</td><td>E-mail</td><td>Jelszó</td><td><input type="button" value="Szerk" class="btn btn-outline-primary me-2"><input type="submit" value="Törlés" class="btn btn-outline-danger"></td></tr>

        </tbody>

</table>
<nav class="">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">...</a></li>
    <li class="page-item"><a class="page-link" href="#">42</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
';
$kedvContainer = $homePage->createContainer($kedvContent,"Felhasználók", "bi-person-lines-fill");
//---


//---


//Tartalom öszefűzése
$allContent = $kedvContainer;

//Oldal megjelenítése
echo $homePage->genFramedPage($allContent);
?>