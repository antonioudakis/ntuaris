<?php
session_start();
session_unset(); 
session_destroy(); 
include 'ntuaris.php';
echo $header;
$user = new User();
echo $user->getNavBar();
echo sendEmailForm(1);
echo getFooter('gr');
?>
