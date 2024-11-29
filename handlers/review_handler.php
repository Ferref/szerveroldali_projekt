<?php 

require_once("../includes/autoload.inc.php");

$bookController=new BookController();
$userController=new UserController();

if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['kuldes']) && isset($_SESSION['user']) && $userController->isIdExists($_SESSION['user']['id'])) {

    if($userController->getIsBookRated($_SESSION['user']['id'], antiSql($_POST['bookId']))) {
        $userController->modifyBookRate($_SESSION['user']['id'], antiSql($_POST['bookId']), $_POST['ratingValue']+1);
    } else {
        $userController->createBookRate($_SESSION['user']['id'], antiSql($_POST['bookId']), $_POST['ratingValue']+1);
    }
}


if(isset($_GET['id']) && isset($_SESSION['user']) && ($bookController->getIsBookExist(antiSql($_GET['id']))) && ($userController->isIdExists($_SESSION['user']['id']))) {
    
    if($userController->getIsBookFavourite($_SESSION['user']['id'], antiSql($_GET['id']))) {
        $userController->removeBookFavourite($_SESSION['user']['id'], $_GET['id']);
    }
    else {
        $userController->createBookFavourite($_SESSION['user']['id'], antiSql($_GET['id']));
    }
}

if(isset($_GET['waitId']) && isset($_SESSION['user']) && ($bookController->getIsBookExist(antiSql($_GET['waitId']))) && ($userController->isIdExists($_SESSION['user']['id']))) {
    
    if($userController->getIsBookRead($_SESSION['user']['id'], antiSql($_GET['waitId']))) {
        $userController->removeBookRead($_SESSION['user']['id'], $_GET['waitId']);
    }
    $userController->createBookWaited($_SESSION['user']['id'], antiSql($_GET['waitId']));
}

if(isset($_GET['readId']) && isset($_SESSION['user']) && ($bookController->getIsBookExist(antiSql($_GET['readId']))) && ($userController->isIdExists($_SESSION['user']['id']))) {
    
    if($userController->getIsBookWaited($_SESSION['user']['id'], antiSql($_GET['readId']))) {
        $userController->removeBookWaited($_SESSION['user']['id'], $_GET['readId']);
    }
    $userController->createBookRead($_SESSION['user']['id'], antiSql($_GET['readId']));
}

if(isset($_GET['deleteReadId']) && isset($_SESSION['user']) && ($bookController->getIsBookExist(antiSql($_GET['deleteReadId']))) && ($userController->isIdExists($_SESSION['user']['id']))) {
    
    $userController->removeBookRead($_SESSION['user']['id'], antiSql($_GET['deleteReadId']));
}

if(isset($_GET['deleteWaitId']) && isset($_SESSION['user']) && ($bookController->getIsBookExist(antiSql($_GET['deleteWaitId']))) && ($userController->isIdExists($_SESSION['user']['id']))) {
    
    $userController->removeBookWaited($_SESSION['user']['id'], antiSql($_GET['deleteWaitId']));
}


if(isset($_SESSION['rememberPage'])) {
    redirect($_SESSION['rememberPage']);
}

redirect("../");