<?php
    //
    // Az $element változón keresztül éri el a komponens tartalmát a `generate.php`.
    // A fájlban kezelhetők a Generate osztály változói ($this->...)
    //
    $element =  "
    <div class=\"container-fluid container-lg mb-4\">
        <div class=\"container-fluid bg-white rounded-20 py-2 px-4\">             
            <div class=\"row py-2\">
                <div class=\"col-12\"><p><span class=\"block-icon-circle bg-my-white-blue rounded-circle d-inline-block text-center me-2\"><i class=\"w-100 text-center bi ".$cssIcon." my-blue\"></i></span><span class=\"fw-bold my-blue fs-5\">".$containerName."</span></p></div>
            </div>
            <div class=\"row p-2\">
                <div class=\"container\">".$content."</div>
            </div>
        </div>
    </div>
    ";
?>