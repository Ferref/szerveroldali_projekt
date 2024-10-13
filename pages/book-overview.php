<?php
//DATABase
$bookName = "Narnia 2.";
//
$ROOT = "../";
require_once($ROOT . "generate.php");
include_once($ROOT . "components/book_mini.php");

$bookPage = new Generate();
$bookPage->root = $ROOT;
$bookPage->name = "Könyv: " . $bookName;

//----------------------
//      Tartalom
//----------------------

//Könyv áttekintő
include_once($ROOT . "components/book_detail2.php");
$detailContent = $bd_element;
//Legnépszerűbb könyvek
$nKonyvekContent = "<div class=\"row\">
    " . book_mini(1, $ROOT) . "
</div>";
$detailContainer =
    '
     <div class="container-fluid container-lg mb-4">
        <div class="container-fluid pe-2">
            <div class="row ">
                <div class="col-12 col-md-9 d-flex">
                    <div class="pm-md-2 d-flex">
                        <div class="row p-2 bg-white rounded-20 me-md-1">
                            
                            <div class="col-12 p-2"><p><span class="block-icon-circle bg-my-white-blue rounded-circle d-inline-block text-center me-2"><i class="w-100 text-center bi bi-grid my-blue"></i></span><span class="fw-bold my-blue fs-5">Áttekintés</span></p></div>
                        
                            <div class="col-4 col-md-3 order-1 order-md-1">
                                <img class="w-100 rounded-20" src="https://s01.static.libri.hu/cover/f9/b/4841405_4.jpg" alt="">
                            </div>
                            <div class="col-12 col-md-9  order-3 order-md-2">
                                <div class="row">
                                    <div class="col-12 d-none d-md-block"><p class="fw-bold mb-2 fs-5 my-gray-3">Narnia 2. - Az oroszlán, a boszorkány és a ruhásszekrény - Illusztrált kiadás</p></div>
                                    <div class="col-12">
                                            <p class="font-roboto fs-5 my-gray-3 my-2">Narnia egy jéggé dermesztett ország, ahol sohasem jár a Mikulás és nem létezik a karácsony. A négy testvér - Peter, Susan, Edmund és Lucy - egy vidéki kastélyban álló ruhásszekrényen keresztül lép be a birodalomba, hogy felvegye a harcot a Fehér Boszorkánnyal és csatlósaival. A hó is olvadásnak indul, hiszen Aslan, a Nagy Oroszlán egyre közeledik...</p>
                                    </div>
                                    <div class="col-12 p-3">
                                        <span class="my-blue"><i class="bi bi-grid me-2"></i>Kategóriák:</span> <span class="badge rounded-pill bg-my-light-blue fw-normal ms-1 py-2">Fantasy</span><span class="badge rounded-pill bg-my-light-blue fw-normal ms-1 py-2">Akció</span><span class="badge rounded-pill bg-my-light-blue fw-normal ms-1 py-2">Kaland</span>
                                    </div>
                                </div>
                            </div>
                                    
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 ">
                    
                        <div class="row">
                            <div class="bg-white rounded-20 p-2 p-md-4 border w-100 mb-2">
                                <h5 class="my-blue text-center mb-3"><i class="bi bi-vector-pen me-2"></i>Író</h5>
                                    <div class="mx-1 mx-md-3 rounded rounded-circle p-1 bg-white shadow circle-avatar overflow-hidden mb-3 ">
                                        <img src="https://totallyhistory.com/wp-content/uploads/2013/07/CS-Lewis.jpg" alt="" class="rounded-circle">
                                    </div>
                                    <p class="text-center">C. S. Lewis</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="bg-white rounded-20 p-2 p-md-4 border w-100 mt-2">
                            ' . rating(4.5) . '
                            </div>
                        </div>
                   
                </div>
            </div>
        </div>
    </div>';

$detailContainer .= $bookPage->createContainer($nKonyvekContent, "Hasonló könyvek", "bi-book");
$detailContainer .= $bookPage->createContainer("", "Vélemények", "bi-chat-left-text");
echo $bookPage->genFramedPage($detailContainer);
