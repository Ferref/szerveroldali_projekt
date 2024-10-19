<?php
//DATABase
$authorName = "C. S. Lewis";
//
$ROOT = "../";
require_once($ROOT . "generate.php");
include_once($ROOT . "components/book_mini.php");
include_once($ROOT . "components/rating.php");

$bookPage = new Generate();
$bookPage->root = $ROOT;
$bookPage->name = "Író: " . $authorName;

//----------------------
//      Tartalom
//----------------------

//Az alkotó könyvei könyvek
$konyveiContent = "<div class=\"row\">
    ".book_mini(1, $ROOT).book_mini(1, $ROOT).book_mini(1, $ROOT).book_mini(1, $ROOT).book_mini(1, $ROOT)."
</div>";

//Alkotó
$detailContainer =
    '
     <div class="container-fluid container-lg mb-4">
        <div class="container-fluid pe-2">
            <div class="row ">
                
                <div class="col-12 col-md-3 mb-3 mb-md-0">
                    
                        <div class="row">
                            <div class="bg-white rounded-20 p-4 p-md-4 border w-100 mb-2">
                                <h5 class="my-blue text-center mb-3"><i class="bi bi-vector-pen me-2"></i>Író</h5>
                                    <div class="mx-5 mx-md-3 rounded rounded-circle p-1 bg-white shadow circle-avatar overflow-hidden mb-3 ">
                                        <img src="https://totallyhistory.com/wp-content/uploads/2013/07/CS-Lewis.jpg" alt="" class="rounded-circle">
                                    </div>
                                    <p class="text-center">C. S. Lewis</p>
                                    <hr class="my-3">
                                    <p><span class="my-blue">Született:</span> <span class="float-end">1898.11.29.</span></p>
                                    <p><span class="my-blue">Elhunyt:</span> <span class="float-end">1963.11.22.</span></p>
                                    <p><span class="my-blue">Származása:</span> <span class="float-end">Britt</span></p>
                                    <hr class="my-3">
                                    <p><span class="my-blue">Kategóriák</span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="bg-white rounded-20 p-2 p-md-4 border w-100 mt-2">
                            ' . rating(4.5) . '
                             X könyv Y értékelése alapján.
                            </div>
                        </div>
                   
                </div>
                <div class="col-12 col-md-9 d-flex">
                    <div class="pm-md-2 d-flex w-100">
                        <div class="row p-2 bg-white rounded-20 ms-md-1" style="align-content: start;">
                            
                            <div class="col-12 p-2"><p><span class="block-icon-circle bg-my-white-blue rounded-circle d-inline-block text-center me-2"><i class="w-100 text-center bi bi-grid my-blue"></i></span><span class="fw-bold my-blue fs-5">Könyvei</span><span class="ms-2">(x)</span></p></div>
                            <div class="col-12">
                            '.$konyveiContent.'
                            </div>
                            
                                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
echo $bookPage->genFramedPage($detailContainer);
