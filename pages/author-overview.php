<?php
if (!isset($_GET['id'])) {
    header("Location: ../");
}
//
$ROOT = "../";
require_once($ROOT . "generate.php");
include_once($ROOT . "components/book_mini.php");
include_once($ROOT . "components/rating.php");

$iro=new AuthorView();
$iroInfo=$iro->showAuthorInfo($_GET['id']);
$iroKonyvek=$iro->showAuthorBooks($_GET['id']);
$ertekeles=$iro->showAuthorBooksAvgRating($_GET['id']);
$kategoriak=$iro->showWriterCategories($_GET['id']);

$bookPage = new Generate();
$bookPage->root = $ROOT;
$bookPage->name = "Író: " . $iroInfo['nev'];

//----------------------
//      Tartalom
//----------------------

//Az alkotó könyvei könyvek
$konyveiContent = "<div class=\"row\">
    ";
    foreach($iroKonyvek as $konyv) {
        $konyveiContent.=book_mini($konyv, $ROOT);
    }
$konyveiContent .="</div>";

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
                                        <img src="'.$iroInfo['profilkep_url'].'" alt="" class="rounded-circle">
                                    </div>
                                    <p class="text-center">'.$iroInfo['nev'].'</p>
                                    <hr class="my-3">
                                    <p><span class="my-blue">Született:</span> <span class="float-end">'.$iroInfo['szuletesi_ido'].'</span></p>';

                                    $detailContainer .=$iroInfo['halal_ido']=="" ? '' : '<p><span class="my-blue">Elhunyt:</span> <span class="float-end">'.$iroInfo['halal_ido'].'</span></p>';                
$detailContainer .=                 '<p><span class="my-blue">Származása:</span> <span class="float-end">'.$iroInfo['szarmazas'].'</span></p>
                                    <hr class="my-3">
                                    <p><span class="my-blue">Kategóriák</span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="bg-white rounded-20 p-2 p-md-4 border w-100 mt-2">
                            ' . rating($ertekeles) . '
                             '.count($iroKonyvek).' könyv '.$ertekeles['ertekelesek_szama'].' értékelése alapján.
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
