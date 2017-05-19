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
	echo getUpdateUserForm($_SESSION['ntuarisUserID']);
}
echo getFooter('gr');
?>
