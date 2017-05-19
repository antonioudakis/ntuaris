<?php
session_start();
session_unset(); 
session_destroy(); 
include 'ntuaris.php';
echo $header;
echo getNavBar('gr');
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
		echo getLoginForm('gr');
	}
} else {

	// Check connection
	$conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);

	if (!$conn) {
		echo getFooter('gr');
		die("Connection failed\n");
	}

	$strSQL = "select * from users where email = '".$_POST['email']."'";
	$result = mysqli_query($conn, $strSQL);
	if (mysqli_num_rows($result) == 0) {
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
		$row = mysqli_fetch_assoc($result);
		if ($_POST['remind']=='username') {
			$to = $_POST['email'];
			$subject =	"Username Reminder";
			$message =	"	<p>Το όνομα χρήστη που χρησιμοποιείται στις Ηλεκτρονικές Υπηρεσίες του Ε.Μ.Π είναι : <strong> ".$row['username']."</strong></p></br>
									<p>Πατήστε <a href=\"http://".$host."loginForm.php\"> εδώ </a> για να συνδεθείτε</p>";
			$headers="From:tant@mail.ntua.gr\r\n"."Content-Type: text/html; charset=UTF-8\r\n";
			mail($to, $subject, $message, $headers);
			echo "	<div class=\"alert alert-success alert-dismissable fade in\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<p id=\"msgtext\"><strong>Επιτυχής αποστολή!</strong> Έχουν σταλεί στο email <strong> ".$_POST['email']." </strong> οδηγίες για τη σύνδεση στο σύστημα.</p>
						</div>";
			echo getLoginForm('gr');
		} else {
			$to = $_POST['email'];
			$subject =	"Reset Password";
			$newPwd = getRandomString(8);
			$message =	"	<p>Ο προσωρινός σας κωδικός είναι ο : <strong> ".$newPwd." </strong> Ο παλιός κωδικός δεν λειτουργεί πλέον.</p>
									<p>Παρακαλώ πατήστε <a href=\"http://".$host."loginForm.php\"> εδώ </a> για να συνδεθείτε και να ορίσετε ένεν νέο συνθηματικό το συντομότερο.</p>";
			$headers="From:tant@mail.ntua.gr\r\n"."Content-Type: text/html; charset=UTF-8\r\n";
			mail($to, $subject, $message, $headers);
			$strSQL = "update users set pwd = '".md5($newPwd)."' where email = '".$_POST['email']."';";
			if (mysqli_query($conn, $strSQL)) {
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
			echo getLoginForm('gr');
		}
	}
	mysqli_close($conn);
}
echo getFooter('gr');
?>
