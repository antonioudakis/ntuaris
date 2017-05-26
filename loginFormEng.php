<?php
session_start();
include 'ntuaris.php';
echo $header;
$user = new User();
$user->setLang('eng');
echo $user->getNavBar();

if ($user->isConnected()) {
	echo $user->getMenu();
} else {
	echo $user->getLoginForm();
}
echo getFooter('eng');
?>
