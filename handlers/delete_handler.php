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


if(isset($_GET['deleteBook']) && $_GET['deleteBook']!="" && isset($_SESSION['user']) && $_SESSION['user']['szerep']=="admin") {
    try {
        $bookController=new BookController();
        if(!($bookController->removeBook(antiSql($_GET['deleteBook'])))) {
            throw new HibaException();
        }
        $_SESSION['message']="A könyv törlése sikerült!";
        
        if(isset($_SESSION['rememberPage'])){
            redirect($_SESSION['rememberPage']);
        }

        redirect($_SERVER['PHP_SELF']);
    }catch (HibaException $e) {
        $_SESSION['error']="A könyv törlése nem sikerült!";
    }
}

if(isset($_GET['deleteReview']) && $_GET['deleteReview']!="" && isset($_SESSION['user']) && $_SESSION['user']['szerep']=="admin") {
    try {
        $reviewController=new ReviewController();
        if(!($reviewController->removeReview(antiSql($_GET['deleteReview'])))) {
            throw new HibaException();
        }
        $_SESSION['message']="A vélemény törlése sikerült!";
        
        if(isset($_SESSION['rememberPage'])){
            redirect($_SESSION['rememberPage']);
        }

        redirect($_SERVER['PHP_SELF']);
    }catch (HibaException $e) {
        $_SESSION['error']="A vélemény törlése nem sikerült!";
    }
}

if(isset($_GET['deleteRate']) && $_GET['deleteRate']!="" && isset($_SESSION['user']) && $_SESSION['user']['szerep']=="admin") {
    try {
        $userController=new UserController();
        if(!($userController->removeBookRate(antiSql($_GET['deleteRate'])))) {
            throw new HibaException();
        }
        $_SESSION['message']="Az értékelés törlése sikerült!";

        if(isset($_SESSION['rememberPage'])){
            redirect($_SESSION['rememberPage']);
        }

        redirect($_SERVER['PHP_SELF']);
    }catch (HibaException $e) {
        $_SESSION['error']="Az értékelés törlése nem sikerült!";
    }
}

if(isset($_GET['deleteCategory']) && $_GET['deleteCategory']!="" && isset($_SESSION['user']) && $_SESSION['user']['szerep']=="admin") {
    try {
        $categoryController=new CategoryController();
        if(!($categoryController->removeCategory(antiSql($_GET['deleteCategory'])))) {
            throw new HibaException();
        }
        $_SESSION['message']="A kategória törlése sikerült!";

        if(isset($_SESSION['rememberPage'])){
            redirect($_SESSION['rememberPage']);
        }

        redirect($_SERVER['PHP_SELF']);
    }catch (HibaException $e) {
        $_SESSION['error']="A kategória törlése nem sikerült!";
    }
}

if(isset($_SESSION['rememberPage'])) {
    redirect($_SESSION['rememberPage']);
}

redirect("../");