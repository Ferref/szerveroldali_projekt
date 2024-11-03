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
            <a class=\"navbar-brand p-0 m-0\" href=\"".$this->root."index.php\"><img class=\"ps-4 p-2\" height=\"60px\" src=\"".$this->root."assets/images/booknav.svg\" alt=\"\"></a>
            <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\"
                data-bs-target=\"#navbarTogglerDemo02\" aria-controls=\"navbarTogglerDemo02\" aria-expanded=\"false\"
                aria-label=\"Toggle navigation\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>
            <div class=\"collapse navbar-collapse \" id=\"navbarTogglerDemo02\">
                <div class=\"w-100 d-flex justify-content-between flex-column flex-md-row fs-md-my \">
                    <ul class=\"navbar-nav me-0 me-lg-auto \">
                        <li class=\"nav-item m-0 me-md-2 px-2 align-content-center\">
                            <a class=\"nav-link d-flex my-light-blue p-0\" href=\"".$this->root."index.php\"><i class=\"bi bi-house-door my-blue me-1\"></i>Főoldal</a>
                        </li>
                        <li class=\"nav-item m-0 me-md-2 px-2 align-content-center\">
                            <a class=\"nav-link d-flex my-light-blue p-0\" href=\"".$this->root."pages/search.php?type=konyv\"><i class=\"bi bi-book my-blue me-1\"></i>Könyvek</a>
                        </li>
                        <li class=\"nav-item m-0 me-md-2 px-2 align-content-center\">
                            <a class=\"nav-link d-flex my-light-blue p-0\" href=\"".$this->root."pages/search.php?type=iro\"><i class=\"bi bi-vector-pen my-blue me-1\"></i>Írók</a>
                        </li>
                        <li class=\"nav-item m-0 me-md-2 px-2 align-content-center\">
                            <a class=\"nav-link d-flex my-light-blue p-0\" href=\"".$this->root."pages/categories.php\"><i class=\"bi bi-grid my-blue me-1\"></i>Kategóriák</a>
                        </li>";
                        if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin') {
                            $element .=
                            "<li class=\"nav-item m-0 me-md-2 px-2 align-content-center\">
                                <a class=\"nav-link d-flex my-light-blue p-0\" href=\"".$this->root."pages/book-manage.php\"><i class=\"bi bi-grid my-blue me-1\"></i>Könyv hozzáadás</a>
                            </li>";  
                        }
$element .=        "</ul>
                    <ul class=\"navbar-nav\">
                        <div class=\"dropdown hover-menu-button rounded-20 d-none d-md-block\">
                            <button class=\"btn  rounded\" type=\"button\">
                                <i class=\"bi bi-person-circle my-blue fs-3\">" .(isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "")."</i>
                            </button>
                            <ul class=\"hover-menu-list d-none bg-white rounded shadow py-1 px-3\">";
                            if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='guest') {
                                $element .="<li class=\"nav-item m-0 px-2\">
                                    <a class=\"my-light-blue p-0\" href=\"".$this->root."pages/login.php\"><i class=\"bi bi-box-arrow-in-right my-blue me-1\"></i>Belépés</a>
                                </li>
                                <li class=\"nav-item m-0 px-2\">
                                    <a class=\"my-light-gray p-0\" href=\"".$this->root."pages/registration.php\"></i>Regisztráció</a>
                                </li>";}
                            else {
                                $element .="<li class=\"nav-item m-0 px-2\">
                                    <a class=\"my-light-blue p-0\" href=\"".$this->root."pages/profile.php\"><i class=\"bi bi-box-arrow-in-right my-blue me-1\"></i>Profil</a>
                                </li>
                                <li class=\"nav-item m-0 px-2\">
                                    <a class=\"my-light-gray p-0\" href=\"".$this->root."pages/logout.php\"></i>Kilépés</a>
                                </li>";
                            }
$element .=            "</ul>
                        </div>
                        <li class=\"nav-item m-0 px-2 d-md-none\">
                            <a class=\"my-light-blue p-0\" href=\"".$this->root."pages/login.php\"><i class=\"bi bi-box-arrow-in-right my-blue me-1\"></i>Belépés</a>
                        </li>
                        <li class=\"nav-item m-0 px-2 d-md-none\">
                            <a class=\"my-light-gray p-0\" href=\"".$this->root."pages/registration.php\"></i>Regisztráció</a>
                        </li>
                    </ul>
                </div>
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