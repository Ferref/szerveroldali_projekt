<?php
$_SESSION["my-root"] = $_SERVER['DOCUMENT_ROOT'];
class Generate{
    public $name = "Booknav";
    public $root = "./";
    public function genHead(){
        return "
        <head>
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <link rel=\"stylesheet\" href=\"".$this->root."bootstrap/css/bootstrap.css\">
            <link rel=\"stylesheet\" href=\"".$this->root."bootstrap/icons/font/bootstrap-icons.css\">
            <link rel=\"stylesheet\" href=\"".$this->root."css/main.css\">
            <script src=\"".$this->root."bootstrap/js/bootstrap.js\"></script>
            <title>".$this->name."</title>
        </head>
        ";
    }
    public function genHeader(){
        return "
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
                            <a class=\"nav-link my-light-blue p-0\" href=\"#\"><i class=\"bi bi-house-door my-blue me-1\"></i>Főoldal</a>
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
                                <a class=\"my-light-blue p-0\" href=\"#\"><i class=\"bi bi-box-arrow-in-right my-blue me-1\"></i>Belépés</a>
                                <span class=\"p-0 disabled my-light-gray\" >|</span>
                                <a class=\"my-light-gray p-0\" href=\"#\"></i>Regisztráció</a>
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
    }
    public function genFooter(){
        return"
        <div class=\"container-fluid container-lg mt-3\">
        <div class=\"container-fluid bg-white rounded-top-20\">
            <div class=\"row\"><div class=\"col-12\"><br></div></div>
            <div class=\"row px-4\">
                <div class=\"container-fluid bg-blue-wave rounded-top-20\">
                    <div class=\"row px-4 pt-5\">
                        <div class=\"container-fluid bg-white rounded-top-20\">
                            <div class=\"row mb-2\">
                                <div class=\"col-12 py-3\">
                                    <p class=\"text-center fs-2 fw-bold my-blue py-3\">Készítette</p>
                                </div>
                                <div class=\"col-12 col-md-4 text-center fs-4 my-gray\">
                                    <p class=\"fw-bold font-roboto mb-2\">Kovács Ferenc</p>
                                    <p class=\"font-roboto\">IR71LZ</p>
                                </div>
                                <div class=\"col-12 col-md-4 text-center fs-4 my-gray\">
                                    <p class=\"fw-bold font-roboto mb-2\">Szögi Zsombor</p>
                                    <p class=\"font-roboto\">JLX61S</p>
                                </div>
                                <div class=\"col-12 col-md-4 text-center fs-4 my-gray\">
                                    <p class=\"fw-bold font-roboto mb-2\">Mangó Zoltán</p>
                                    <p class=\"font-roboto\">NTY2EI</p>
                                </div>
                                <div class=\"col-12 text-center pb-2 pt-4 font-roboto my-light-blue\">2024 - JGYPK | Szerveroldali Programozás</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        ";
    }
    public function createContainer($content, $containerName, $cssIcon){
        return "
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
    }
    public function genEmptyPage($content){
        return "<!DOCTYPE html>
            <html lang=\"hu\">".$this->genHead()."<body>".$content."</body></html>";
    }
    public function genFramedPage($content){
        $contentFrame="<div class=\"container-fluid container-lg p-0 content-frame\">".$content."</div>";
        return $this->genEmptyPage($this->genHeader().$contentFrame.$this->genFooter());
    }
}

/*
$testPage = new Generate();
$testPage->name = "Test";
$content = "Ez egy teszt oldal!";
$container = $testPage->createContainer($content,"Teszt Elek Blokk", "bi-book");
echo $testPage->genFramedPage($container);
*/
?>