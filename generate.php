<?php
$_SESSION["my-root"] = $_SERVER['DOCUMENT_ROOT'];
class Generate{
    public $name = "Booknav";
    public $root = "./";
    public function genHead(){
        include_once(dirname(__FILE__)."/components/head.php");
        return $element;
    }
    public function genHeader(){
        include_once(dirname(__FILE__)."/components/header.php");
        return $element;
    }
    public function genFooter(){
        include_once(dirname(__FILE__)."/components/footer.php");
        return $element;
    }
    public function createContainer($content, $containerName, $cssIcon){
        include_once(dirname(__FILE__)."/components/container.php");
        return $element;
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