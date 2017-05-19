<?php
session_start();
include 'ntuaris.php';
echo $header;
echo getNavBar('eng');
if (!isset($_SESSION['ntuarisUserID'])) {
	echo getLoginForm('eng');
} else {
	echo getMenu($_SESSION['ntuarisUserID']);
}
echo getFooter('eng');
?>
