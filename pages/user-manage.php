<?php
//----------------------
//  Oldal változók beállítása
//----------------------

$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
//$SRC = "https://localhost/szerveroldali_projekt/";
require_once($ROOT."generate.php"); //`generate.php` meghívása

if(!isset($_SESSION['user_role']) ||$_SESSION['user_role']!="admin") {
  redirect("../");
}

if(!isset($_GET['page'])) {
  $_GET['page']=1;
}
$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Felhasználó kezelés"; //title attributum értéke
//echo $ROOT."media/images/nincs-borito.jpg";
//----------------------
//      Tartalom
//----------------------

//Random kedvcsináló
if(isset($_GET["page"])) {
  $page=$_GET["page"];
}else {
  $page="";
}

if ($page=="" || $page==1) {
  $page_1=0;
} else {
  $page_1= ($page*10)-10;
}

$users=new UserView("");
$usersInfo=$users->showAllUserInfo($page_1);
$userPage=$users->showAllUserInfoPageNumber();
$userPage=ceil(($userPage['oldalak_szama'])/10);

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
      <a class="page-link" href="'.$ROOT.'pages/user-manage.php'.($_GET["page"]==1 ? "#" : "?page=".$_GET['page']-1).'" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>';
    for ($i=1; $i<=$userPage;$i++){
      if ($i==$page) {
        $kedvContent .='<li class="page-item"><a class="page-link page-active" href="'.$ROOT.'pages/user-manage.php?page='.$i.'">'.$i.'</a></li>';
      } else {
      $kedvContent .='<li class="page-item"><a class="page-link" href="'.$ROOT.'pages/user-manage.php?page='.$i.'">'.$i.'</a></li>';
      }
    }

$kedvContent .= 
    '<li class="page-item">
      <a class="page-link" href="'.$ROOT.'pages/user-manage.php'.(($userPage<=1 || $_GET["page"]==$userPage) ? "#" : "?page=".$_GET['page']+1).'" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
<table class="table table-striped table-hover table-primary ">
    <thead>
        <tr class="table-light"><th>#</th><th>Id</th><th>Név</th><th>E-mail</th><th>Szerep</th><th>Módosítás</th></tr>
    </thead>
    <tbody>';
    $j=1;
    foreach($usersInfo as $u) {
      $kedvContent .='<tr><td>'.$j.'</td><td>'.$u['id'].'</td><td>'.$u['nev'].'</td><td>'.$u['email'].'</td><td>'.$u['szerep'].'</td><td><input type="button" value="Szerk" class="btn btn-outline-primary me-2"><input type="submit" value="Törlés" class="btn btn-outline-danger"></td></tr>';
      $j++;
    }
$kedvContent .=
    '</tbody>

</table>
<nav class="">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="'.$ROOT.'pages/user-manage.php'.($_GET["page"]==1 ? "#" : "?page=".$_GET['page']-1).'" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>';
    for ($i=1; $i<=$userPage;$i++){
      if ($i==$page) {
        $kedvContent .='<li class="page-item"><a class="page-link page-active" href="'.$ROOT.'pages/user-manage.php?page='.$i.'">'.$i.'</a></li>';
      } else {
      $kedvContent .='<li class="page-item"><a class="page-link" href="'.$ROOT.'pages/user-manage.php?page='.$i.'">'.$i.'</a></li>';
      }
    }
$kedvContent .= 
    '<li class="page-item">
      <a class="page-link" href="'.$ROOT.'pages/user-manage.php'.(($userPage<=1 || $_GET["page"]==$userPage) ? "#" : "?page=".$_GET['page']+1).'" aria-label="Next">
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