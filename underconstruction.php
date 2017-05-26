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
	echo "	<div class=\"container text-center\">
					</br>
					<img src=\"./img/underconstruction.png\" class=\"img-thumbnail\" height=\"350\" width=\"350\" alt=\"UnderConstruction\">
				</div>
				<div>
					</br>
					<p align=\"center\">Πατήστε <a href='//".$user->getHost()."loginForm.php'> εδώ </a> για να επιστρέψετε στη σελίδα επιλογών</p>
				</div>";
}
echo getFooter('gr');
?>
