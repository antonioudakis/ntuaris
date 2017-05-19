<?php
session_start();
include 'ntuaris.php';
echo $header;
echo getNavBar('gr');
if (!isset($_SESSION['ntuarisUserID'])) {
	echo "	<div class=\"alert alert-danger alert-dismissable fade in\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
					<p id=\"msgtext\"><strong>Σφάλμα!</strong> Πρέπει πρώτα να συνδεθείτε στο σύστημα</p>
				</div>";
	echo getLoginForm('gr');
} else {
	echo "	<div class=\"container text-center\">
					</br>
					<img src=\"./img/underconstruction.png\" class=\"img-thumbnail\" height=\"350\" width=\"350\" alt=\"UnderConstruction\">
				</div>
				<div>
					</br>
					<p align=\"center\">Πατήστε <a href='//".$host."loginForm.php'> εδώ </a> για να επιστρέψετe στην προηγούμενη σελίδα</p>
				</div>";
}
echo getFooter('gr');
?>
