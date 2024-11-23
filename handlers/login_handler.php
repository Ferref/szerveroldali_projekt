<?php 
require_once("../includes/autoload.inc.php");

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['login']) && !isset($_SESSION['user'])) {

    if($_POST['username']=="" || $_POST['password']==""){
        $_SESSION['error']="Mindegyik mező kitöltése kötelező";
        redirect("../pages/login.php");
    }

    $user=new UserController();

    if(!$user->isUserExists($_POST['username'])) {
        $_SESSION['error']="Nem jó felhasználónév vagy jelszó";
        redirect("../pages/login.php");
    }

    if(!password_verify($_POST['password'], $user->getUserPassword($_POST['username']))) {
        $_SESSION['error']="Nem jó felhasználónév vagy jelszó";
        redirect("../pages/login.php");
    }

    $user=new UserView();
    $userInfo=$user->showUserInfo($_POST['username']);

    $_SESSION["user"]=$userInfo;

    if(isset($_SESSION['rememberPage'])) {
        redirect($_SESSION['rememberPage']);
    }

    redirect("../");

}

redirect("../");