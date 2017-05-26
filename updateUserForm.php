<?php
session_start();
include 'ntuaris.php';
echo $header;
$user = new User();
echo $user->getNavBar();
if (!$user->isConnected()) {
	$user->showMessage("alert-danger","<strong>Προσοχή!</strong>  Πρέπει πρώτα να συνδεθείτε στο σύστημα");
	echo $user->getLoginForm();
} else {
	echo $user->getUpdateUserForm();
}
echo getFooter('gr');
?>
