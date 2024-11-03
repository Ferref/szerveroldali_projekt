<?php
    //
    // Az $rt_element változón keresztül éri el a komponens tartalmát a hivatkozó elem.
    //
    include_once($ROOT . "components/rating.php");
    $randomBook=new BookView();
    $bookInfo=$randomBook->showRandomBook();
    $randomBookCategories=new CategoryView();
    $kategoriak=$randomBookCategories->showBookCategories($bookInfo["id"]);
    $ertekeles=$randomBook->showBookRating($bookInfo["id"]);
    function kategoria($kategoriak) {
        while ($row=$kategoriak->fetch(PDO::FETCH_ASSOC)){
            echo "<span class=\"badge rounded-pill bg-my-light-blue fw-normal ms-1 py-2\">{$row["nev"]}</span>";
        }
    };

    $id = 1;
    $rt_element =  '
    <div class="col-12 d-block d-md-none"><p class="fw-bold mb-3 fs-5 my-gray-3">'.$bookInfo["cim"].'</p></div>
            <div class="row p-2">
                <div class="col-6 col-md-2 order-1 order-md-1">
                    <img class="w-100 rounded-20" src="'.$bookInfo["boritokep_url"].'" alt="">
                </div>
                <div class="col-12 col-md-8  order-3 order-md-2">
                    <div class="row">
                        <div class="col-12 d-none d-md-block"><p class="fw-bold mb-2 fs-5 my-gray-3">'.$bookInfo["cim"].'</p></div>
                        <div class="col-12">
                            <p class="font-roboto fs-5 my-gray-3 my-2">'.$bookInfo["leiras"].'</p>
                        </div>
                        <div class="col-12 p-3"><span class="my-blue fw-bold">Kategóriák:</span><span class="badge rounded-pill bg-my-light-blue fw-normal ms-1 py-2">Fantasy</span></div>
                    </div>
                </div>
                <div class="col-6 col-md-2 order-2 order-md-3 d-flex flex-column align-items-center justify-content-center text-center">
                    <p>
                        '.rating($ertekeles).'
                        
                    </p>
                    <ul class="nav flex-column d-none d-md-block w-100">
                        <li><a class="nav-link shadow-sm py-1 px-2 my-2 d-flex c-pointer my-blue justify-content-around align-items-center bg-my-white-blue rounded"  data-bs-toggle="modal" data-bs-target="#ment"><i class="bi bi-bookmark me-2"></i>Mentés</a></li>
                        <li><a class="nav-link shadow-sm py-1 px-2 my-2 d-flex c-pointer my-blue justify-content-around align-items-center bg-my-white-blue rounded"><i class="bi bi-heart me-2"></i>Kedvenc</a></li>
                        <li><a href="'.$ROOT.'pages/book-overview.php?id='.$bookInfo["id"].'" class="nav-link shadow-sm py-1 px-2 my-2 d-flex c-pointer my-blue justify-content-around align-items-center bg-my-white-blue rounded"><i class="bi bi-arrow-right me-2"></i>Tovább</a></li>
                    </ul>
                </div>
                <div class="col-12 order-4 d-md-none d-flex flex-column align-items-center justify-content-center text-center p-0">
                    
                    <ul class="row nav w-100 m-0">
                        <li class="col-6"><a class="nav-link shadow-sm py-1 px-2 my-2 d-bock c-pointer my-blue align-items-center bg-my-white-blue rounded"  data-bs-toggle="modal" data-bs-target="#ment" ><i class="bi bi-bookmark me-2"></i>Mentés</a></li>
                        <li class="col-6"><a class="nav-link shadow-sm py-1 px-2 my-2 d-bock c-pointer my-blue align-items-center bg-my-white-blue rounded"><i class="bi bi-heart me-2"></i>Kedvenc</a></li>
                    </ul>
                    <ul class="row nav w-100 m-0">
                        <li class="col-12"><a href="'.$ROOT.'pages/book-overview.php?id='.$bookInfo["id"].'" class="nav-link shadow-sm py-1 px-2 my-2 d-bock c-pointer my-blue text-center align-items-center bg-my-white-blue rounded"><i class="bi bi-arrow-right me-2"></i>Tovább</a></li>
                    </ul>
                </div>

                <!--Modal-->
                <div class="modal fade" id="ment">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title my-blue text-center flex-fill justify-content-center" id="staticBackdropLabel"><i class="bi bi-bookmark me-2"></i>Mentés</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="row nav w-100 m-0">
                            <li class="col-12 col-md-6"><a class="nav-link shadow-sm py-2  px-2 my-2 d-bock c-pointer my-blue align-items-center bg-my-white-blue rounded"><i class="bi bi-journal-check me-2"></i>Olvastam</a></li>
                            <li class="col-12 col-md-6"><a class="nav-link shadow-sm py-2  px-2 my-2 d-bock c-pointer my-blue align-items-center bg-my-white-blue rounded"><i class="bi bi-journal-bookmark-fill me-2"></i>Várólista</a></li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
            </div>
   ';
   /*<span class="my-blue">Értékelés:</span><br><span class="my-light-blue">3.5/5</span><br>
   <span class="d-block"><i class="my-star-yellow bi bi-star-fill"></i><i class="my-star-yellow bi bi-star-fill"></i><i class="my-star-yellow bi bi-star-fill"></i><i class="my-star-yellow bi bi-star-half"></i><i class="my-star-yellow bi bi-star"></i></span><br>
*/
?>