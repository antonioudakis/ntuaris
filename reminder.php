<?php
session_start();
session_unset(); 
session_destroy(); 
include 'ntuaris.php';
echo $header;
$user = new User();
echo $user->getNavBar();
$validInput = false;
if (isset($_POST['email']) && !empty($_POST['email'])) {
	if (isset($_POST['remind']) && !empty($_POST['remind'])) {
		$validInput = true;
	}
}

if (!$validInput) {
	echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
					<p id=\"msgtext\"><strong>Προσοχή!</strong> Δεν έχει δoθεί email για να σταλούν οι οδηγίες</p>
				</div>";
	if ($_POST['remind']=='username') {
		echo sendEmailForm(0);
	} elseif ($_POST['remind']=='password') {
		echo sendEmailForm(1);
	} else {
		echo $user->getLoginForm();
	}
} else {
	
	$user->getUserDataByEmail($_POST['email']);

	if ($user->getId() ==null) {
		echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\" style=\"display:block\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
						<p id=\"msgtext\"><strong>Προσοχή!</strong> Το email που δώσατε δεν αντιστοιχεί σε κάποιον χρήστη. Δοκιμάστε με διαφορετικό email</p>
					</div>";
		if ($_POST['remind']=='username') {
			echo sendEmailForm(0);
		} else {
			echo sendEmailForm(1);
		}
	} else {
		if ($_POST['remind']=='username') {
			$to = $_POST['email'];
			$subject =	"Username Reminder";
			$message =	"	<p>Το όνομα χρήστη που χρησιμοποιείται στις Ηλεκτρονικές Υπηρεσίες του Ε.Μ.Π είναι : <strong> ".$user->getUsername()."</strong></p></br>
									<p>Πατήστε <a href=\"http://".$user->getHost()."loginForm.php\"> εδώ </a> για να συνδεθείτε</p>";
			$headers="From:tant@mail.ntua.gr\r\n"."Content-Type: text/html; charset=UTF-8\r\n";
			mail($to, $subject, $message, $headers);
			echo "	<div class=\"alert alert-success alert-dismissable fade in\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<p id=\"msgtext\"><strong>Επιτυχής αποστολή!</strong> Έχουν σταλεί στο email <strong> ".$_POST['email']." </strong> οδηγίες για τη σύνδεση στο σύστημα.</p>
						</div>";
			echo $user->getLoginForm();
		} else {
			$to = $_POST['email'];
			$subject =	"Reset Password";
			$newPwd = getRandomString(8);
			$message =	"	<p>Ο προσωρινός σας κωδικός είναι ο : <strong> ".$newPwd." </strong> Ο παλιός κωδικός δεν λειτουργεί πλέον.</p>
									<p>Παρακαλώ πατήστε <a href=\"http://".$user->getHost()."loginForm.php\"> εδώ </a> για να συνδεθείτε και να ορίσετε ένεν νέο συνθηματικό το συντομότερο.</p>";
			$headers="From:tant@mail.ntua.gr\r\n"."Content-Type: text/html; charset=UTF-8\r\n";
			mail($to, $subject, $message, $headers);
			if ($user->updatePwd($newPwd)) {
				echo "	<div class=\"alert alert-success alert-dismissable fade in\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
								<p id=\"msgtext\"><strong>Επιτυχής αποστολή!</strong> Έχουν σταλεί στο email <strong> ".$_POST['email']." </strong>οδηγίες για τη σύνδεση στο σύστημα.</p>
							</div>";
			} else {
				echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\" style=\"display:block\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
								<p id=\"msgtext\"><strong>Σφάλμα!</strong> Προέκυψε σφάλμα κατά την διαδικασία ενημέρωσης της βάσης με το νέο συνθηματικό</p>
							</div>";
			}
			echo $user->getLoginForm();
		}
	}
}
echo getFooter('gr');
?>
