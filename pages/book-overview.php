<?php
$ROOT = "../";
require_once($ROOT."generate.php");

$testPage = new Generate();
$testPage->root = $ROOT;
$testPage->name = "Könyv Áttekintő";
$content = "Ez egy teszt oldal!";
$container = $testPage->createContainer($content,"Könyv Áttekintő", "bi-collection");
echo $testPage->genFramedPage($container);
?>