<?php 
require_once("../includes/autoload.inc.php");

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['registration'])) {

    if($_POST['username']=="" || $_POST['email']=="" || $_POST['password']=="" || $_POST['password2']==""){
        $_SESSION['error']="Mindegyik mező kitöltése kötelező";
        redirect("../pages/registration.php");
    }

    $emailRegex="/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/";

    $user=new UserController();

    if($user->isUserExists(antiSql($_POST['username']))) {
        $_SESSION['error']="Ilyen nevű felhasználó már van";
        redirect("../pages/registration.php");
    }

    if(!preg_match($emailRegex, $_POST['email'])) {
        $_SESSION['error']="Nem megfelelő az e-mail cím formátuma (a helyes formátum: pelda@pelda.hu)";
        redirect("../pages/registration.php");
    }   

    if($user->isEmailExists(antiSql($_POST['email']))) {
        $_SESSION['error']="Ezzel az e-mail címmel már van felhasználó";
        redirect("../pages/registration.php");
    }

    if($_POST['password']!=$_POST['password2']) {
        $_SESSION['error']="Nem egyezik a két jelszó";
        redirect("../pages/registration.php");
    }

    $user->registerUser(antiSql($_POST['username']), antiSql($_POST['email']), antiSql($_POST['password']), "user");
    $_SESSION['message']="A regisztráció sikeresen megtörtént";

    redirect("../pages/registration.php");

}

redirect("../");