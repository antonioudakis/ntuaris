<?php
session_start();
include 'ntuaris.php';
echo $header;
echo getNavBar('gr');
if (!isset($_SESSION['ntuarisUserID'])) {
	echo "	<div class=\"alert alert-danger alert-dismissable fade in\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
					<p id=\"msgtext\"><strong>Σφάλμα!</strong> Πρέπει πρώτα να συνδεθείτε στο σύστημα</p>
				</div>";
	echo getLoginForm('gr');
} else {
	$validInput = false;
	if (isset($_POST['username']) && !empty($_POST['username'])) {
		if (isset($_POST['epvn']) && !empty($_POST['epvn'])) {
			if (isset($_POST['onoma']) && !empty($_POST['onoma'])) {
				if (isset($_POST['email']) && !empty($_POST['email'])) {
					$validInput = true;
				}
			}
		}
	}

	if (!$validInput) {
		echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
						<p id=\"msgtext\"><strong>Προσοχή!</strong> Πρέπει να συμπληρωθούν τα απαιτούμενα στοιχεία</p>
					</div>";
		echo getUpdateUserForm($_SESSION['ntuarisUserID']);
	} else {
		$username = $_POST["username"];
		$epvn = $_POST['epvn'];
		$onoma = $_POST['onoma'];
		$email = $_POST['email'];
		$role = $_POST['role'];
		$k_f = $_POST['k_f'];
		$k_tm = $_POST['k_tm'];

		// Check connection
		$conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);

		if (!$conn) {
			echo getFooter('gr');
			die("Connection failed\n");
		}

		$strSQL = "update users set username = '".$_POST['username']."',email = '".$_POST['email']."',epvn = '".$_POST['epvn']."',onoma ='".$_POST['onoma']."',role = ".$_POST['role']." where id = ".$_SESSION['ntuarisUserID'];
		mysqli_query($conn, $strSQL);
		if ($_POST['role']==1) {
			$strSQL = "delete from st_f where id = ".$_SESSION['ntuarisUserID'];
			mysqli_query($conn, $strSQL);
		} else {
			$strSQL = "select * from st_f where id = ".$_SESSION['ntuarisUserID'];
			$result = mysqli_query($conn, $strSQL);
			if (mysqli_num_rows($result) == 0) {
				$strSQL = "insert into st_f (id, k_f, k_tm) values (".$_SESSION['ntuarisUserID'].",'".$_POST['k_f']."',".$_POST['k_tm'].")";
			} else {
				$strSQL = "update st_f set k_f = '".$_POST['k_f']."',k_tm = ".$_POST['k_tm']." where id = ".$_SESSION['ntuarisUserID'];
			}
			mysqli_query($conn, $strSQL);
		}
		mysqli_close($conn);
		echo "	<div class=\"alert alert-success alert-dismissable fade in\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
						<p id=\"msgtext\"><strong>Επιτυχής καταχώριση!</strong> Τα στοιχεία του χρήστης με username <strong>".$_POST['username']."</strong> ενημερώθηκαν.</p>
					</div>
					<div>
						</br>
						<p align=\"center\">Πατήστε <a href='//".$host."loginForm.php'> εδώ </a> για να επιστρέψετe στην κεντρική σελίδα</p>
					</div>";
	}
}
echo getFooter('gr');
?>
