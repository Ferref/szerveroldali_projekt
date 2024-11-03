<?php
    // A könyvek kis méretű megjelenítése
    // $id   | int
    // $ROOT | string

    function book_mini($konyv,$ROOT){
        //if($kep_url=="nincs" || empty($kep_url))
        $kep_url = $konyv['boritokep_url'];
        $cim = $konyv['cim'];
        $szerzo = new AuthorView();
        $szerzo=$szerzo->showBookAuthors($konyv['id']);
        //Szám kerekítése .5-re vagy egészre
        
        $element = "
        
        <div class=\"col-12 col-sm-6 col-md-4 col-lg-12_5 p-3\">
            <a href=\"".$ROOT."pages/book-overview.php?id=".$konyv['id']."\">
                <div class=\"book-card d-flex flex-column align-items-center text-center c-pointer\">
                    <div class=\"py-2 px-2 px-md-0 px-lg-3 cover-container\">
                        <img class=\"d-block mx-auto rounded\"src=\"".$kep_url."\"/>
                    </div>
                    <p class=\"book-title m-2\">".$cim."</p>
                    <p class=\"font-roboto my-gray mb-2\">".$szerzo[0]['nev']."</p>
                </div>
            </a>
        </div>
        ";
        return $element;
    }
?>