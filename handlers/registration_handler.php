<?php 
require_once("../includes/autoload.inc.php");

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['registration'])) {

    $user=new UserController("");

    if($user->isUserExists($_POST['username'])) {
        redirect("../pages/registration.php");
    }

    if($_POST['password']!=$_POST['password2']) {
        redirect("../pages/registration.php");
    }

    $user->registerUser($_POST['username'], $_POST['email'], $_POST['password'], );

    redirect("../");

}

redirect("../");