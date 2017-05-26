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
	$validInput = false;
	if (isset($_POST['username']) && !empty($_POST['username'])) {
		if (isset($_POST['epvn']) && !empty($_POST['epvn'])) {
			if (isset($_POST['onoma']) && !empty($_POST['onoma'])) {
				if (isset($_POST['email']) && !empty($_POST['email'])) {
					$validInput = true;
				}
			}
		}
	}

	if (!$validInput) {
		echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
						<p id=\"msgtext\"><strong>Προσοχή!</strong> Πρέπει να συμπληρωθούν τα απαιτούμενα στοιχεία</p>
					</div>";
		echo $this->getUpdateUserForm();
	} else {
		if ($user->updateUser($_POST['username'], $_POST['email'], $_POST['epvn'], $_POST['onoma'], $_POST['role'], $_POST['k_f'], $_POST['k_tm'])) {
			echo "	<div class=\"alert alert-success alert-dismissable fade in\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<p id=\"msgtext\"><strong>Επιτυχής καταχώριση!</strong> Τα στοιχεία του χρήστης με username <strong>".$_POST['username']."</strong> ενημερώθηκαν.</p>
						</div>";
			echo $user->getMenu();
		} else {
			echo "	<div class=\"alert alert-danger alert-dismissable fade in\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<p id=\"msgtext\"><strong>Σφάλμα!</strong> Παρουσιάστηκε σφάλμα κατά την ενημέρωση των στοιχείων του χρήστη με username <strong>".$_POST['username']."</strong>.</p>
						</div>";
		}
	}
}
echo getFooter('gr');
?>
