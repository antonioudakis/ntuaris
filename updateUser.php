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
		$user->showMessage("alert-danger","<strong>Προσοχή!</strong> Πρέπει να συμπληρωθούν τα απαιτούμενα στοιχεία");
		echo $this->getUpdateUserForm();
	} else {
		if ($user->updateUser($_POST['username'], $_POST['email'], $_POST['epvn'], $_POST['onoma'], $_POST['role'], $_POST['k_f'], $_POST['k_tm'])) {
			$user->showMessage("alert-success","<strong>Επιτυχής καταχώριση!</strong> Τα στοιχεία του χρήστης με username <strong>".$_POST['username']."</strong> ενημερώθηκαν.");
			echo $user->getMenu();
		} else {
			$user->showMessage("alert-warning","<strong>Σφάλμα!</strong> Παρουσιάστηκε σφάλμα κατά την ενημέρωση των στοιχείων του χρήστη με username <strong>".$_POST['username']."</strong>.");
		}
	}
}
echo getFooter('gr');
?>
