<?php
session_start();
include 'ntuaris.php';
echo $header;
if (!isset($_SESSION['ntuarisUserID'])) {
	$validInput = false;
	if (isset($_POST['username']) && !empty($_POST['username'])) {
		if (isset($_POST['pwd']) && !empty($_POST['pwd'])) {
			$validInput = true;
		}
	}

	if (!$validInput) {
		echo getNavBar('gr');
		echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
						<p id=\"msgtext\"><strong>Προσοχή!</strong> Πρέπει να συμπληρωθούν τα απαιτούμενα στοιχεία</p>
					</div>";
		echo $loginForm;
	} else {
		$username = $_POST["username"];
		$pwd = $_POST["pwd"];
		
		// Check connection
		$conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);

		if (!$conn) {
			echo getNavBar('gr');
			echo getFooter('gr');
			die("Connection failed\n");
		}

		$strSQL = "select * from users where username = '".$_POST['username']."' and pwd = '".md5($pwd)."'";
		$result = mysqli_query($conn, $strSQL);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			if ($row['active'] == 0){
				echo getNavBar('gr');
				echo "	<div class=\"alert alert-warning alert-dismissable fade in\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
								<p id=\"msgtext\"><strong>Σφάλμα!</strong> Δεν έχετε ενεργοποιήσει τον λογαριασμό. Ενεργοποιήστε τον λογαριασμό μέσω του συνδέσμου που σας έχει σταλεί στο ηλεκτρονικό σας ταχυδρομείο με διεύθυνση ".$row['email']."</p>
							</div>";
				echo $loginForm;
			} else {
				$_SESSION['ntuarisUserID'] = $row['id'];
				$_SESSION['ntuarisUser'] = $row['epvn'].' '.$row['onoma'];
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
				echo getNavBar('gr');
				echo getMenu($_SESSION['ntuarisUserID']);
			}
		} else {
			echo getNavBar('gr');
			echo"	<div class=\"alert alert-danger alert-dismissable fade in\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<p id=\"msgtext\"><strong>Σφάλμα!</strong> Το όνομα χρήστη ή ο κωδικός είναι λάθος</p>
						</div>";
			echo getLoginForm('gr');
		}
		mysqli_close($conn);
	}
} else {
	echo getNavBar('gr');
	echo getMenu($_SESSION['ntuarisUserID']);
}
echo getFooter('gr');
?>
