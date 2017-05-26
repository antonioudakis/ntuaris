<?php
session_start();
include 'ntuaris.php';
echo $header;
$user = new User();
echo $user->getNavBar();
$validInput = false;
if (isset($_POST['oldpwd']) && !empty($_POST['oldpwd'])) {
	if (isset($_POST['pwd']) && !empty($_POST['pwd'])) {
		if (isset($_POST['pwdconfirm']) && !empty($_POST['pwdconfirm'])) {
			$validInput = true;
		}
	}
}
if (!$validInput) {
	$user->showMessage("alert-danger","<strong>Προσοχή!</strong> Για να αλλαχθεί το συθηματικό πρόσβασης πρέπει να συμπληρωθούν το παλιό και το νέο συνθηματικό");
	echo $user->getMenu();
} else {
	if  ($_POST['pwd']!=$_POST['pwdconfirm']) {
		$user->showMessage("alert-danger","<strong>Προσοχή!</strong> Το νέο συνθηματικό είναι διαφορετικό από την επιβεβαίωση του νέου συνθηματικού πρόσβασης");
		echo $user->getMenu();
	} else {
		
		$user->getUserDataByID();
		if ($user->getPwd() != md5($_POST['oldpwd'])) {
			$user->showMessage("alert-danger","<strong>Αποτυχία Αλλαγής Συνθηματικού!</strong> Το συνθηματικό πρόσβασης είναι διαφορετικό από τον παλιό συνθηματικό που δηλώσατε στη φόρμα αλλαγής συνθηματικού");
			echo $user->getMenu();
		}  else {
			if ($user->updatePwd($_POST['pwd'])) {	
				$user->showMessage("alert-success","<strong>Επιτυχής καταχώριση!</strong> Έγινε επιτυχής αλλαγή του συνθηματικού πρόσβασης");
				echo $user->getMenu();
			} else {
				$user->showMessage("alert-warning","<strong>Σφάλμα!</strong> Παρουσιάστηκε σφάλμα κατά την προσπάθεια ενημέρωσης του συνθηματικού");
				echo $user->getMenu();
			}
		}
	}
}
echo getFooter('gr');
?>
