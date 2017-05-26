<?php
session_start();
session_unset(); 
session_destroy(); 
include 'ntuaris.php';
echo $header;
$user = new User();
echo $user->getNavBar();
$user->showMessage("alert-success","<strong>Επιτυχής αποσύνδεση!</strong> Έχετε αποσυνδεθεί από τις ηλεκτρονικές υπηρεσίες του Ε.Μ.Π.");
echo $user->getLoginForm();
echo getFooter('gr');
?>
