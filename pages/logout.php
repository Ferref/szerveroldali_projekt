<?php session_start();
  
$$_SESSION["user_id"]=null;
$_SESSION["user_name"]=null;
$_SESSION["user_role"]="guest";
$_SESSION["user_profilkep"]=null;
header("Location: ../index.php");

