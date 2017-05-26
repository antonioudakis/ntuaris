<?php
session_start();
session_unset(); 
session_destroy(); 
include 'ntuaris.php';
echo $header;
$user = new User();
echo $user->getNavBar();
$validInput = false;
if (isset($_GET['email']) && !empty($_GET['email'])) {
	if (isset($_GET['hash']) && !empty($_GET['hash'])) {
		$validInput = true;
	}
}
if (!$validInput) {
	$user->showMessage("alert-danger","<strong>Προσοχή!</strong> Δεν υπάρχουν τα απαιτούμενα στοιχεία για να γίνει η ενεργοποίηση χρήστη");
} else {
	
	$userActivation = $user->checkUserActivation($_GET["email"], $_GET["hash"]);
	
	if ($userActivation == 1) {
		$user->showMessage("alert-danger","<strong>Προσοχή!</strong> Ο χρήστης με email ".$_GET['email']. " έχει ήδη ενεργοποιηθεί");
	} elseif ($userActivation == 0) {
		if ($this->activateUser($_GET["email"], $_GET["hash"])) {
			$user->showMessage("alert-success","<strong>Επιτυχής ενεργοποίηση!</strong> Ο χρήστης με email <strong>".$_GET['email']."</strong> ενεργοποιήθηκε επιτυχώς");
		} else {
			$user->showMessage("alert-warning","<strong>Σφάλμα!</strong> Παρουσιάστηκε σφάλμα κατά την διαδικασία ανεργοποίησης του χρήστη με email ".$_GET['email']);
		}
	} else {
		$user->showMessage("alert-danger","<strong>Προσοχή!</strong> Τα απαιτούμενα στοιχεία για την ενεργοποίηση του χρήστη με email ".$_GET['email']. " είναι λανθασμένα");
	}
}
echo getFooter('gr');
?>
