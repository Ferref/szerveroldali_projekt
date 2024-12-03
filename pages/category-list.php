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
$homePage->name = "Kategória lista"; //title attributum értéke
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

$kategoriak=new CategoryView();

if(isset($_GET['filterName']) && $_GET['filterName']=="") {
    redirect($ROOT.'pages/category-list.php?page='.$page);
}

if(isset($_GET['filterName']) && $_GET['filterName']!=""){

    $kategoriakInfo=$kategoriak->showCategoryInfoName(antiSql($_GET['filterName']),$page_1);
    $kategoriakPage=$kategoriak->showCategoryInfoNamePageNumber(antiSql($_GET['filterName']));
    $talalatok=$kategoriakPage['oldalak_szama'];
    $kategoriakPage=ceil(($kategoriakPage['oldalak_szama'])/10);
}



if(!isset($_GET['filterName']) && !isset($_GET['filterEmail'])) {
  $kategoriakInfo=$kategoriak->showAllCategoryInfo($page_1);
  $kategoriakPage=$kategoriak->showAllCategoryInfoPageNumber();
  $talalatok=$kategoriakPage['oldalak_szama'];
  $kategoriakPage=ceil(($kategoriakPage['oldalak_szama'])/10);
}

$hrefBack=($_GET["page"]==1 ? "#" : $ROOT.'pages/category-list.php'."?page=".$_GET['page']-1) . (isset($_GET['filterName']) ? "&filterName=".antiSql($_GET['filterName']) : "");
$hrefForward=(($kategoriakPage<=1 || $_GET["page"]==$kategoriakPage) ? "#" : $ROOT.'pages/category-list.php'."?page=".$_GET['page']+1) . (isset($_GET['filterName']) ? "&filterName=".antiSql($_GET['filterName']) : "");

$_SESSION["rememberPage"]=$ROOT.'pages/category-list.php?page='.$page . (isset($_GET['filterName']) ? "&filterName=".antiSql($_GET['filterName']) : "");

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
          <form action="'.$ROOT.'pages/category-list.php" method="GET">
            <div class="col-12 my-blue d-flex justify-content-center">
                <span class="me-3 align-items-center d-flex">Szűrés:</span>
                <input type="text" name="filterName" id="filterName" placeholder="Kategórianév..." class="ps-2 me-3 rounded">
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
    for ($i=1; $i<=$kategoriakPage;$i++){
      $pagelink=$ROOT.'pages/category-list.php?page='.$i . (isset($_GET['filterName']) ? "&filterName=".antiSql($_GET['filterName']) : "");
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
$kedvContent .= '<div class="mb-4"><a href="'.$ROOT.'pages/category-manage.php" class="btn btn-outline-primary me-2">Új kategória hozzáadása</a></div>';
$kedvContent .='<table class="table table-striped table-hover table-primary ">
    <thead>
        <tr class="table-light"><th>#</th><th>Id</th><th>Név</th><th>Módosítás</th></tr>
    </thead>
    <tbody>';
    $j=1;
    foreach($kategoriakInfo as $k) {
      $kedvContent .='<tr><td>'.$j.'</td><td>'.$k['id'].'</td><td>'.$k['nev'].'</td><td><a href="category-manage.php?id='.$k['id'].'" class="btn btn-outline-primary me-2">Szerk</a><a href="'.$ROOT.'handlers/delete_handler.php?deleteCategory='.$k['id'].'" class="btn btn-outline-danger">Törlés</a></td></tr>';
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
    for ($i=1; $i<=$kategoriakPage;$i++){
        $pagelink=$ROOT.'pages/category-list.php?page='.$i . (isset($_GET['filterName']) ? "&filterName=".antiSql($_GET['filterName']) : "");
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
$kedvContainer = $homePage->createContainer($kedvContent,"Kategóriák", "bi-person-lines-fill");
//---


//---
unsetMessages();

//Tartalom öszefűzése
$allContent = $kedvContainer;

//Oldal megjelenítése
echo $homePage->genFramedPage($allContent);

;