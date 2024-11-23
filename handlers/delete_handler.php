<?php 

require_once("../includes/autoload.inc.php");

if(isset($_GET['deleteUser']) && $_GET['deleteUser']!="" && isset($_SESSION['user']) && $_SESSION['user']['szerep']=="admin") {
    try {
        $userController=new UserController();
        if(!($userController->removeUser(antiSql($_GET['deleteUser'])))) {
            throw new HibaException();
        }
        $_SESSION['message']="A felhasználó törlése sikerült!";

        if(isset($_SESSION['rememberPage'])){
            redirect($_SESSION['rememberPage']);
        }

        redirect($_SERVER['PHP_SELF']);
    }catch (HibaException $e) {
        $_SESSION['error']="A felhasználó törlése nem sikerült!";
    }
}

if(isset($_GET['deleteAuthor']) && $_GET['deleteAuthor']!="" && isset($_SESSION['user']) && $_SESSION['user']['szerep']=="admin") {
    try {
        $iroController=new AuthorController();
        if(!($iroController->removeWriter(antiSql($_GET['deleteAuthor'])))) {
            throw new HibaException();
        }
        $_SESSION['message']="A szerző törlése sikerült!";

        if(isset($_SESSION['rememberPage'])){
            redirect($_SESSION['rememberPage']);
        }

        redirect($_SERVER['PHP_SELF']);
    }catch (HibaException $e) {
        $_SESSION['error']="A szerző törlése nem sikerült!";
    }
}

if(isset($_SESSION['rememberPage'])) {
    redirect($_SESSION['rememberPage']);
}

redirect("../");