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

        $element.='</span><br></p>';
        return $element;
    }
?>