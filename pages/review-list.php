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
$homePage->name = "Vélemény lista"; //title attributum értéke
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

$reviews=new ReviewView();

if(isset($_GET['filterName']) && isset($_GET['filterBook'])){

  if($_GET['filterName']=="" && $_GET['filterBook']=="") {
    redirect($ROOT.'pages/review-list.php?page='.$page);
  }

  if($_GET['filterName']!="" && $_GET['filterBook']=="") {
    $reviewsInfo=$reviews->showReviewInfoName(antiSql($_GET['filterName']),$page_1);
    $reviewsPage=$reviews->showReviewInfoNamePageNumber(antiSql($_GET['filterName']));
    $talalatok=$reviewsPage['oldalak_szama'];
    $reviewsPage=ceil(($reviewsPage['oldalak_szama'])/10);
  }
  
  if($_GET['filterName']=="" && $_GET['filterBook']!="") {
    $reviewsInfo=$reviews->showReviewInfoBook(antiSql($_GET['filterBook']),$page_1);
    $reviewsPage=$reviews->showReviewInfoBookPageNumber(antiSql($_GET['filterBook']));
    $talalatok=$reviewsPage['oldalak_szama'];
    $reviewsPage=ceil(($reviewsPage['oldalak_szama'])/10);
  }
  
  if($_GET['filterName']!="" && $_GET['filterBook']!="") {
    $reviewsInfo=$reviews->showReviewInfoNameBook(antiSql($_GET['filterName']),antiSql($_GET['filterBook']),$page_1);
    $reviewsPage=$reviews->showReviewInfoNameBookPageNumber(antiSql($_GET['filterName']),antiSql($_GET['filterBook']));
    $talalatok=$reviewsPage['oldalak_szama'];
    $reviewsPage=ceil(($reviewsPage['oldalak_szama'])/10);
  }


}


if(!isset($_GET['filterName']) && !isset($_GET['filterBook'])) {
  $reviewsInfo=$reviews->showAllReviewInfo($page_1);
  $reviewsPage=$reviews->showAllReviewInfoPageNumber();
  $talalatok=$reviewsPage['oldalak_szama'];
  $reviewsPage=ceil(($reviewsPage['oldalak_szama'])/10);
}

$hrefBack=($_GET["page"]==1 ? "#" : $ROOT.'pages/review-list.php'."?page=".$_GET['page']-1) . (isset($_GET['filterName']) ? "&filterName=".antiSql($_GET['filterName']) : "").(isset($_GET['filterBook']) ? "&filterBook=".antiSql($_GET['filterBook']) : "");
$hrefForward=(($reviewsPage<=1 || $_GET["page"]==$reviewsPage) ? "#" : $ROOT.'pages/review-list.php'."?page=".$_GET['page']+1) . (isset($_GET['filterName']) ? "&filterName=".antiSql($_GET['filterName']) : "").(isset($_GET['filterBook']) ? "&filterBook=".antiSql($_GET['filterBook']) : "");

$_SESSION["rememberPage"]=$ROOT.'pages/review-list.php?page='.$page . (isset($_GET['filterName']) ? "&filterName=".antiSql($_GET['filterName']) : "").(isset($_GET['filterBook']) ? "&filterBook=".antiSql($_GET['filterBook']) : "");

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
          <form action="'.$ROOT.'pages/review-list.php" method="GET">
            <div class="col-12 my-blue d-flex justify-content-center">
                <span class="me-3 align-items-center d-flex">Szűrés:</span>
                <input type="text" name="filterName" id="filterName" placeholder="Felhasználónév..." class="ps-2 me-3 rounded">
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
    for ($i=1; $i<=$reviewsPage;$i++){
      $pagelink=$ROOT.'pages/review-list.php?page='.$i . (isset($_GET['filterName']) ? "&filterName=".$_GET['filterName'] : "").(isset($_GET['filterBook']) ? "&filterBook=".$_GET['filterBook'] : "");
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
        <tr class="table-light"><th>#</th><th>Id</th><th>Vélemények</th><th>Könyv</th><th>Dátum</th><th>Módosítás</th></tr>
    </thead>
    <tbody>';
    $j=1;
    foreach($reviewsInfo as $r) {
      $kedvContent .='<tr><td>'.$j.'</td><td>'.$r['id'].'</td><td>'.$r['nev'].'</td><td>'.$r['cim'].'</td><td>'.$r['datum'].'</td><td><a href="review-manage.php?id='.$r['id'].'" class="btn btn-outline-primary me-2">Szerk</a><a href="'.$ROOT.'handlers/delete_handler.php?deleteReview='.$r['id'].'" class="btn btn-outline-danger">Törlés</a></td></tr>';
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
    for ($i=1; $i<=$reviewsPage;$i++){
      $pagelink=$ROOT.'pages/review-list.php?page='.$i . (isset($_GET['filterName']) ? "&filterName=".$_GET['filterName'] : "").(isset($_GET['filterBook']) ? "&filterBook=".$_GET['filterBook'] : "");
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
$kedvContainer = $homePage->createContainer($kedvContent,"Vélemények", "bi-person-lines-fill");
//---


//---
unsetMessages();

//Tartalom öszefűzése
$allContent = $kedvContainer;

//Oldal megjelenítése
echo $homePage->genFramedPage($allContent);

;