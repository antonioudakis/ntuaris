<?php
session_start();
session_unset(); 
session_destroy(); 
include 'ntuaris.php';
echo $header;
echo getNavBar('gr');
echo sendEmailForm(1);
echo getFooter('gr');
?>
