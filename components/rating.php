<?php
    // A könyvek értékelésének csillaggal és számértékkel való megjelenítése
    // $stars | float vagy int
    function rating($stars){
        
        //Szám kerekítése .5-re vagy egészre
        $stars = floor($stars * 2) / 2;
        //echo "Osztva: $stars _ ".($stars==floor($stars));
        $element = '<p>
        <h5 class="my-blue"><span class="bi bi-star me-2"></span> Értékelés</h5><br><span class="my-light-blue">'.$stars.'/5</span><br>
        <span class="d-block">';
        //Teli csillag(ok)
        for($i=0; $i<floor($stars); $i++) $element.='<i class="my-star-yellow bi bi-star-fill"></i>';
        //Fél csillag
        if($stars!==floor($stars)) $element.='<i class="my-star-yellow bi bi-star-half"></i>';
        //Üres csillag(ok)
        for($i=0; $i<floor(5-$stars); $i++) $element.='<i class="my-star-yellow bi bi-star"></i>';

        $element.='</span><br></p>';
        return $element;
    }
?>