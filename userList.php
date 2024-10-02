<?php
include 'includes/dbh.inc.php';
include 'includes/user.inc.php';
include 'includes/viewuser.inc.php';

$users = new ViewUser();
$users -> showAllUsers();

?>