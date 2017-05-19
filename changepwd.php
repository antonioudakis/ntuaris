<?php
session_start();
include 'ntuaris.php';
echo $header;
$validInput = false;
if (isset($_POST['oldpwd']) && !empty($_POST['oldpwd'])) {
	if (isset($_POST['pwd']) && !empty($_POST['pwd'])) {
		if (isset($_POST['pwdconfirm']) && !empty($_POST['pwdconfirm'])) {
			$validInput = true;
		}
	}
}
if (!$validInput) {
	echo getNavBar('gr');
	echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
					<p id=\"msgtext\"><strong>Προσοχή!</strong> Για να αλλαχθεί το συθηματικό πρόσβασης πρέπει να συμπληρωθούν το παλιό και το νέο συνθηματικό</p>
				</div>";
	echo getMenu($_SESSION['ntuarisUserID']);
} else {
	if  ($_POST['pwd']!=$_POST['pwdconfirm']) {
		echo getNavBar('gr');
		echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
					<p id=\"msgtext\"><strong>Προσοχή!</strong> Το νέο συνθηματικό είναι διαφορετικό από την επιβεβαίωση του νέου συνθηματικού πρόσβασης</p>
				</div>";
		echo getMenu($_SESSION['ntuarisUserID']);
	} else {
		
		// Check connection
		$conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);

		if (!$conn) {
			echo getNavBar('gr');
			echo getFooter('gr');
			die("Connection failed\n");
		}
		
		$strSQL = "select * from users where id = ".$_SESSION['ntuarisUserID']." and pwd = '".md5($_POST['oldpwd'])."'";
		$result = mysqli_query($conn, $strSQL);
		if (mysqli_num_rows($result) == 0) {
			echo getNavBar();
			echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<p id=\"msgtext\"><strong>Προσοχή!</strong> Το συνθηματικό πρόσβασης είναι διαφορετικό από τον παλιό συνθηματικό που δηλώσατε στη φόρμα αλλαγής συνθηματικού </p>
						</div>";
			echo getMenu($_SESSION['ntuarisUserID']);
		}  else {
			$strSQL = "update users set pwd = '".md5($_POST['pwd'])."' where id = ".$_SESSION['ntuarisUserID'];
			if (mysqli_query($conn, $strSQL)) {
				session_unset(); 
				session_destroy(); 
				echo getNavBar('gr');
				echo "	<div class=\"alert alert-success alert-dismissable fade in\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
								<p id=\"msgtext\"><strong>Επιτυχής καταχώριση!</strong> Έγινε επιτυχής αλλαγή του συνθηματικού πρόσβασης</p>
							</div>";
				echo getLoginForm('gr');
			} else {
				echo getNavBar('gr');
				echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
								<p id=\"msgtext\"><strong>Σφάλμα!</strong> Παρουσιάστηκε σφάλμα κατά την προσπάθεια ενημέρωσης του συνθηματικού </p>
							</div>";
				echo getMenu($_SESSION['ntuarisUserID']);
			}
		}
		mysqli_close($conn);
	}
}
echo getFooter('gr');
?>
