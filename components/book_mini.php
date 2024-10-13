<?php
    // A könyvek kis méretű megjelenítése
    // $id   | int
    // $ROOT | string

    function book_mini($id,$ROOT){
        //if($kep_url=="nincs" || empty($kep_url))
        $kep_url = $ROOT."media/images/nincs-borito.jpg";
        $cim = "Narnia 2. - Az oroszlán, a boszorkány és a ruhásszekrény - Illusztrált kiadás";
        $szerzo = "C. S. Levis";
        //Szám kerekítése .5-re vagy egészre
        
        $element = "
        
        <div class=\"col-12 col-sm-6 col-md-4 col-lg-12_5 p-3\">
            <a href=\"".$ROOT."pages/book-overview.php?id=".$id."\">
                <div class=\"book-card rounded border d-flex flex-column align-items-center text-center c-pointer\">
                    <div class=\"py-2 px-2 px-md-0 px-lg-3 cover-container\">
                        <img class=\"d-block mx-auto rounded\"src=\"".$kep_url."\"/>
                    </div>
                    <p class=\"book-title m-2\">".$cim."</p>
                    <p class=\"font-roboto my-gray mb-2\">".$szerzo."</p>
                </div>
            </a>
        </div>
        ";
        return $element;
    }
?>