<?php 

require_once("../includes/autoload.inc.php");

if(isset($_GET['deleteUser']) && $_GET['deleteUser']!="" && isset($_SESSION['user']) && $_SESSION['user']['szerep']=="admin") {
    try {
        $userController=new UserController();
        if(!($userController->removeUser($_GET['deleteUser']))) {
            throw new HibaException();
        }
        $_SESSION['message']="A felhasználó törlése sikerült!";
        redirect($_SERVER['PHP_SELF']);
    }catch (HibaException $e) {
        $_SESSION['error']="A felhasználó törlése nem sikerült!";
    }
}

if(isset($_SESSION['rememberPage'])) {
    redirect($_SESSION['rememberPage']);
}

redirect("../");