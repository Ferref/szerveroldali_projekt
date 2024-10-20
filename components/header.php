<?php
    //
    // Az $element változón keresztül éri el a komponens tartalmát a `generate.php`.
    // A fájlban kezelhetők a Generate osztály változói ($this->...)
    //
    $element =  "
    <div class=\"container-fluid container-lg\">
    <div class=\"row \">
        <div class=\"top-line\"></div>
    </div>
</div>
<div class=\"sticky-top container-fluid container-lg header\">
    <nav class=\"navbar navbar-expand-md navbar-light bg-white p-0 rounded-20\">
        <div class=\"container-fluid\">
            <a class=\"navbar-brand p-0 m-0\" href=\"".$this->root."index.php\"><img class=\"ps-4 p-2\" height=\"60px\" src=\"".$this->root."media/images/booknav.svg\" alt=\"\"></a>
            <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\"
                data-bs-target=\"#navbarTogglerDemo02\" aria-controls=\"navbarTogglerDemo02\" aria-expanded=\"false\"
                aria-label=\"Toggle navigation\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>
            <div class=\"collapse navbar-collapse\" id=\"navbarTogglerDemo02\">
                <ul class=\"navbar-nav me-0 me-lg-auto \">
                    <li class=\"nav-item m-0 me-md-2 px-2\">
                        <a class=\"nav-link my-light-blue p-0\" href=\"".$this->root."index.php\"><i class=\"bi bi-house-door my-blue me-1\"></i>Főoldal</a>
                    </li>
                    <li class=\"nav-item m-0 me-md-2 px-2\">
                        <a class=\"nav-link my-light-blue p-0\" href=\"#\"><i class=\"bi bi-book my-blue me-1\"></i>Könyvek</a>
                    </li>
                    <li class=\"nav-item m-0 me-md-2 px-2\">
                        <a class=\"nav-link my-light-blue p-0\" href=\"#\"><i class=\"bi bi-vector-pen my-blue me-1\"></i>Írók</a>
                    </li>
                    <li class=\"nav-item m-0 me-md-2 px-2\">
                        <a class=\"nav-link my-light-blue p-0\" href=\"#\"><i class=\"bi bi-grid my-blue me-1\"></i>Kategóriák</a>
                    </li>
                    
                </ul>
                <ul class=\"navbar-nav\">
                    <li class=\"nav-item ps-2 float-end\">
                        <span class=\"nav-link\">
                            <a class=\"my-light-blue p-0\" href=\"".$this->root."pages/login.php\"><i class=\"bi bi-box-arrow-in-right my-blue me-1\"></i>Belépés</a>
                            <span class=\"p-0 disabled my-light-gray\" >|</span>
                            <a class=\"my-light-gray p-0\" href=\"".$this->root."pages/registration.php\"></i>Regisztráció</a>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class=\"container-fluid container-lg\">
    <div class=\"row \">
        <div class=\"bottom-line\"></div>
    </div>
</div>
    ";
?>