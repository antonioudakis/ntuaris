<?php
session_start();
include 'ntuaris.php';
echo $header;
echo getNavBar('gr');
if (!isset($_SESSION['ntuarisUserID'])) {
	echo getLoginForm('gr');
} else {
	echo getMenu($_SESSION['ntuarisUserID']);
}
echo getFooter('gr');
?>
