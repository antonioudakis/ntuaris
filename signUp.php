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
	$user->showMessage("alert-danger","<strong>Προσοχή!</strong> Πρέπει να συμπληρωθούν τα απαιτούμενα στοιχεία");
	echo getSignUpForm(1);
} else {
	$user->getUserDataByUsername($_POST['username']);
	if ($user->getId() != null) {
		$user->showMessage("alert-danger","<strong>Προσοχή!</strong> Το όνομα χρήστη (username) που δώσατε υπάρχει ήδη. Χρησιμοποιήστε διαφορετικό όνομα χρήστη");
		echo getSignUpForm(1);
	} else {
		$user->getUserDataByEmail($_POST['email']);
		if ($user->getId() != null) {
			$user->showMessage("alert-danger","<strong>Προσοχή!</strong> Το email που δώσατε χρησιμοποιείται από άλλον χρήστη. Χρησιμοποιήστε διαφορετικό email");
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
				$user->showMessage("alert-success","<strong>Επιτυχής καταχώριση!</strong> Ο χρήστης με username <strong>".$_POST['username']."</strong> και email <strong>".$_POST['email']."</strong> δημιουργήθηκε. Για να ενεργοποιηθεί διαβάστε το σχετικό email που σας έχει ήδη σταλεί.");
			} else {
				$user->showMessage("alert-warning","<strong>Σφάλμα!</strong> Παρουσιάστηκε σφάλμα κατά την εισαγωγή των στοιχείων");
				echo getSignUpForm(1);
			}
		}
	}
}
echo getFooter('gr');
?>
