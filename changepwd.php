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
	echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
					<p id=\"msgtext\"><strong>Προσοχή!</strong> Για να αλλαχθεί το συθηματικό πρόσβασης πρέπει να συμπληρωθούν το παλιό και το νέο συνθηματικό</p>
				</div>";
	echo $user->getMenu();
} else {
	if  ($_POST['pwd']!=$_POST['pwdconfirm']) {
		echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
					<p id=\"msgtext\"><strong>Προσοχή!</strong> Το νέο συνθηματικό είναι διαφορετικό από την επιβεβαίωση του νέου συνθηματικού πρόσβασης</p>
				</div>";
		echo $user->getMenu();
	} else {
		
		$user->getUserDataByID();
		if ($user->getPwd() != md5($_POST['oldpwd'])) {
			echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<p id=\"msgtext\"><strong>Αποτυχία Αλλαγής Συνθηματικού!</strong> Το συνθηματικό πρόσβασης είναι διαφορετικό από τον παλιό συνθηματικό που δηλώσατε στη φόρμα αλλαγής συνθηματικού </p>
						</div>";
			echo $user->getMenu();
		}  else {
			if ($user->updatePwd($_POST['pwd'])) {	
				echo "	<div class=\"alert alert-success alert-dismissable fade in\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
								<p id=\"msgtext\"><strong>Επιτυχής καταχώριση!</strong> Έγινε επιτυχής αλλαγή του συνθηματικού πρόσβασης</p>
							</div>";
				echo $user->getMenu();
			} else {
				echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
								<p id=\"msgtext\"><strong>Σφάλμα!</strong> Παρουσιάστηκε σφάλμα κατά την προσπάθεια ενημέρωσης του συνθηματικού </p>
							</div>";
				echo $user->getMenu();
			}
		}
	}
}
echo getFooter('gr');
?>
