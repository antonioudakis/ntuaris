<?php
session_start();
session_unset(); 
session_destroy(); 
include 'ntuaris.php';
echo $header;
$user = new User();
echo $user->getNavBar();
$validInput = false;
if (isset($_POST['username']) && !empty($_POST['username'])) {
	if (isset($_POST['pwd']) && !empty($_POST['pwd'])) {
		if (isset($_POST['epvn']) && !empty($_POST['epvn'])) {
			if (isset($_POST['onoma']) && !empty($_POST['onoma'])) {
				if (isset($_POST['email']) && !empty($_POST['email'])) {
					$validInput = true;
				}
			}
		}
	}
}

if (!$validInput) {
	echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
					<p id=\"msgtext\"><strong>Προσοχή!</strong> Πρέπει να συμπληρωθούν τα απαιτούμενα στοιχεία</p>
				</div>";
	echo getSignUpForm(1);
} else {
	$user->getUserDataByUsername($_POST['username']);
	if ($user->getId() != null) {
		echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\" style=\"display:block\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
						<p id=\"msgtext\"><strong>Προσοχή!</strong> Το όνομα χρήστη (username) που δώσατε υπάρχει ήδη. Χρησιμοποιήστε διαφορετικό όνομα χρήστη</p>
					</div>";
		echo getSignUpForm(1);
	} else {
		$user->getUserDataByEmail($_POST['email']);
		if ($user->getId() != null) {
			echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\" style=\"display:block\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<p id=\"msgtext\"><strong>Προσοχή!</strong> Το email που δώσατε χρησιμοποιείται από άλλον χρήστη. Χρησιμοποιήστε διαφορετικό email</p>
						</div>";
			echo getSignUpForm(1);
		} else {
			if ($user->insertUser($_POST['username'], $_POST['pwd'], 0, $_POST['email'], $_POST['epvn'], $_POST['onoma'], $_POST['role'], $_POST['k_f'], $_POST['k_tm'])) {
				$to = $_POST['email'];
				$subject =	"User Activation";
				$hash = md5($_POST['email']);
				$message =	"<p>Ο λογαριασμός σας έχει δημιουργηθεί. Για να ενεργοποιηθεί ο λογαριασμός σας πατήστε στον παρακάτω σύνδεσμο:</p></br>
		
									<a href=\"http://".$host."activate.php?email=".$_POST['email']."&hash=".md5($_POST['email'])."\">http://".$host."activate.php?email=".$_POST['email']."&hash=".md5($_POST['email'])."</a>";

				$headers="From:tant@mail.ntua.gr\r\n"."Content-Type: text/html; charset=UTF-8\r\n";
				mail($to, $subject, $message, $headers);
				echo "	<div class=\"alert alert-success alert-dismissable fade in\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
								<p id=\"msgtext\"><strong>Επιτυχής καταχώριση!</strong> Ο χρήστης με username <strong>".$_POST['username']."</strong> και email <strong>".$_POST['email']."</strong> δημιουργήθηκε. Για να ενεργοποιηθεί διαβάστε το σχετικό email που σας έχει ήδη σταλεί.
							</div>";
			} else {
				echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\" style=\"display:block\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<p id=\"msgtext\"><strong>Προσοχή!</strong> Παρουσιάστηκε σφάλμα κατά την εισαγωγή των στοιχείων</p>
						</div>";
				echo getSignUpForm(1);
			}
		}
	}
}
echo getFooter('gr');
?>
