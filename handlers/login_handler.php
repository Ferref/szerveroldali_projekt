<?php 
require_once("../includes/autoload.inc.php");

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['login'])) {

    $user=new UserController("");

    if(!$user->isUserExists($_POST['username'])) {
        redirect("../pages/login.php");
    }

    if(!password_verify($_POST['password'], $user->getUserPassword($_POST['username']))) {
        redirect("../pages/login.php");
    }

    $user=new UserView("");
    $userInfo=$user->showUserInfo($_POST['username']);

    $_SESSION["user_id"]=$userInfo['id'];
    $_SESSION["user_name"]=$userInfo['nev'];
    $_SESSION["user_role"]=$userInfo['szerep'];
    $_SESSION["user_profilkep"]=$userInfo['profilkep_url'];

    redirect("../");

}

redirect("../");