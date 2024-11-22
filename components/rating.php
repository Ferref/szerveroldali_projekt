<?php
    // A könyvek értékelésének csillaggal és számértékkel való megjelenítése
    // $stars | float vagy int
    function rating($stars){
        $ROOT = '/szerveroldali_projekt/';
        //Szám kerekítése .5-re vagy egészre
        $stars = floor($stars['atlag_ertekeles'] * 2) / 2;
        //echo "Osztva: $stars _ ".($stars==floor($stars));
        $element = '
        <p>
            <h5 class="my-blue text-center">
               <span class="block-icon-circle bg-my-white-blue rounded-circle d-inline-block text-center me-2"><i class="bi bi-star"></i></span> Értékelés
            </h5>
            <p class="my-3 text-center"><span class="fs-4 my-light-blue">'.$stars.'</span><span class="my-gray"> / 5</span></p>
            
            <span class="d-block text-center">';
            //Teli csillag(ok)
            for($i=0; $i<floor($stars); $i++) $element.='<i class="mx-1 my-star-yellow bi bi-star-fill"></i>';
            //Fél csillag
            if($stars!==floor($stars)) $element.='<i class="mx-1 my-star-yellow bi bi-star-half"></i>';
            //Üres csillag(ok)
            for($i=0; $i<floor(5-$stars); $i++) $element.='<i class="mx-1 my-star-yellow bi bi-star"></i>';

        $element.='</span>
            <p class="text-center mb-2 mt-1">
                <a class="my-light-blue c-pointer p-2" data-bs-toggle="modal" data-bs-target="#ertekel">
                Értékelem   
                </a>
            </p>
            <div class="modal fade" id="ertekel">
               
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <form class="">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title my-blue text-center flex-fill justify-content-center" id="staticBackdropLabel"><i class="bi bi-star me-2"></i> Értékelés Küldése</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="py-4 text-center">Mennyire találod jónak? (1-5)</p>
                            <p>
                                <div class="star-vote mb-3">
                                    <input type="hidden" name="ratingValue">
                                </div>
                                <script src="'.$ROOT.'assets/js/bookVote.js"></script>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <div class="row w-100">
                                <div class="col-6"><button type="button" class="d-block w-100 btn btn-outline-primary my-light-blue my-light-blue-border" data-bs-dismiss="modal">Mégsem</button></div>
                                <div class="col-6"><button type="button" class="d-block w-100 btn btn-primary my-blue-border bg-my-blue text-white">Küldés</button></div>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </p>';
        return $element;
    }