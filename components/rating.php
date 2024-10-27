<?php
    // A könyvek értékelésének csillaggal és számértékkel való megjelenítése
    // $stars | float vagy int
    function rating($stars){
        
        //Szám kerekítése .5-re vagy egészre
        $stars = floor($stars * 2) / 2;
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

        $element.='</span><br>
            <p class="text-center">
                <a class="my-light-blue c-pointer p-2" data-bs-toggle="modal" data-bs-target="#ertekel">
                Értékelem   
                </a>
            </p>
            <div class="modal fade" id="ertekel">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title my-blue text-center flex-fill justify-content-center" id="staticBackdropLabel"><i class="bi bi-star me-2"></i> Értékelés Küldése</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="py-4 text-center">...</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary my-light-blue my-light-blue-border" data-bs-dismiss="modal">Mégsem</button>
                        <button type="button" class="btn btn-primary my-blue-border bg-my-blue text-white">Küldés</button>
                    </div>
                    </div>
                </div>
            </div>
        </p>';
        return $element;
    }
?>