<?php
session_start();
include 'ntuaris.php';
echo $header;
$user = new User();
echo $user->getNavBar();
if (!$user->isConnected()) {
	echo "	<div class=\"alert alert-danger alert-dismissable fade in\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
					<p id=\"msgtext\"><strong>Σφάλμα!</strong> Πρέπει πρώτα να συνδεθείτε στο σύστημα</p>
				</div>";
	echo $user->getLoginForm();
} else {
	echo $user->getUpdateUserForm();
}
echo getFooter('gr');
?>
