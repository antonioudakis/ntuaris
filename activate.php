<?php
session_start();
session_unset(); 
session_destroy(); 
include 'ntuaris.php';
echo $header;
echo getNavBar('gr');
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
	$email = $_GET["email"];
	$hash = $_GET["hash"];
		// Check connection
	$conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);

	if (!$conn) {
		die("Connection failed\n");
	}

	$strSQL = "select email,hash,active from users where email = '".$email."' and hash ='".$hash."' and active = 1";
	$result = mysqli_query($conn, $strSQL);
	if (mysqli_num_rows($result) > 0) {
		echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
						<p id=\"msgtext\"><strong>Προσοχή!</strong> Ο χρήστης με email ".$email. " έχει ήδη ενεργοποιηθεί</p>
					</div>";
	} else {
		$strSQL = "select email,hash,active from users where email = '".$email."' and hash ='".$hash."' and active = 0";
		$result = mysqli_query($conn, $strSQL);
		if (mysqli_num_rows($result) > 0) {
			$strSQL = "update users set active = 1 where email = '".$email."' and hash='".$hash."'";
			if (mysqli_query($conn, $strSQL)) {
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
	mysqli_close($conn);
}
echo getFooter('gr');
?>
