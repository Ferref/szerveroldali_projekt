<?php
//----------------------
//  Oldal változók beállítása
//----------------------

$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
//$SRC = "https://localhost/szerveroldali_projekt/";
require_once($ROOT."generate.php"); //`generate.php` meghívása

if(!isset($_SESSION['user']) || $_SESSION['user']['szerep']!="admin") {
  redirect($ROOT);
}

if(!isset($_GET['page'])) {
  $_GET['page']=1;
}
$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Felhasználó lista"; //title attributum értéke
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

$users=new UserView();

if(isset($_GET['filterName']) && isset($_GET['filterEmail'])){

  if($_GET['filterName']=="" && $_GET['filterEmail']=="") {
    redirect($ROOT.'pages/user-list.php?page='.$page);
  }

  if($_GET['filterName']!="" && $_GET['filterEmail']=="") {
    $usersInfo=$users->showUserInfoName(antiSql($_GET['filterName']),$page_1);
    $userPage=$users->showUserInfoNamePageNumber(antiSql($_GET['filterName']));
    $talalatok=$userPage['oldalak_szama'];
    $userPage=ceil(($userPage['oldalak_szama'])/10);
  }
  
  if($_GET['filterName']=="" && $_GET['filterEmail']!="") {
    $usersInfo=$users->showUserInfoEmail(antiSql($_GET['filterEmail']),$page_1);
    $userPage=$users->showUserInfoEmailPageNumber(antiSql($_GET['filterEmail']));
    $talalatok=$userPage['oldalak_szama'];
    $userPage=ceil(($userPage['oldalak_szama'])/10);
  }
  
  if($_GET['filterName']!="" && $_GET['filterEmail']!="") {
    $usersInfo=$users->showUserInfoNameEmail(antiSql($_GET['filterName']),antiSql($_GET['filterEmail']),$page_1);
    $userPage=$users->showUserInfoNameEmailPageNumber(antiSql($_GET['filterName']),antiSql($_GET['filterEmail']));
    $talalatok=$userPage['oldalak_szama'];
    $userPage=ceil(($userPage['oldalak_szama'])/10);
  }


}



if(!isset($_GET['filterName']) && !isset($_GET['filterEmail'])) {
  $usersInfo=$users->showAllUserInfo($page_1);
  $userPage=$users->showAllUserInfoPageNumber();
  $talalatok=$userPage['oldalak_szama'];
  $userPage=ceil(($userPage['oldalak_szama'])/10);
}

$hrefBack=($_GET["page"]==1 ? "#" : $ROOT.'pages/user-list.php'."?page=".$_GET['page']-1) . (isset($_GET['filterName']) ? "&filterName=".antiSql($_GET['filterName']) : "").(isset($_GET['filterEmail']) ? "&filterEmail=".antiSql($_GET['filterEmail']) : "");
$hrefForward=(($userPage<=1 || $_GET["page"]==$userPage) ? "#" : $ROOT.'pages/user-list.php'."?page=".$_GET['page']+1) . (isset($_GET['filterName']) ? "&filterName=".antiSql($_GET['filterName']) : "").(isset($_GET['filterEmail']) ? "&filterEmail=".antiSql($_GET['filterEmail']) : "");

$_SESSION["rememberPage"]=$ROOT.'pages/user-list.php?page='.$page . (isset($_GET['filterName']) ? "&filterName=".antiSql($_GET['filterName']) : "").(isset($_GET['filterEmail']) ? "&filterEmail=".antiSql($_GET['filterEmail']) : "");

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
          <form action="'.$ROOT.'pages/user-list.php" method="GET">
            <div class="col-12 my-blue d-flex justify-content-center">
                <span class="me-3 align-items-center d-flex">Szűrés:</span>
                <input type="text" name="filterName" id="filterName" placeholder="Felhasználónév..." class="ps-2 me-3 rounded">
                <input type="text" name="filterEmail" id="filterEmail" placeholder="E-mail cím..." class="ps-2 me-3 rounded">
                <input type="submit" id="filterUsersSubmit" value="Keresés" class="btn btn-primary px-4 me-3 rounded">
                <span class=" align-items-center d-flex">Találatok: '.$talalatok.'</span>
            </div>
        </div>
   
<nav class="">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="'.$hrefBack.'" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>';
    for ($i=1; $i<=$userPage;$i++){
      $pagelink=$ROOT.'pages/user-list.php?page='.$i . (isset($_GET['filterName']) ? "&filterName=".$_GET['filterName'] : "").(isset($_GET['filterEmail']) ? "&filterEmail=".$_GET['filterEmail'] : "");
      if ($i==$page) {
        $kedvContent .='<li class="page-item"><a class="page-link page-active" href="'.$pagelink.'">'.$i.'</a></li>';
      } else {
      $kedvContent .='<li class="page-item"><a class="page-link" href="'.$pagelink.'">'.$i.'</a></li>';
      }
    }

$kedvContent .= 
    '<li class="page-item">
      <a class="page-link" href="'.$hrefForward.'" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>';

$kedvContent .= ((isset($_SESSION['error']) && !empty($_SESSION['error'])) ? '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>' : "");
$kedvContent .= ((isset($_SESSION['message']) && !empty($_SESSION['message'])) ? '<div class="alert alert-success" role="alert">'.$_SESSION['message'].'</div>' : "");
$kedvContent .='<table class="table table-striped table-hover table-primary ">
    <thead>
        <tr class="table-light"><th>#</th><th>Id</th><th>Név</th><th>E-mail</th><th>Szerep</th><th>Módosítás</th></tr>
    </thead>
    <tbody>';
    $j=1;
    foreach($usersInfo as $u) {
      $kedvContent .='<tr><td>'.$j.'</td><td>'.$u['id'].'</td><td>'.$u['nev'].'</td><td>'.$u['email'].'</td><td>'.$u['szerep'].'</td><td><a href="user-manage.php?id='.$u['id'].'" class="btn btn-outline-primary me-2">Szerk</a><a href="'.$ROOT.'/handlers/delete_handler.php?deleteUser='.$u['id'].'" class="btn btn-outline-danger">Törlés</a></td></tr>';
      $j++;
    }
$kedvContent .=
    '</tbody>

</table>
<nav class="">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="'.$hrefBack.'" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>';
    for ($i=1; $i<=$userPage;$i++){
      $pagelink=$ROOT.'pages/user-list.php?page='.$i . (isset($_GET['filterName']) ? "&filterName=".$_GET['filterName'] : "").(isset($_GET['filterEmail']) ? "&filterEmail=".$_GET['filterEmail'] : "");
      if ($i==$page) {
        $kedvContent .='<li class="page-item"><a class="page-link page-active" href="'.$pagelink.'">'.$i.'</a></li>';
      } else {
      $kedvContent .='<li class="page-item"><a class="page-link" href="'.$pagelink.'">'.$i.'</a></li>';
      }
    }
$kedvContent .= 
    '<li class="page-item">
      <a class="page-link" href="'.$hrefForward.'" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
';
$kedvContainer = $homePage->createContainer($kedvContent,"Felhasználók", "bi-person-lines-fill");
//---


//---
unsetMessages();

//Tartalom öszefűzése
$allContent = $kedvContainer;

//Oldal megjelenítése
echo $homePage->genFramedPage($allContent);

;