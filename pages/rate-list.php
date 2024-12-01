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
$homePage->name = "Értékelések lista"; //title attributum értéke
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

if(isset($_GET['filterUser']) && isset($_GET['filterBook'])){

  if($_GET['filterUser']=="" && $_GET['filterBook']=="") {
    redirect($ROOT.'pages/rate-list.php?page='.$page);
  }

  if($_GET['filterUser']!="" && $_GET['filterBook']=="") {
    $ratesInfo=$users->showUserRate(antiSql($_GET['filterUser']),$page_1);
    $ratesPage=$users->showUserRatePageNumber(antiSql($_GET['filterUser']));
    $talalatok=$ratesPage['oldalak_szama'];
    $ratesPage=ceil(($ratesPage['oldalak_szama'])/10);
  }
  
  if($_GET['filterUser']=="" && $_GET['filterBook']!="") {
    $ratesInfo=$users->showBookRate(antiSql($_GET['filterBook']),$page_1);
    $ratesPage=$users->showBookRatePageNumber(antiSql($_GET['filterBook']));
    $talalatok=$ratesPage['oldalak_szama'];
    $ratesPage=ceil(($ratesPage['oldalak_szama'])/10);
  }
  
  if($_GET['filterUser']!="" && $_GET['filterBook']!="") {
    $ratesInfo=$users->showUserBookRates(antiSql($_GET['filterUser']),antiSql($_GET['filterBook']),$page_1);
    $ratesPage=$users->showUserBookRatesPageNumber(antiSql($_GET['filterUser']),antiSql($_GET['filterBook']));
    $talalatok=$ratesPage['oldalak_szama'];
    $ratesPage=ceil(($ratesPage['oldalak_szama'])/10);
  }


}



if(!isset($_GET['filterUser']) && !isset($_GET['filterBook'])) {
  $ratesInfo=$users->showAllUserRate($page_1);
  $ratesPage=$users->showAllUserRatePageNumber();
  $talalatok=$ratesPage['oldalak_szama'];
  $ratesPage=ceil(($ratesPage['oldalak_szama'])/10);
}

$hrefBack=($_GET["page"]==1 ? "#" : $ROOT.'pages/rate-list.php'."?page=".$_GET['page']-1) . (isset($_GET['filterUser']) ? "&filterUser=".antiSql($_GET['filterUser']) : "").(isset($_GET['filterBook']) ? "&filterBook=".antiSql($_GET['filterBook']) : "");
$hrefForward=(($ratesPage<=1 || $_GET["page"]==$ratesPage) ? "#" : $ROOT.'pages/rate-list.php'."?page=".$_GET['page']+1) . (isset($_GET['filterUser']) ? "&filterUser=".antiSql($_GET['filterUser']) : "").(isset($_GET['filterBook']) ? "&filterBook=".antiSql($_GET['filterBook']) : "");

$_SESSION["rememberPage"]=$ROOT.'pages/rate-list.php?page='.$page . (isset($_GET['filterUser']) ? "&filterUser=".antiSql($_GET['filterUser']) : "").(isset($_GET['filterBook']) ? "&filterBook=".antiSql($_GET['filterBook']) : "");

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
          <form action="'.$ROOT.'pages/rate-list.php" method="GET">
            <div class="col-12 my-blue d-flex justify-content-center">
                <span class="me-3 align-items-center d-flex">Szűrés:</span>
                <input type="text" name="filterUser" id="filterUser" placeholder="Felhasználónév..." class="ps-2 me-3 rounded">
                <input type="text" name="filterBook" id="filterBook" placeholder="Könyv cím..." class="ps-2 me-3 rounded">
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
    for ($i=1; $i<=$ratesPage;$i++){
      $pagelink=$ROOT.'pages/rate-list.php?page='.$i . (isset($_GET['filterUser']) ? "&filterUser=".$_GET['filterUser'] : "").(isset($_GET['filterBook']) ? "&filterBook=".$_GET['filterBook'] : "");
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
        <tr class="table-light"><th>#</th><th>Id</th><th>Felhasználó</th><th>Könyv</th><th>Értékelés</th><th>Módosítás</th></tr>
    </thead>
    <tbody>';
    $j=1;
    foreach($ratesInfo as $r) {
      $kedvContent .='<tr><td>'.$j.'</td><td>'.$r['id'].'</td><td>'.$r['nev'].'</td><td>'.$r['cim'].'</td><td>'.$r['ertekeles'].'</td><td><a href="'.$ROOT.'handlers/delete_handler.php?deleteRate='.$r['id'].'" class="btn btn-outline-danger">Törlés</a></td></tr>';
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
    for ($i=1; $i<=$ratesPage;$i++){
      $pagelink=$ROOT.'pages/rate-list.php?page='.$i . (isset($_GET['filterUser']) ? "&filterUser=".$_GET['filterUser'] : "").(isset($_GET['filterBook']) ? "&filterBook=".$_GET['filterBook'] : "");
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
$kedvContainer = $homePage->createContainer($kedvContent,"Értékelések", "bi-person-lines-fill");
//---


//---
unsetMessages();

//Tartalom öszefűzése
$allContent = $kedvContainer;

//Oldal megjelenítése
echo $homePage->genFramedPage($allContent);

;