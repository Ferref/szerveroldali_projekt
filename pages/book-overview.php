<?php

if (!isset($_GET['id'])) {
    header("Location: ../");
}
//
$ROOT = "../";
require_once($ROOT . "generate.php");
include_once($ROOT . "components/book_mini.php");
include_once($ROOT . "components/rating.php");

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['velemenyKuldese']) && isset($_GET['id']) && isset($_SESSION['user'])) {
    
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
                                                <span class="reveal d-flex align-items-center">'.$k['nev'].'<span class="badge bg-my-light-blue ms-1 lost">'.$kategoriak->showSpecificCategoryNumber($k['id']).'</span></span>
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
                            <div class="bg-white rounded-20 p-2 p-md-4 border w-100 mb-2">
                                <h5 class="my-blue text-center mb-3"><span class="block-icon-circle bg-my-white-blue rounded-circle d-inline-block text-center me-2"><i class="bi bi-vector-pen"></i></span>Író</h5>
                                    <div class="mx-1 mx-md-3 rounded rounded-circle p-1 bg-white shadow circle-avatar overflow-hidden mb-3 ">
                                        <a href="'.$ROOT.'pages/author-overview.php?id='.$konyvSzerzok[0]['id'].'"><img src="'.$konyvSzerzok[0]['profilkep_url'].'" alt="" class="rounded-circle"></a>
                                    </div>
                                    <p class="text-center"><a href="'.$ROOT.'pages/author-overview.php?id='.$konyvSzerzok[0]['id'].'">'.$konyvSzerzok[0]['nev'].'</a></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="bg-white rounded-20 p-2 p-md-4 border w-100 mt-2">
                            ' . rating($ertekeles) . '
                            </div>
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
                                                                <textarea placeholder="Írd meg saját véleményed..." class="form-control" rows="5" name="commentText" ></textarea>
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
