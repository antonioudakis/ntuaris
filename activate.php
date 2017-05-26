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
	echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
					<p id=\"msgtext\"><strong>Προσοχή!</strong> Δεν υπάρχουν τα απαιτούμενα στοιχεία για να γίνει η ενεργοποίηση χρήστη</p>
				</div>";
} else {
	
	$userActivation = $user->checkUserActivation($_GET["email"], $_GET["hash"]);
	
	if ($userActivation == 1) {
		echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
						<p id=\"msgtext\"><strong>Προσοχή!</strong> Ο χρήστης με email ".$email. " έχει ήδη ενεργοποιηθεί</p>
					</div>";
	} elseif ($userActivation == 0) {
		if ($this->activateUser($_GET["email"], $_GET["hash"])) {
			echo "	<div class=\"alert alert-success alert-dismissable fade in\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<p id=\"msgtext\"><strong>Επιτυχής ενεργοποίηση!</strong> Ο χρήστης με email <strong>".$email."</strong> ενεργοποιήθηκε επιτυχώς</p>
						</div>";
		} else {
			echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<p id=\"msgtext\"><strong>Προσοχή!</strong> Παρουσιάστηκε σφάλμα κατά την διαδικασία ανεργοποίησης του χρήστη με email ".$email. " </p>
				</div>";
		}
	} else {
		echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
						<p id=\"msgtext\"><strong>Προσοχή!</strong> Τα απαιτούμενα στοιχεία για την ενεργοποίηση του χρήστη με email ".$email. " είναι λανθασμένα</p>
				</div>";
	}
}
echo getFooter('gr');
?>
