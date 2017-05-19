<?php
session_start();
session_unset(); 
session_destroy(); 
include 'ntuaris.php';
echo $header;
echo getNavBar('gr');
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
	$username = $_POST["username"];
	$pwd = $_POST["pwd"];
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

	$strSQL = "select * from users where username = '".$_POST['username']."'";
	$result = mysqli_query($conn, $strSQL);
	if (mysqli_num_rows($result) > 0) {
		echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\" style=\"display:block\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
						<p id=\"msgtext\"><strong>Προσοχή!</strong> Το όνομα χρήστη (username) που δώσατε υπάρχει ήδη. Χρησιμοποιήστε διαφορετικό όνομα χρήστη</p>
					</div>";
		echo getSignUpForm(1);
	} else {
		$strSQL = "select * from users where email = '".$_POST['email']."'";
		$result = mysqli_query($conn, $strSQL);
		if (mysqli_num_rows($result) > 0) {
			echo "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\" style=\"display:block\">
							<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
							<p id=\"msgtext\"><strong>Προσοχή!</strong> Το email που δώσατε χρησιμοποιείται από άλλον χρήστη. Χρησιμοποιήστε διαφορετικό email</p>
						</div>";
			echo getSignUpForm(1);
		} else {
			$strSQL = "insert into users(username,pwd,hash,active,email,epvn,onoma,role) values ('".$_POST['username']."','".md5($_POST['pwd'])."','".md5($_POST['email'])."',0,'".$_POST['email']."','".$_POST['epvn']."','".$_POST['onoma']."',".$_POST['role'].");";
			if (mysqli_query($conn, $strSQL)) {
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
			}
			if ($_POST['role']!=1) {
				$strSQL = "select id from users where email = '".$_POST['email']."'";
				$result = mysqli_query($conn, $strSQL);
				if (mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_assoc($result);
					$strSQL = "insert into st_f(id, k_f, k_tm) values (".$row['id'].",'".$_POST['k_f']."',".$_POST['k_tm'].")";
					mysqli_query($conn, $strSQL);
				}
			}
		}
	}
	mysqli_close($conn);
}
echo getFooter('gr');
?>
