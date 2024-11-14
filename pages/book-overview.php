<?php
//DATABase
$bookName = "Narnia 2.";
//
$ROOT = "../";
require_once($ROOT . "generate.php");
include_once($ROOT . "components/book_mini.php");
include_once($ROOT . "components/rating.php");

$bookPage = new Generate();
$bookPage->root = $ROOT;
$bookPage->name = "Könyv: " . $bookName;

//----------------------
//      Tartalom
//----------------------

//Könyv áttekintő
//include_once($ROOT . "components/book_detail2.php");
//$detailContent = $bd_element;
//Legnépszerűbb könyvek
$nKonyvekContent = "<div class=\"row\">
    " . book_mini(1, $ROOT) . "
</div>";
$id = 0;
$detailContainer =
    '
     <div class="container-fluid container-lg mb-4">
        <div class="container-fluid pe-2">
            <div class="row ">
                <div class="col-12 col-md-9 d-flex mb-3 mb-md-0">
                    <div class="pm-md-2 d-flex">
                        <div class="row p-2 bg-white rounded-20 me-md-1 ">
                            
                            <div class="col-12 p-2"><p><span class="block-icon-circle bg-my-white-blue rounded-circle d-inline-block text-center me-2"><i class="w-100 text-center bi bi-grid my-blue"></i></span><span class="fw-bold my-blue fs-5">Áttekintés</span></p></div>
                            <div class="col-12 d-md-none"><p class="fw-bold mb-2 fs-5 my-gray-3">Narnia 2. - Az oroszlán, a boszorkány és a ruhásszekrény - Illusztrált kiadás</p></div>
                                    
                            <div class="col-6 col-md-3 order-1 order-md-1 mx-auto">
                                <img class="w-100 rounded-20" src="https://s01.static.libri.hu/cover/f9/b/4841405_4.jpg" alt="">
                            </div>
                            <div class="col-12 col-md-9  order-3 order-md-2">
                                <div class="row">
                                    <div class="col-12 d-none d-md-block"><p class="fw-bold mb-2 fs-5 my-gray-3">Narnia 2. - Az oroszlán, a boszorkány és a ruhásszekrény - Illusztrált kiadás</p></div>
                                    <div class="col-12">
                                            <p class="font-roboto fs-5 my-gray-3 my-2">Narnia egy jéggé dermesztett ország, ahol sohasem jár a Mikulás és nem létezik a karácsony. A négy testvér - Peter, Susan, Edmund és Lucy - egy vidéki kastélyban álló ruhásszekrényen keresztül lép be a birodalomba, hogy felvegye a harcot a Fehér Boszorkánnyal és csatlósaival. A hó is olvadásnak indul, hiszen Aslan, a Nagy Oroszlán egyre közeledik...</p>
                                    </div>
                                    <div class="col-12 p-3">
                                        <span class="my-blue"><i class="bi bi-grid me-2"></i>Kategóriák:</span>
                                        
                                        <label class="category-frame rounded-10 py-0 px-2 py-0 c-pointer me-1">
                                            <span class="reveal d-flex align-items-center">Krimi<span class="badge bg-my-light-blue ms-1 lost">1574</span></span>
                                        </label>
                                        <label class="category-frame rounded-10 py-0 px-2 py-0 c-pointer me-1">
                                            <span class="reveal d-flex align-items-center">Akció<span class="badge bg-my-light-blue ms-1 lost">186</span></span>
                                        </label>
                                        <label class="category-frame rounded-10 py-0 px-2 py-0 c-pointer me-1">
                                            <span class="reveal d-flex align-items-center">Kaland<span class="badge bg-my-light-blue ms-1 lost">14</span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                                    
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 ">
                    
                        <div class="row">
                            <div class="bg-white rounded-20 p-2 p-md-4 border w-100 mb-2">
                                <h5 class="my-blue text-center mb-3"><span class="block-icon-circle bg-my-white-blue rounded-circle d-inline-block text-center me-2"><i class="bi bi-vector-pen"></i></span>Író</h5>
                                    <div class="mx-1 mx-md-3 rounded rounded-circle p-1 bg-white shadow circle-avatar overflow-hidden mb-3 ">
                                        <a href="'.$ROOT.'pages/author-overview.php?id='.$id.'"><img src="https://totallyhistory.com/wp-content/uploads/2013/07/CS-Lewis.jpg" alt="" class="rounded-circle"></a>
                                    </div>
                                    <p class="text-center"><a href="'.$ROOT.'pages/author-overview.php?id='.$id.'">C. S. Lewis</a></p>
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

$velemenyekContent = '
<div class="row">
    
    <div class="col-12">
        <div class="py-1 px-3">
            <div class="pb-4 p-3 rounded border-bottom border-2">
                <div class="row">
                    <div class="col-3 col-md-2 col-lg-1" >
                        <div class="circle-avatar">
                            <img class="border rounded-circle avatar-img" src="https://divineyouwellness.com/wp-content/uploads/2021/11/signs-of-an-Inteligent-person.jpg" alt=""/>
                        </div>
                    </div>
                    <div class="col-9 col-md-10 col-lg-11" >
                        <div class="row">
                            <div class="col-12 mb-2"><span class="my-blue fw-bold">Anna</span> - 2024.04.11.</div>
                            <div class="col-12 font-roboto fs-5">Totális kedvenc ez a könyv. Minden percét elveztem. A film igazán eltörpül mellette. A karakterek kidolgozottsága és az a sok apró részlet. Ajánlom mindenkinek!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="py-1 px-3">
            <div class="pb-4 p-3 rounded border-bottom border-2">
                <div class="row">
                    <div class="col-3 col-md-2 col-lg-1" >
                        <div class="circle-avatar">
                            <img class="border rounded-circle avatar-img" src="https://static1.colliderimages.com/wordpress/wp-content/uploads/2024/10/why-gandalf-needs-a-staff-in-the-lord-of-the-rings.jpg" alt=""/>
                        </div>
                    </div>
                    <div class="col-9 col-md-10 col-lg-11" >
                        <div class="row">
                            <div class="col-12 mb-2"><span class="my-blue fw-bold">Varázsló</span> - 2024.02.01.</div>
                            <div class="col-12 font-roboto fs-5">Totális kedvenc ez a könyv. Minden percét elveztem. A film igazán eltörpül mellette. A karakterek kidolgozottsága és az a sok apró részlet. Ajánlom mindenkinek!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
$velemenyGomb = "<button class='btn float-end shadow-sm py-1 px-3 my-blue d-flex justify-content-around align-items-center bg-my-white-blue rounded'><i class='bi bi-plus-square-dotted me-2'></i>vélemény írása</button>";
$detailContainer .= $bookPage->createContainer($nKonyvekContent, "Hasonló könyvek", "bi-book");
$detailContainer .= $bookPage->createContainer($velemenyekContent, "Vélemények".$velemenyGomb, "bi-chat-left-text");
echo $bookPage->genFramedPage($detailContainer);
