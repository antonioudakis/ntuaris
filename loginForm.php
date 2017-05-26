<?php
session_start();
include 'ntuaris.php';
echo $header;
$user = new User();
echo $user->getNavBar();

if (!$user->isConnected()) {
	echo $user->getLoginForm();
} else {
	echo $user->getMenu();
}
echo getFooter('gr');
?>
