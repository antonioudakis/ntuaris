<?php
session_start();
include 'ntuaris.php';
echo $header;
$user = new User;
if (!$user->isConnected()) {
	$validInput = false;
	if (isset($_POST['username']) && !empty($_POST['username'])) {
		if (isset($_POST['pwd']) && !empty($_POST['pwd'])) {
			$validInput = true;
		}
	}

	if (!$validInput) {
		echo $user->getNavBar();
		echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
						<p id=\"msgtext\"><strong>Προσοχή!</strong> Πρέπει να συμπληρωθούν τα απαιτούμενα στοιχεία</p>
					</div>";
		echo $user->getLoginForm();
	} else {
		
		$user->login($_POST["username"], $_POST["pwd"]);
		
		if ($user->getId() == null) {
			echo $user->getNavBar();
			echo"	<div class=\"alert alert-danger alert-dismissable fade in\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<p id=\"msgtext\"><strong>Σφάλμα!</strong> Το όνομα χρήστη ή ο κωδικός είναι λάθος</p>
						</div>";
			echo $user->getLoginForm();
		} else {
			if (!$user->isActive()){
				echo $user->getNavBar();
				echo "	<div class=\"alert alert-warning alert-dismissable fade in\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
								<p id=\"msgtext\"><strong>Σφάλμα!</strong> Δεν έχετε ενεργοποιήσει τον λογαριασμό. Ενεργοποιήστε τον λογαριασμό μέσω του συνδέσμου που σας έχει σταλεί στο ηλεκτρονικό σας ταχυδρομείο με διεύθυνση ".$user->getEmail()."</p>
							</div>";
				echo $user->getLoginForm();
			} else {
				if (isset($_POST['remember']) && !empty($_POST['remember'])) {
					setcookie("ntuarisUser", $_POST['username'], time() + (10*365*24*60*60), "/"); 
					setcookie("ntuarisPwd", $_POST['pwd'], time() + (10*365*24*60*60), "/"); 
				}	else {
					if (isset($_COOKIE['ntuarisUser'])) {
						if ($_COOKIE['ntuarisUser'] == $_POST['username']) {
							setcookie("ntuarisUser", "", time() - 3600, "/"); 
							setcookie("ntuarisPwd", "", time() - 3600, "/"); 
						}
					}
				}
				echo $user->getNavBar();
				echo $user->getMenu();
			}
		}
	}
} else {
	$user->getUserDataByID();
	echo $user->getNavBar();
	echo $user->getMenu();
}
echo getFooter('gr');
?>
