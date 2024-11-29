<?php

if (!isset($_GET['id'])) {
    header("Location: ../");
}
//
$ROOT = "../";
require_once($ROOT . "generate.php");
include_once($ROOT . "components/book_mini.php");
include_once($ROOT . "components/rating.php");

$konyvController=new BookController();

if(!$konyvController->getIsBookExist($_GET['id'])) {
    redirect($ROOT);
}

$_SESSION['rememberPage']=$ROOT.'pages/book-overview.php?id='.$_GET['id'];

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['velemenyKuldese']) && $_POST['velemenyKuldese']!="" && isset($_GET['id']) && isset($_SESSION['user'])) {
    
    $reviewController=new ReviewController();

    try {
        if(!($reviewController->addBookReview($_SESSION['user']['id'], antiSql($_GET['id']), antiSql($_POST['commentText'])))) {
            throw new HibaException();
        }
        $_SESSION['message']="A vélemény hozzáadása sikeres!";

    }catch (HibaException $e) {
        $_SESSION['error']=nl2br("A vélemény hozzáadása nem sikerült! \n").$e->getMessage();
    }

}

$konyv=new BookView();
$konyvInfo=$konyv->showBookInfo($_GET['id']);
$szerzok=new AuthorView();
$kategoriak=new CategoryView();
$velemenyek=new ReviewView();
$konyvKategoriak=$kategoriak->showBookCategories($konyvInfo["id"]);
$konyvSzerzok=$szerzok->showBookAuthors($_GET['id']);
$ertekeles=$konyv->showBookRating($konyvInfo["id"]);
$konyvVelemenyek=$velemenyek->showBookReviews($konyvInfo["id"]);
$userController=new UserController();

$bookPage = new Generate();
$bookPage->root = $ROOT;
$bookPage->name = "Könyv: " . $konyvInfo['cim'];

//----------------------
//      Tartalom
//----------------------

//Könyv áttekintő
//include_once($ROOT . "components/book_detail2.php");
//$detailContent = $bd_element;
//Legnépszerűbb könyvek
$nKonyvekContent = "<div class=\"row\">
    " . book_mini($konyvInfo, $ROOT) . "
</div>";

$detailContainer =
    '
     <div class="container-fluid container-lg mb-4">
        <div class="container-fluid pe-2">
            <div class="row ">
                <div class="col-12 col-md-9 d-flex mb-3 mb-md-0">
                    <div class="pm-md-2 d-flex">
                        <div class="row p-2 bg-white rounded-20 me-md-1 ">
                            
                            <div class="col-12 p-2"><p><span class="block-icon-circle bg-my-white-blue rounded-circle d-inline-block text-center me-2"><i class="w-100 text-center bi bi-grid my-blue"></i></span><span class="fw-bold my-blue fs-5">Áttekintés</span></p></div>
                            <div class="col-12 d-md-none"><p class="fw-bold mb-2 fs-5 my-gray-3">'.$konyvInfo['cim'].'</p></div>
                                    
                            <div class="col-6 col-md-3 order-1 order-md-1 mx-auto">
                                <img class="w-100 rounded-20" src="'.$konyvInfo['boritokep_url'].'" alt="">
                            </div>
                            <div class="col-12 col-md-9  order-3 order-md-2">
                                <div class="row">
                                    <div class="col-12 d-none d-md-block"><p class="fw-bold mb-2 fs-5 my-gray-3">'.$konyvInfo['cim'].'</p></div>
                                    <div class="col-12">
                                            <p class="font-roboto fs-5 my-gray-3 my-2">'.$konyvInfo['leiras'].'</p>
                                    </div>
                                    <div class="col-12 p-3">
                                        <span class="my-blue"><i class="bi bi-grid me-2"></i>Kategóriák: </span>';

                                        foreach ($konyvKategoriak as $k) {
                                            $detailContainer .= '<label class="category-frame rounded-10 py-0 px-2 py-0 c-pointer me-1">
                                                <a href="'.$ROOT.'pages/search.php?categoryId='.$k['id'].'" style="color: inherit;">
                                                <span class="reveal d-flex align-items-center">'.$k['nev'].'<span class="badge bg-my-light-blue ms-1 lost">'.$kategoriak->showSpecificCategoryNumber($k['id']).'</span></span></a>
                                            </label>';
                                        }
$detailContainer .=                 '</div>
                                </div>
                            </div>
                                    
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 ">
                    
                        <div class="row">
                            <div class="bg-white rounded-20 p-2 p-md-4 border w-100 mb-2 text-center">
                                <h5 class="my-blue text-center mb-3"><span class="block-icon-circle bg-my-white-blue rounded-circle d-inline-block text-center me-2"><i class="bi bi-vector-pen"></i></span>Író</h5>';
                                foreach($konyvSzerzok as $sz) {
                                    $detailContainer .= '<label class="category-frame rounded-10 py-1 ps-3 pe-2 c-pointer me-2 mb-3" for="kat'.$sz['id'].'">
                                    <a href="'.$ROOT.'pages/author-overview.php?id='.$sz['id'].'" id="kat'.$sz['id'].'" style="color: inherit;">
                                    <span>'.$sz["nev"].'<span class="badge bg-my-light-blue ms-1">'.$szerzok->showSpecificWriterBookNumber($sz['id']).'</span></span></a>
                                </label>';
                                }
        $detailContainer .='</div>
                        </div>
                        <div class="row">
                            <div class="bg-white rounded-20 p-2 p-md-4 border w-100 mt-2">
                            ' . rating($ertekeles, $_GET['id']) . '
                                <ul class="nav flex-column d-none d-md-block w-100">
                                    <li><a class="nav-link shadow-sm py-1 px-2 my-2 d-flex c-pointer my-blue justify-content-around align-items-center bg-my-white-blue rounded"  data-bs-toggle="modal" data-bs-target="#'.(!isset($_SESSION['user']) ? 'bejelentkezes' : "ment").'">';
                                        if(!isset($_SESSION['user'])) {
                                                            
                                            $detailContainer .='<button type="button" class="nav-link shadow-sm py-2  px-2 my-2 d-bock c-pointer my-blue align-items-center bg-my-white-blue rounded  w-50" data-bs-dismiss="modal" aria-label="Close"><i class="me-2"></i>Értem</button>';
                                        }
                                        else {
                                            if($userController->getIsBookRead($_SESSION['user']['id'], $konyvInfo["id"])) {
                                                $detailContainer .='<i class="bi bi-bookmark-fill me-2"></i>Olvastam</a></li>';
                                            } else if($userController->getIsBookWaited($_SESSION['user']['id'], $konyvInfo["id"])) {
                                                $detailContainer .='<i class="bi bi-bookmark-fill me-2"></i>Várólistás</a></li>';
                                            } else {
                                                $detailContainer .='<i class="bi bi-bookmark me-2"></i>Mentés</a></li>';
                                            }
                                        }
                     $detailContainer .='<li><a '.(!isset($_SESSION['user']) ? "" : 'href='.$ROOT.'handlers/review_handler.php?id='.$_GET['id'].'').' class="nav-link shadow-sm py-1 px-2 my-2 d-flex c-pointer my-blue justify-content-around align-items-center bg-my-white-blue rounded" '.(!isset($_SESSION['user']) ? 'data-bs-toggle="modal" data-bs-target="#bejelentkezes"' : "").'"><i class="bi '.((isset($_SESSION['user']) && ($userController->getIsBookFavourite($_SESSION['user']['id'], $_GET['id']))) ? "bi-heart-fill" : "bi-heart").' me-2"></i>Kedvenc</a></li>
                                </ul>
                            </div>
                            
                            <div class="modal fade" id="ment">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">';
                                            if(!isset($_SESSION['user'])) {
                                                
                                                $detailContainer .='<button type="button" class="nav-link shadow-sm py-2  px-2 my-2 d-bock c-pointer my-blue align-items-center bg-my-white-blue rounded  w-50" data-bs-dismiss="modal" aria-label="Close"><i class="me-2"></i>Értem</button>';
                                            }
                                            else {
                                                if($userController->getIsBookRead($_SESSION['user']['id'], $konyvInfo["id"])) {
                                                    $detailContainer .='<h5 class="modal-title my-blue text-center flex-fill justify-content-center" id="staticBackdropLabel"><i class="bi bi-bookmark-fill me-2"></i>Olvastam</h5>';
                                                } else if($userController->getIsBookWaited($_SESSION['user']['id'], $konyvInfo["id"])) {
                                                    $detailContainer .='<h5 class="modal-title my-blue text-center flex-fill justify-content-center" id="staticBackdropLabel"><i class="bi bi-bookmark-fill me-2"></i>Várólistás</h5>';
                                                } else {
                                                    $detailContainer .='<h5 class="modal-title my-blue text-center flex-fill justify-content-center" id="staticBackdropLabel"><i class="bi bi-bookmark me-2"></i>Mentés</h5>';
                                                }
                                            }
                        $detailContainer .='<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">'.(!isset($_SESSION['user']) ? "A mentéshez be kell jelentkezned" : "").'
                                            <ul class="row nav w-100 m-0 justify-content-center">';
                                                if(!isset($_SESSION['user'])) {
                                            
                                                    $detailContainer .='<button type="button" class="nav-link shadow-sm py-2  px-2 my-2 d-bock c-pointer my-blue align-items-center bg-my-white-blue rounded  w-50" data-bs-dismiss="modal" aria-label="Close"><i class="me-2"></i>Értem</button>';
                                                }
                                                else {
                                                    if($userController->getIsBookRead($_SESSION['user']['id'], $konyvInfo["id"])) {
                                                        $detailContainer .='<li class="col-12 col-md-6"><a href="'.$ROOT.'handlers/review_handler.php?waitId='.$konyvInfo["id"].'" class="nav-link shadow-sm py-2  px-2 my-2 d-bock c-pointer my-blue align-items-center bg-my-white-blue rounded"><i class="bi bi-journal-check me-2"></i>Várólista</a></li>
                                                                        <li class="col-12 col-md-6"><a href="'.$ROOT.'handlers/review_handler.php?deleteReadId='.$konyvInfo["id"].'" class="nav-link shadow-sm py-2  px-2 my-2 d-bock c-pointer my-blue align-items-center bg-my-white-blue rounded"><i class="bi bi-trash me-2"></i>Mentés törlése</a></li>';
                                                    } else if($userController->getIsBookWaited($_SESSION['user']['id'], $konyvInfo["id"])) {
                                                        $detailContainer .='<li class="col-12 col-md-6"><a href="'.$ROOT.'handlers/review_handler.php?readId='.$konyvInfo["id"].'" class="nav-link shadow-sm py-2  px-2 my-2 d-bock c-pointer my-blue align-items-center bg-my-white-blue rounded"><i class="bi bi-journal-check me-2"></i>Olvastam</a></li>
                                                                        <li class="col-12 col-md-6"><a href="'.$ROOT.'handlers/review_handler.php?deleteWaitId='.$konyvInfo["id"].'" class="nav-link shadow-sm py-2  px-2 my-2 d-bock c-pointer my-blue align-items-center bg-my-white-blue rounded"><i class="bi bi-trash me-2"></i>Mentés törlése</a></li>';
                                                    } else {
                                                        $detailContainer .='<li class="col-12 col-md-6"><a href="'.$ROOT.'handlers/review_handler.php?readId='.$konyvInfo["id"].'" class="nav-link shadow-sm py-2  px-2 my-2 d-bock c-pointer my-blue align-items-center bg-my-white-blue rounded"><i class="bi bi-journal-check me-2"></i>Olvastam</a></li>
                                                                        <li class="col-12 col-md-6"><a href="'.$ROOT.'handlers/review_handler.php?waitId='.$konyvInfo["id"].'" class="nav-link shadow-sm py-2  px-2 my-2 d-bock c-pointer my-blue align-items-center bg-my-white-blue rounded"><i class="bi bi-journal-bookmark-fill me-2"></i>Várólista</a></li>';
                                                    }
                                                }
                                                
                        $detailContainer .='</ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        
                   
                </div>
            </div>
        </div>

        <div class="modal fade" id="bejelentkezes">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title my-blue text-center flex-fill justify-content-center" id="staticBackdropLabel"><i class="text-center"></i></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">Ehhez a funcióhoz be kell jelentkezned
                                <ul class="row nav w-100 m-0 justify-content-center">
                                    <button type="button" class="nav-link shadow-sm py-2  px-2 my-2 d-bock c-pointer my-blue align-items-center bg-my-white-blue rounded  w-50" data-bs-dismiss="modal" aria-label="Close"><i class="me-2"></i>Értem</button>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
    </div>';

$velemenyekContent = '
<div class="row">';
$velemenyekContent .= ((isset($_SESSION['error']) && !empty($_SESSION['error'])) ? '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>' : "");
    $velemenyekContent .= ((isset($_SESSION['message']) && !empty($_SESSION['message'])) ? '<div class="alert alert-success" role="alert">'.$_SESSION['message'].'</div>' : "");

if(isset($_SESSION['user'])){
    $velemenyekContent .='<div class="col-12">
                            <div class="py-1 px-3">
                                <div class="pb-4 px-3 rounded">
                                    <div class="row">
                                        <div class="col-3 col-md-2 col-lg-1" >
                                            <div class="circle-avatar">
                                                <img class="border rounded-circle avatar-img" src="'.$_SESSION['user']['profilkep_url'].'" alt=""/>
                                            </div>
                                        </div>
                                        <div class="col-9 col-md-10 col-lg-11 border-bottom border-2 pb-3" >
                                            <div class="row">
                                                <div class="col-12 mb-2"><span class="my-blue fw-bold">'.$_SESSION['user']['nev'].'</span></div>
                                                <div class="col-12 font-roboto fs-5">
                                                    <form action="'.antiSql($_SERVER['PHP_SELF']).'?id='.$_GET['id'].'" method="post">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <textarea placeholder="Írd meg saját véleményed..." class="form-control" rows="5" name="commentText" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-end pt-3">
                                                            <div class="col-6 col-md-3"><button type="submit" name="velemenyKuldese" class="d-block w-100 btn btn-primary my-blue-border bg-my-blue text-white">Küldés</button></div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>';
}
    

    foreach($konyvVelemenyek as $v) {
        $velemenyekContent.= '<div class="col-12">
        <div class="py-1 px-3">
            <div class="pb-4 px-3 rounded ">
                <div class="row">
                    <div class="col-3 col-md-2 col-lg-1" >
                        <div class="circle-avatar">
                            <img class="border rounded-circle avatar-img" src="'.$v['profilkep_url'].'" alt=""/>
                        </div>
                    </div>
                    <div class="col-9 col-md-10 col-lg-11 border-bottom border-2 pb-3" >
                        <div class="row">
                            <div class="col-12 mb-2"><span class="my-blue fw-bold">'.$v['nev'].'</span> - '.$v['datum'].'</div>
                            <div class="col-12 font-roboto fs-5">'.$v['velemeny'].'</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    }

unsetMessages();

    
$velemenyekContent .='</div>';
//$velemenyGomb = "<button class='btn float-end shadow-sm py-1 px-3 my-blue d-flex justify-content-around align-items-center bg-my-white-blue rounded'><i class='bi bi-plus-square-dotted me-2'></i>vélemény írása</button>";
$detailContainer .= $bookPage->createContainer($nKonyvekContent, "Hasonló könyvek", "bi-book");
$detailContainer .= $bookPage->createContainer($velemenyekContent, "Vélemények", "bi-chat-left-text");
echo $bookPage->genFramedPage($detailContainer);
