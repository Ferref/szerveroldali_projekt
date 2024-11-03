<?php

require_once("includes/autoload.inc.php");
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
        include(dirname(__FILE__)."/components/container.php");
        return $container;
    }
    public function createEmptyContainer($content){
        $containerName = $cssIcon = '';
        include(dirname(__FILE__)."/components/container.php");
        return $emptyContainer;
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
