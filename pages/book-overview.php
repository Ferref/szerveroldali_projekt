<?php
//DATABase
$bookName = "Narnia 2.";
//
$ROOT = "../";
require_once($ROOT."generate.php");

$bookPage = new Generate();
$bookPage->root = $ROOT;
$bookPage->name = "Könyv: ".$bookName;

//----------------------
//      Tartalom
//----------------------

//Könyv áttekintő
include_once($ROOT."components/book_detail.php");
$detailContent = $bd_element;
$detailContainer = $bookPage->createContainer($detailContent,"Könyv Áttekintő", "bi-collection");
echo $bookPage->genFramedPage($detailContainer);
?>