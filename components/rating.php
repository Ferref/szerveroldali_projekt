<?php
    // A könyvek értékelésének csillaggal és számértékkel való megjelenítése
    // $stars | float vagy int
    function rating($stars, $id){
        $userController=new UserController();
        $userView=new UserView();
        if(isset($_SESSION['user']) && $userController->getIsBookRated($_SESSION['user']['id'], $id)) {
            $userId=$userView->showUserBookRate($_SESSION['user']['id'], $id);
        } else {
            $userId="";
        }
        
        $ROOT = '/szerveroldali_projekt/';
        //Szám kerekítése .5-re vagy egészre
        $stars = floor($stars['atlag_ertekeles'] * 2) / 2;
        //echo "Osztva: $stars _ ".($stars==floor($stars));
        $element = '
        <p>
            <h5 class="my-blue text-center">
               <span class="block-icon-circle bg-my-white-blue rounded-circle d-inline-block text-center me-2"><i class="bi bi-star"></i></span> Átlag értékelés
            </h5>
            <p class="my-2 text-center"><span class="fs-4 my-light-blue">'.$stars.'</span><span class="my-gray"> / 5</span></p>
            
            <span class="d-block text-center">';
            //Teli csillag(ok)
            for($i=0; $i<floor($stars); $i++) $element.='<i class="mx-1 my-star-yellow bi bi-star-fill"></i>';
            //Fél csillag
            if($stars!==floor($stars)) $element.='<i class="mx-1 my-star-yellow bi bi-star-half"></i>';
            //Üres csillag(ok)
            for($i=0; $i<floor(5-$stars); $i++) $element.='<i class="mx-1 my-star-yellow bi bi-star"></i>';

        $element.='</span>';
            if(!is_null($id)) {
                $element.='<p class="text-center mb-2 mt-1">
                                <a class="my-light-blue c-pointer p-2" data-bs-toggle="modal" data-bs-target="#'.(!isset($_SESSION['user']) ? 'bejelentkezes' : "ertekel").'">
                                '.($userId!="" ? "Értékelésem: " . $userId['ertekeles'] : "Értékelem").'
                                </a>
                           </p>';
            }
$element.='<div class="modal fade" id="ertekel">
               
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <form class="" action="'.$ROOT.'handlers/review_handler.php" method="post">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title my-blue text-center flex-fill justify-content-center" id="staticBackdropLabel"><i class="bi bi-star me-2"></i>'.($userId!="" ? " Értékelés módosítása" : " Értékelés küldése").'</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="py-4 text-center">'.($userId!="" ? "Mennyire módosítod? (1-5)" : "Mennyire találod jónak? (1-5)").'</p>
                            <p>
                                <div class="star-vote mb-3 d-flex justify-content-center">
                                    <input type="hidden" name="ratingValue">
                                    <input type="hidden" name="bookId" value="'.$id.'">
                                </div>
                                <script src="'.$ROOT.'assets/js/bookVote.js"></script>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <div class="row w-100">
                                <div class="col-6"><button type="button" class="d-block w-100 btn btn-outline-primary my-light-blue my-light-blue-border" data-bs-dismiss="modal">Mégsem</button></div>
                                <div class="col-6"><button type="submit" class="d-block w-100 btn btn-primary my-blue-border bg-my-blue text-white" name="kuldes">'.($userId!="" ? "Módosítás" : "Küldés").'</button></div>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </p>';
        return $element;
    }