<?php
$host = "147.102.213.13:8088/ntuaris/";
$dbhost = "localhost";
$port = "3302";
$dbname = "ntuaris";
$dbuser = "root";
$dbpwd = "p3l1c@n";
$conn_string = "host=".$dbhost." port=".$port." dbname=".$dbname." user=".$dbuser." password=".$dbpwd; 
			
$header = "	<!DOCTYPE html>
					<html lang=\"el\">
						<head>
							<title>ntuaris</title>
							<meta charset=\"utf-8\">
							<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
							<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
							<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js\"></script>
							<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>
							<script src=\"ntuaris.js\"></script>
							<style>
   
							/* Set black background color, white text and some padding */
	
							body {
								margin-bottom:50px;
							}
	
							footer {
								position:fixed;
								height:50px;
								left:0px;
								right:0px;
								bottom:0px;
								margin-bottom:0px;
								background-color: #555;
								color: white;
								padding: 10px;
							}
							
							form {
								border-style: solid;
								border-width: 1px;
								border-color: gray;
								padding: 10px;
								background-color: #f5f5ef;
							}
							
							</style>				
							
						</head>
						<body>";
						
$pwdModal = "	<!-- Modal -->
							<div class=\"modal fade\" id=\"pwdModal\" role=\"dialog\">
								<div class=\"modal-dialog\">
    
									<!-- Modal content-->
									<div class=\"modal-content\">
										<div class=\"modal-header\">
											<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
											<h4 class=\"modal-title\">Αλλαγή Συνθηματικού</h4>
										</div>
										<div class=\"modal-body\">
											<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\" style=\"display:none\">
												<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
												<p id=\"msgtext\"></p>
											</div>
											<form action=\"http://".$host."changepwd.php\" method=\"post\">
												<div class=\"form-group\">
													<label for=\"oldpwd\">Παλιό Συνθηματικό:</label>
													<input type=\"password\" class=\"form-control\" id=\"oldpwd\" placeholder=\"Εισαγωγή παλιού συνθηματικού\" name = \"oldpwd\">
												</div>
												<div class=\"form-group\">
													<label for=\"pwd\">Νέο Συνθηματικό:</label>
													<input type=\"password\" class=\"form-control\" id=\"pwd\" placeholder=\"Εισαγωγή νέου συνθηματικού\" size = \"25\" name = \"pwd\">
												</div>
												<div class=\"form-group\">
													<label for=\"pwdconfirm\">Επιβεβαίωση Συνθηματικού:</label>
													<input type=\"password\" class=\"form-control\" id=\"pwdconfirm\" placeholder=\"Επιβεβαίωση συνθηματικού\" size = \"25\" name = \"pwdconfirm\" onchange=\"pwdConfirmation() \">
												</div>
												<div align=\"right\">
													<button type=\"button\" class=\"btn btn-info\" data-dismiss=\"modal\">Άκυρο</button>
													<button type=\"submit\" class=\"btn btn-info\">Ενημέρωση</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>";
							
$pwdModalEng = "	<!-- Modal -->
							<div class=\"modal fade\" id=\"pwdModal\" role=\"dialog\">
								<div class=\"modal-dialog\">
    
									<!-- Modal content-->
									<div class=\"modal-content\">
										<div class=\"modal-header\">
											<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
											<h4 class=\"modal-title\">Change Password</h4>
										</div>
										<div class=\"modal-body\">
											<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\" style=\"display:none\">
												<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
												<p id=\"msgtext\"></p>
											</div>
											<form action=\"http://".$host."changepwd.php\" method=\"post\">
												<div class=\"form-group\">
													<label for=\"oldpwd\">Old Password:</label>
													<input type=\"password\" class=\"form-control\" id=\"oldpwd\" placeholder=\"Enter Old Password\" name = \"oldpwd\">
												</div>
												<div class=\"form-group\">
													<label for=\"pwd\">New Password:</label>
													<input type=\"password\" class=\"form-control\" id=\"pwd\" placeholder=\"Enter New Password\" size = \"25\" name = \"pwd\">
												</div>
												<div class=\"form-group\">
													<label for=\"pwdconfirm\">Confirm New Password:</label>
													<input type=\"password\" class=\"form-control\" id=\"pwdconfirm\" placeholder=\"Re-Enter New Password\" size = \"25\" name = \"pwdconfirm\" onchange=\"pwdConfirmation() \">
												</div>
												<div align=\"right\">
													<button type=\"button\" class=\"btn btn-info\" data-dismiss=\"modal\">Cancel</button>
													<button type=\"submit\" class=\"btn btn-info\">Submit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>";
							
function getFooter($lang) {
	if ($lang == 'eng') {
		$footer =	" 	<footer class=\"container-fluid text-center\">
								<p><img src=\"./img/pyrforos.png\" class=\"img-circle\" alt=\"pyrforos\" width=\"35\" height=\"35\">    I.T. Department N.T.U.A.</p>
							</footer>
						</body>
					</html>";
	} else {
		$footer =	" 	<footer class=\"container-fluid text-center\">
								<p><img src=\"./img/pyrforos.png\" class=\"img-circle\" alt=\"pyrforos\" width=\"35\" height=\"35\">    Διεύθυνση Πληροφορικής Ε.Μ.Π.</p>
							</footer>
						</body>
					</html>";
	}
	return $footer;
}

				
function sendEmailForm($type) {
	global $host;
	$emailForm = "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\" style=\"display:none\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
								<p id=\"msgtext\"></p>
							</div>";
	if ($type == 0) {
		$emailForm = $emailForm."
								<div class=\"container\">
									<h4>Υπενθύμιση Ονόματος Χρήστη</h4>
									<form action=\"http://".$host."reminder.php\" method=\"post\">
										<div class=\"form-group\">
											<p>Θα λάβετε το όνομα χρήστη στο email που δηλώσετε</p>
											<label for=\"email\"><span class=\"glyphicon glyphicon-envelope\"></span> Email χρήστη:</label>
											<input type=\"email\" class=\"form-control\" id=\"email\" placeholder=\"Εισαγωγή Email\" name = \"email\" onchange=\"emailValidation('email')\" autocomplete=\"on\">
										</div>
										<div align=\"right\">
											<input type=\"hidden\" class=\"form-control\" name = \"remind\" value=\"username\">
											<button type=\"button\" class=\"btn btn-info\" name=\"cancel\" value =\"cancel\" onClick=\"window.location='http://".$host."loginForm.php';\">Άκυρο</button>
											<button type=\"submit\" class=\"btn btn-info\">Αποστολή</button>
										</div>
									</form>
								</div>";
	} else {
		$emailForm = $emailForm."
								<div class=\"container\">
									<h4>Επαναφορά Συνθηματικού</h4>
									<form action=\"http://".$host."reminder.php\" method=\"post\">
										<div class=\"form-group\">
											<p>Θα λάβετε έναν προσωρινό κωδικό στο email που δηλώσετε</p>
											<label for=\"email\"><span class=\"glyphicon glyphicon-envelope\"></span> Email χρήστη:</label>
											<input type=\"email\" class=\"form-control\" id=\"email\" placeholder=\"Εισαγωγή Email\" name = \"email\" onchange=\"emailValidation('email') \">
										</div>
										<div align=\"right\">
											<input type=\"hidden\" class=\"form-control\" name = \"remind\" value=\"password\">
											<button type=\"button\" class=\"btn btn-info\" name=\"cancel\" value =\"cancel\" onClick=\"window.location='http://".$host."loginForm.php';\">Άκυρο</button>
											<button type=\"submit\" class=\"btn btn-info\">Αποστολή</button>
										</div>
									</form>
								</div>";
	}
	return $emailForm;
}

function getSignUpForm($type){
	global $host;
	if ($type == 0) {
		$signUpForm= "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\" style=\"display:none\">
									<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
									<p id=\"msgtext\"></p>
								</div>
								<div class=\"container\">
									<h4>Εισαγωγή Στοιχείων Νέου Χρήστη</h4>
									<form action=\"http://".$host."signUp.php\" method=\"post\">
										<div class=\"form-group\">
											<label for=\"username\">Όνομα χρήστη (username):</label>
											<input type=\"text\" class=\"form-control\" id=\"username\" placeholder=\"Εισαγωγή username\" name = \"username\">
										</div>
										<div class=\"form-group\">
											<label for=\"pwd\">Συνθηματικό:</label>
											<input type=\"password\" class=\"form-control\" id=\"pwd\" placeholder=\"Εισαγωγή συνθηματικού\" size = \"25\" name = \"pwd\">
										</div>
										<div class=\"form-group\">
											<label for=\"pwdconfirm\">Επιβεβαίωση Συνθηματικού:</label>
											<input type=\"password\" class=\"form-control\" id=\"pwdconfirm\" placeholder=\"Επιβεβαίωση συνθηματικού\" size = \"25\" name = \"pwdconfirm\" onchange=\"pwdConfirmation() \">
										</div>
										<div class=\"form-group\">
											<label for=\"epvn\">Επώνυμο χρήστη:</label>
											<input type=\"text\" class=\"form-control\" id=\"epvn\" placeholder=\"Εισαγωγή Επωνύμου\" name = \"epvn\" onkeyup=\"upperCase('epvn')\">
										</div>
										<div class=\"form-group\">
											<label for=\"onoma\">Όνομα χρήστη:</label>
											<input type=\"text\" class=\"form-control\" id=\"onoma\" placeholder=\"Εισαγωγή Ονόματος\" name = \"onoma\" onkeyup=\"upperCase('onoma')\">
										</div>
										<div class=\"form-group\">
											<label for=\"email\">Email χρήστη:</label>
											<input type=\"email\" class=\"form-control\" id=\"email\" placeholder=\"Εισαγωγή Email\" name = \"email\" onchange=\"emailValidation('email') \" autocomplete=\"on\">
										</div>
										<div class=\"form-group\">
											<label for=\"role\">Ρόλος χρήστη:</label>
											</br>
											<label class=\"radio-inline\"><input type=\"radio\" id =\"role\" name=\"role\" value = \"1\" onclick=\"display('k_tm','none');display('k_tm_label','none');display('k_f','none');display('k_f_label','none');clearInput('k_f')\">Υπάλληλος</label>
											<label class=\"radio-inline\"><input type=\"radio\" id =\"role\" name=\"role\" value = \"2\" checked onclick=\"display('k_tm','block');display('k_tm_label','block');display('k_f','block');display('k_f_label','block');\">Φοιτητής</label>
											<label class=\"radio-inline\"><input type=\"radio\" id =\"role\" name=\"role\" value = \"3\" onclick=\"display('k_tm','block');display('k_tm_label','block');display('k_f','block');display('k_f_label','block');\">Υπάλληλος & Φοιτητής</label>
										</div>
										<div class=\"form-group\">
											<label id=\"k_f_label\" for=\"k_f\">Μητρώο φοιτητή:</label>
											<input type=\"text\" class=\"form-control\" id=\"k_f\" placeholder=\"Εισαγωγή Μητρώου\" name = \"k_f\" maxlength=\"8\" onchange=\"k_fValidation('k_f')\">
										</div>
										<div class=\"form-group\">
											<label id=\"k_tm_label\" for=\"k_tm\">Σχολή Φοιτητή:</label>
											<select id=\"k_tm\" class=\"form-control\" name=\"k_tm\">
												<option value=\"0\">Καμία επιλογή...</option>
												<option value=\"1\">Σχολή Πολιτικών Μηχανικών</option>
												<option value=\"2\">Σχολή Μηχανολόγων Μηχανικών</option>
												<option value=\"3\">Σχολή Ηλεκτρολόγων Μηχανικών και Μηχανικών Υπολογιστών</option>
												<option value=\"4\">Σχολή Αρχιτεκτόνων Μηχανικών</option>	
												<option value=\"5\">Σχολή Χημικών Μηχανικών</option>
												<option value=\"6\">Σχολή Αγρονόμων και Τοπογράφων Μηχανικών</option>
												<option value=\"7\">Σχολή Μηχανικών Μεταλλείων Μεταλλουργών</option>
												<option value=\"8\">Σχολή Ναυπηγών Μηχανολόγων Μηχανικών</option>
												<option value=\"9\">Σχολή Εφαρμοσμένων Μαθηματικών και Φυσικών Επιστημών</option>
											</select>
										</div>
										<div align=\"right\">
											<button type=\"button\" class=\"btn btn-info\" name=\"cancel\" value =\"cancel\" onClick=\"window.location='http://".$host."loginForm.php';\">Άκυρο</button>
											<button type=\"submit\" class=\"btn btn-info\">Εγγραφή</button>
										</div>
									</form>
								</div>";
	} else {
		$signUpForm= "	<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\" style=\"display:none\">
									<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
									<p id=\"msgtext\"></p>
								</div>
								<div class=\"container\">
									<div>
										<div><h4><p>Εισαγωγή Στοιχείων Νέου Χρήστη</p></h4></div>
										<div class=\"well\">
											<form action=\"http://".$host."signUp.php\" method=\"post\">
												<div class=\"form-group\">
													<label for=\"username\">Username χρήστη:</label>
													<input type=\"text\" class=\"form-control\" id=\"username\" placeholder=\"Εισαγωγή username\" name = \"username\" value = \"".$_POST['username']."\">
												</div>
												<div class=\"form-group\">
													<label for=\"pwd\">Συνθηματικό:</label>
													<input type=\"password\" class=\"form-control\" id=\"pwd\" placeholder=\"Εισαγωγή συνθηματικού\" size = \"25\" name = \"pwd\">
												</div>
												<div class=\"form-group\">
													<label for=\"pwdconfirm\">Επιβεβαίωση Συνθηματικού:</label>
													<input type=\"password\" class=\"form-control\" id=\"pwdconfirm\" placeholder=\"Επιβεβαίωση συνθηματικού\" size = \"25\" name = \"pwdconfirm\" onchange=\"pwdConfirmation() \">
												</div>
												<div class=\"form-group\">
													<label for=\"epvn\">Επώνυμο χρήστη:</label>
													<input type=\"text\" class=\"form-control\" id=\"epvn\" placeholder=\"Εισαγωγή Επωνύμου\" name = \"epvn\" onkeyup=\"upperCase('epvn')\" value = \"".$_POST['epvn']."\">
												</div>
												<div class=\"form-group\">
													<label for=\"onoma\">Όνομα χρήστη:</label>
													<input type=\"text\" class=\"form-control\" id=\"onoma\" placeholder=\"Εισαγωγή Ονόματος\" name = \"onoma\" onkeyup=\"upperCase('onoma')\" value = \"".$_POST['onoma']."\">
												</div>
												<div class=\"form-group\">
													<label for=\"email\">Email χρήστη:</label>
													<input type=\"email\" class=\"form-control\" id=\"email\" placeholder=\"Εισαγωγή Email\" name = \"email\" onchange=\"emailValidation('email') \" value = \"".$_POST['email']."\" autocomplete=\"on\">
												</div>
												<div class=\"form-group\">
													<label for=\"role\">Ρόλος χρήστη:</label>
													</br>
													<label class=\"radio-inline\"><input type=\"radio\" id =\"role\" name=\"role\" value = \"1\" onclick=\"display('k_tm','none');display('k_tm_label','none');display('k_f','none');display('k_f_label','none');clearInput('k_f')\">Υπάλληλος</label>
													<label class=\"radio-inline\"><input type=\"radio\" id =\"role\" name=\"role\" value = \"2\" checked onclick=\"display('k_tm','block');display('k_tm_label','block');display('k_f','block');display('k_f_label','block');\">Φοιτητής</label>
													<label class=\"radio-inline\"><input type=\"radio\" id =\"role\" name=\"role\" value = \"3\" onclick=\"display('k_tm','block');display('k_tm_label','block');display('k_f','block');display('k_f_label','block');\">Υπάλληλος & Φοιτητής</label>
												</div>
												<div class=\"form-group\">
													<label id=\"k_f_label\" for=\"k_f\">Μητρώο φοιτητή:</label>
													<input type=\"text\" class=\"form-control\" id=\"k_f\" placeholder=\"Εισαγωγή Μητρώου\" name = \"k_f\" maxlength=\"8\" onchange=\"k_fValidation('k_f')\">
												</div>
												<div class=\"form-group\">
													<label id=\"k_tm_label\" for=\"k_tm\">Σχολή Φοιτητή:</label>
													<select id=\"k_tm\" class=\"form-control\" name=\"k_tm\">
														<option value=\"0\" selected>Καμία επιλογή...</option>
														<option value=\"1\">Σχολή Πολιτικών Μηχανικών</option>
														<option value=\"2\">Σχολή Μηχανολόγων Μηχανικών</option>
														<option value=\"3\">Σχολή Ηλεκτρολόγων Μηχανικών και Μηχανικών Υπολογιστών</option>
														<option value=\"4\">Σχολή Αρχιτεκτόνων Μηχανικών</option>
														<option value=\"5\">Σχολή Χημικών Μηχανικών</option>
														<option value=\"6\">Σχολή Αγρονόμων και Τοπογράφων Μηχανικών</option>
														<option value=\"7\">Σχολή Μηχανικών Μεταλλείων Μεταλλουργών</option>
														<option value=\"8\">Σχολή Ναυπηγών Μηχανολόγων Μηχανικών</option>
														<option value=\"9\">Σχολή Εφαρμοσμένων Μαθηματικών και Φυσικών Επιστημών</option>
													</select>
												</div>
												<button type=\"button\" class=\"btn btn-info\" name=\"cancel\" value =\"cancel\" onClick=\"window.location='http://".$host."loginForm.php';\">Άκυρο</button>
												<button type=\"submit\" class=\"btn btn-info\">Εγγραφή</button>
											</form>
										</div>
									</div>
								</div>";
	}
	return $signUpForm;
}

function getCookie($cookie_name){
	if (!isset($_COOKIE[$cookie_name])) {
		return null;
	} else {
		return $_COOKIE[$cookie_name];
	}
}

function setChecked($cookie_name){
	if (!isset($_COOKIE[$cookie_name])) {
		return null;
	} else {
		return "checked";
	}
}

function getRandomString($chars) {
	$str = "";
	$char;
	for ($i=0;$i<$chars;$i++) {
		$char=rand(0,61);
		if ($char<10) {
			$char += 48;
		} elseif ($char<36) {
			$char += 55;
		} else {
			$char += 61;
		}
		$str .= chr($char);
	}
	return $str;
}
	
function downloadFile($fname,$type,$txt){
	// $type == 0 pdf else csv
	global $host;
	if ($type == 0) {
		require('C:/PHP/tcpdf/tcpdf.php');
		$pdf = new TCPDF();
		//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->AddPage('P','A4');
		$pdf->SetFont('DejaVuSans', '', 12);
		$pdf->WriteHTML($txt);
		$pdf->Output($fname,'D');
	} else {
		$file = fopen($fname, "w") or die("Unable to open file!");
		fwrite($file, $txt);
		fclose($file);
		$file_url="http://".$host.$fname;

		header('Content-Encoding: UTF-8');
		header('Content-type: text/csv; charset=UTF-8');
		header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
		
		readfile($file_url);
	}
}

class User {
	private $host;
	private $dbhost;
	private $port;
	private $dbname;
	private $dbuser;
	private $dbpwd;
	private $id;
	private $username;
	private $pwd;
	private $hash;
	private $active;
	private $email;
	private $epvn;
	private $onoma;
	private $role;
	private $k_f;
	private $k_tm;
	private $lang ;
	
	function __construct(){
		global $host, $dbhost, $port, $dbname, $dbuser, $dbpwd;
		$this->host = $host;
		$this->dbhost = $dbhost;
		$this->port = $port;
		$this->dbname = $dbname;
		$this->dbuser = $dbuser;
		$this->dbpwd = $dbpwd;
		$this->lang = 'gr';
	}	
	
	function connect() {
		
		// Check connection
		$conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpwd, $this->dbname);
		
		return $conn;
	} 
	
	function disconnect($conn) {
		mysqli_close($conn);
	}
	
	function login($username, $pwd){
		$conn = $this->connect();
		if ($conn) {
			$strSQL = "select * from users where username = '".$username."' and pwd = '".md5($pwd)."'";
			$result = mysqli_query($conn, $strSQL);
			$this->id = null;
			if (mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_assoc($result);
				$this->id = $row['id'];
				$this->username = $row['username'];
				$this->pwd = $row['pwd'];
				$this->hash = $row['hash'];
				$this->active = $row['active'];
				$this->email = $row['email'];
				$this->epvn = $row['epvn'];
				$this->onoma = $row['onoma'];
				$this->role = $row['role'];
				
				$_SESSION['ntuarisUserID'] = $this->id;
				$_SESSION['ntuarisUser'] = $this->epvn.' '.$this->onoma;
				$_SESSION['ntuarisUserRole'] = $this->role;
				
		
				if ($this->isStudent()) {
					$strSQL = "select * from st_f where id = ".$this->id;
					$result = mysqli_query($conn, $strSQL);
					if (mysqli_num_rows($result) > 0) {
						$row = mysqli_fetch_assoc($result);
						$this->k_f = $row['k_f'];
						$this->k_tm = $row['k_tm'];
					}
				}
			}
			$this->disconnect($conn);
		}
	}
	
	function getUserDataByID() {
		if ($this->isConnected()) {
			$conn = $this->connect();
			if ($conn) {
				$strSQL = "select * from users where id = ".$_SESSION['ntuarisUserID'];
				$result = mysqli_query($conn, $strSQL);
				$this->id = null;
				if (mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_assoc($result);
					$this->id = $row['id'];
					$this->username = $row['username'];
					$this->pwd = $row['pwd'];
					$this->hash = $row['hash'];
					$this->active = $row['active'];
					$this->email = $row['email'];
					$this->epvn = $row['epvn'];
					$this->onoma = $row['onoma'];
					$this->role = $row['role'];
		
					if ($this->isStudent()) {
						$strSQL = "select * from st_f where id = ".$this->id;
						$result = mysqli_query($conn, $strSQL);
						if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_assoc($result);
							$this->k_f = $row['k_f'];
							$this->k_tm = $row['k_tm'];
						}
					}
				}
				$this->disconnect($conn);
			}
		}
	}
	
	function getUserDataByEmail($email) {
		$conn = $this->connect();
		if ($conn) {
			$strSQL = "select * from users where email = '".$email."'";
			$result = mysqli_query($conn, $strSQL);
			$this->id = null;
			if (mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_assoc($result);
				$this->id = $row['id'];
				$this->username = $row['username'];
				$this->pwd = $row['pwd'];
				$this->hash = $row['hash'];
				$this->active = $row['active'];
				$this->email = $row['email'];
				$this->epvn = $row['epvn'];
				$this->onoma = $row['onoma'];
				$this->role = $row['role'];
		
				if ($this->isStudent()) {
					$strSQL = "select * from st_f where id = ".$this->id;
					$result = mysqli_query($conn, $strSQL);
						if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_assoc($result);
							$this->k_f = $row['k_f'];
							$this->k_tm = $row['k_tm'];
						}
				}
			}
			$this->disconnect($conn);
		}
	}
	
	function getUserDataByUsername($username) {
		$conn = $this->connect();
		if ($conn) {
			$strSQL = "select * from users where username = '".$username."'";
			$result = mysqli_query($conn, $strSQL);
			$this->id = null;
			if (mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_assoc($result);
				$this->id = $row['id'];
				$this->username = $row['username'];
				$this->pwd = $row['pwd'];
				$this->hash = $row['hash'];
				$this->active = $row['active'];
				$this->email = $row['email'];
				$this->epvn = $row['epvn'];
				$this->onoma = $row['onoma'];
				$this->role = $row['role'];
		
				if ($this->isStudent()) {
					$strSQL = "select * from st_f where id = ".$this->id;
					$result = mysqli_query($conn, $strSQL);
						if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_assoc($result);
							$this->k_f = $row['k_f'];
							$this->k_tm = $row['k_tm'];
						}
				}
			}
			$this->disconnect($conn);
		}
	}
	
	function isConnected() {
		if (isset($_SESSION['ntuarisUserID'])) {
			return true;
		} else {
			return false;
		}
	}
	
	function getConnectedUserName() {
		if ($this->isConnected()) {
			return $_SESSION['ntuarisUser'];
		} else {
			return null;
		}
	}
	
	function isActive() {
		if ($this->active==0) {
			return false;
		} else {
			return true;
		}
	}
	
	function setLang($lang) {
		$this->lang = $lang;
	}
	
	function checkUserActivation($email, $hash) {
		
		$conn = $this->connect();
		if ($conn) {
			$strSQL = "select email,hash,active from users where email = '".$email."' and hash ='".$hash."' and active = 1";
			$result = mysqli_query($conn, $strSQL);
			if (mysqli_num_rows($result) > 0) {
				return 1;		//user is active
			} else {
				$strSQL = "select email,hash,active from users where email = '".$email."' and hash ='".$hash."' and active = 0";
				$result = mysqli_query($conn, $strSQL);
				if (mysqli_num_rows($result) > 0) {
					return 0;	//user is not active yet
				} else {
					return 2;	//there is no user with this email and hash code
				}
			}
			$this->disconnect($conn);
		} else {
			return 3;  		//can't connect to server
		}
	}
	
	function activateUser($email, $hash) {
		$conn = $this->connect();
		if ($conn) {
			$strSQL = "update users set active = 1 where email = '".$email."' and hash='".$hash."'";
			if (mysqli_query($conn, $strSQL)) {
				return true;
			} else {
				return false;
			}
			$this->disconnect($conn);
		} else {
			return false;
		}
	}
	
	function isStudent() {
		if ($this->role==1) {
			return false;
		} else {
			return true;
		}
	}
	
	function isEmployer() {
		if ($this->role==2) {
			return false;
		} else {
			return true;
		}
	}
	
	function getHost(){
		return $this->host;
	}
	
	function setPreferedLang($lang) {
		$this->lang = $lang;
	}
	
	function getId() {
		return $this->id;
	}
	
	function getEmail() {
		return $this->email;
	}
	
	function getUsername() {
		return $this->username;
	}
	
	function getPwd() {
		return $this->pwd;
	}
	
	function updatePwd($pwd){
		$conn = $this->connect();
		if ($conn) {
			$strSQL = "update users set pwd = '".md5($pwd)."' where id = ".$this->id;
			if (mysqli_query($conn, $strSQL)) {
				$this->pwd = md5($pwd);
				return true;
			} else {
				return false;
			}
			$this->disconnect($conn);
		} else {
			return false;
		}
	}
	
	function insertUser($username, $pwd, $active, $email, $epvn, $onoma, $role, $k_f, $k_tm) {
		$conn = $this->connect();
		if ($conn) {
			$strSQL = "insert into users(username,pwd,hash,active,email,epvn,onoma,role) values ('".$username."','".md5($pwd)."','".md5($email)."',0,'".$email."','".$epvn."','".$onoma."',".$role.");";
			if (mysqli_query($conn, $strSQL)) {
				if(($role==2)||($role==3)) {
					$user->getUserDataByUsername($username);
					$strSQL = "insert into st_f(id, k_f, k_tm) values (".$user->getId().",'".$k_f."',".$k_tm.")";
					if(mysqli_query($conn, $strSQL)) {
						$this->k_f = $k_f;
						$this->k_tm = $k_tm;
						return true;
					} else {
						return false;
					}
				}
				$this->id = $_SESSION['ntuarisUserID'];
				$this->username = $username;
				$this->email = $email;
				$this->evpn = $epvn;
				$this->onoma = $onoma;
				$this->role = $role;
				return true;
			} else {
				return false;
			}
			$this->disconnect($conn);
		} else {
			return false;
		}
	}
	
	function updateUser($username, $email, $epvn, $onoma, $role, $k_f, $k_tm) {
		if ($this->isConnected()) {
			$conn = $this->connect();
			if ($conn) {
				$strSQL = "update users set username = '".$username."',email = '".$email."',epvn = '".$epvn."',onoma ='".$onoma."',role = ".$role.", hash = '".md5($email)."' where id = ".$_SESSION['ntuarisUserID'];
				if (mysqli_query($conn, $strSQL)) {
					if (($role==2)||($role==3)) {
						$strSQL = "update st_f set k_f = '".$k_f."',k_tm = ".$k_tm." where id = ".$_SESSION['ntuarisUserID'];
						if(mysqli_query($conn, $strSQL)) {
							$this->k_f = $k_f;
							$this->k_tm = $k_tm;
							return true;
						} else {
							return false;
						}
					}
					$this->id = $_SESSION['ntuarisUserID'];
					$this->username = $username;
					$this->email = $email;
					$this->evpn = $epvn;
					$this->onoma = $onoma;
					$this->role = $role;
					return true;
				} else {
					return false;
				}
				$this->disconnect($conn);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	function getNavBar() {
	
		if ($this->lang == 'eng') {
			$navbar = "	<nav class=\"navbar navbar-inverse\">
									<div class=\"container-fluid\">
										<div class=\"navbar-header\">
											<button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#myNavbar\">
												<span class=\"icon-bar\"></span>
												<span class=\"icon-bar\"></span>
												<span class=\"icon-bar\"></span>                        
											</button>
											<a class=\"navbar-brand\" href=\"http://users.ntua.gr/tant/ntuaris/\">ntuaris</a>
										</div>
									<div class=\"collapse navbar-collapse\" id=\"myNavbar\">
										<ul class=\"nav navbar-nav navbar-right\">";
			if (!$this->isConnected()) {
				$navbar = $navbar."	<li><a href=\"http://".$this->getHost()."loginFormEng.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Sign in </a></li>
												<li><a href=\"http://".$this->getHost()."signUpForm.php\"><span class=\"glyphicon glyphicon-file\"></span> Sign up </a></li>
												<li><a href=\"http://".$this->getHost()."loginForm.php\"><img src=\"./img/Greece-icon.png\" ></li></a></li>
											</ul>
										</div>
									</div>
								</nav>";
			} else {
				global $pwdModalEng;
				$navbar = $navbar."	<li class = \"dropdown\"><a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"http://".$this->getHost()."login.php\"><span class=\"glyphicon glyphicon-user\"></span> " .$this->getConnectedUserName()." <span class=\"caret\"></span></a><ul class=\"dropdown-menu\">
													<li><a href=\"http://".$this->getHost()."updateUserForm.php\"><span class=\"glyphicon glyphicon-pencil\"> Append </span></a></li>
													<li><a href=\"#\" data-toggle=\"modal\" data-target=\"#pwdModal\"><span class=\"glyphicon glyphicon-pawn\"> Change Password </span></a></li>
													<li><a href=\"http://".$this->getHost()."logout.php\"><span class=\"glyphicon glyphicon-log-out\"> Logout </span></a></li></ul></li>
												<li><a href=\"http://".$this->getHost()."indexEng.html\"><img src=\"./img/Greece-icon.png\" ></li></a></li>
											</ul>
										</div>
									</div>
								</nav>";
				$navbar = $navbar.$pwdModalEng;
			}
		} else {
			$navbar = "	<nav class=\"navbar navbar-inverse\">
									<div class=\"container-fluid\">
										<div class=\"navbar-header\">
											<button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#myNavbar\">
												<span class=\"icon-bar\"></span>
												<span class=\"icon-bar\"></span>
												<span class=\"icon-bar\"></span>                        
											</button>
											<a class=\"navbar-brand\" href=\"http://users.ntua.gr/tant/ntuaris/\">ntuaris</a>
										</div>
									<div class=\"collapse navbar-collapse\" id=\"myNavbar\">
										<ul class=\"nav navbar-nav navbar-right\">";
			if (!$this->isConnected()) {
				$navbar = $navbar."	<li><a href=\"http://".$this->getHost()."loginForm.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Σύνδεση </a></li>
												<li><a href=\"http://".$this->getHost()."signUpForm.php\"><span class=\"glyphicon glyphicon-file\"></span> Εγγραφή </a></li>
												<li><a href=\"http://".$this->getHost()."loginFormEng.php\"><img src=\"./img/United-Kingdom-icon.png\" ></li></a></li>
											</ul>
										</div>
									</div>
								</nav>";
			} else {
				global $pwdModal;
				$navbar = $navbar."	<li class = \"dropdown\"><a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"http://".$this->getHost()."login.php\"><span class=\"glyphicon glyphicon-user\"></span> " .$this->getConnectedUserName()." <span class=\"caret\"></span></a><ul class=\"dropdown-menu\">
													<li><a href=\"http://".$this->getHost()."updateUserForm.php\"><span class=\"glyphicon glyphicon-pencil\"> Επεξεργασία </span></a></li>
													<li><a href=\"#\" data-toggle=\"modal\" data-target=\"#pwdModal\"><span class=\"glyphicon glyphicon-pawn\"> Αλλαγή Συνθηματικού </span></a></li>
													<li><a href=\"http://".$this->getHost()."logout.php\"><span class=\"glyphicon glyphicon-log-out\"> Έξοδος </span></a></li></ul></li>
												<li><a href=\"http://".$this->getHost()."indexEng.html\"><img src=\"./img/United-Kingdom-icon.png\" ></li></a></li>
											</ul>
										</div>
									</div>
								</nav>";
				$navbar = $navbar.$pwdModal;
			}
		}
		return $navbar;
	}
	
	function getLoginForm() {

		if ($this->lang == 'eng') {
			$loginForm = "	<div class=\"container text-center\">
								<div class=\"well well-sm row\">
									<div class=\"col-xs-4 text-right\">
										<img src=\"./img/pyrforos.png\" class=\"img-circle\" alt=\"pyrforos\" width=\"45\" height=\"45\">
									</div>
									<div class=\"col-xs-8 text-left\">
										<h4>Online Services of N.T.U.A</h4>
									</div>
								</div>
							</div>

							<div class=\"row\">
								<div class=\"col-xs-2\"></div>
								<div class=\"col-xs-8\">
									<h4>Login</h4></br>
									<form action=\"http://".$this->getHost()."login.php\" method=\"post\">
										<div class=\"form-group\">
											<label for=\"username\"><span class=\"glyphicon glyphicon-user\"></span> Username:</label>
											<input type=\"text\" class=\"form-control\" id=\"username\" placeholder=\"Enter Username\" size = \"35\" name = \"username\" value = \"".getCookie('ntuarisUser')."\">
										</div>
										<div class=\"form-group\">
											<label for=\"pwd\"><span class=\"glyphicon glyphicon-lock\"></span> Password:</label>
											<input type=\"password\" class=\"form-control\" id=\"pwd\" placeholder=\"Enter Password\" size = \"25\" name = \"pwd\" value = \"".getCookie('ntuarisPwd')."\">
										</div>
										<div class=\"checkbox\">
											<label><input type=\"checkbox\" name =\"remember\"".setChecked('ntuarisUser')."> Remember me</label>
										</div>
										<div>
											<a href=\"http://".$this->getHost()."usernamereminder.php\">Username Reminder</a></br>
											<a href=\"http://".$this->getHost()."pwdreminder.php\">Reset Password</a>
										</div>
										<div align=\"right\">
											<button type=\"submit\" class=\"btn btn-info\">Login</button>
										</div>
									</form>
								</div>
								<div class=\"col-xs-2\"></div>
							</div>";
		} else {
			$loginForm = "	<div class=\"container text-center\">
								<div class=\"well well-sm row\">
									<div class=\"col-xs-4 text-right\">
										<img src=\"./img/pyrforos.png\" class=\"img-circle\" alt=\"pyrforos\" width=\"45\" height=\"45\">
									</div>
									<div class=\"col-xs-8 text-left\">
										<h4>Ηλεκτρονικές Υπηρεσίες Ε.Μ.Π.</h4>
									</div>
								</div>
							</div>

							<div class=\"row\">
								<div class=\"col-xs-2\"></div>
								<div class=\"col-xs-8\">
									<h4>Σύνδεση Χρήστη</h4></br>
									<form action=\"http://".$this->getHost()."login.php\" method=\"post\">
										<div class=\"form-group\">
											<label for=\"username\"><span class=\"glyphicon glyphicon-user\"></span> Όνομα Χρήστη:</label>
											<input type=\"text\" class=\"form-control\" id=\"username\" placeholder=\"Εισαγωγή όνομα χρήστη (username)\" size = \"35\" name = \"username\" value = \"".getCookie('ntuarisUser')."\">
										</div>
										<div class=\"form-group\">
											<label for=\"pwd\"><span class=\"glyphicon glyphicon-lock\"></span> Συνθηματικό:</label>
											<input type=\"password\" class=\"form-control\" id=\"pwd\" placeholder=\"Εισαγωγή συνθηματικού\" size = \"25\" name = \"pwd\" value = \"".getCookie('ntuarisPwd')."\">
										</div>
										<div class=\"checkbox\">
											<label><input type=\"checkbox\" name =\"remember\"".setChecked('ntuarisUser')."> Να με θυμάσαι</label>
										</div>
										<div>
											<a href=\"http://".$this->getHost()."usernamereminder.php\">Υπενθύμιση Ονόματος Χρήστη</a></br>
											<a href=\"http://".$this->getHost()."pwdreminder.php\">Επαναφορά Συνθηματικού</a>
										</div>
										<div align=\"right\">
											<button type=\"submit\" class=\"btn btn-info\">Σύνδεση</button>
										</div>
									</form>
								</div>
								<div class=\"col-xs-2\"></div>
							</div>";
		} 
		return $loginForm;	
	}
	
	function getUpdateUserForm(){
	
		if (!$this->isConnected()) {
			return false;
		} else {
			$conn = $this->connect();
			if (!$conn) {
				return false;
			} else {
				$this->getUserDataById();
				if ($this->getId() == null) {
					$updateUserForm = "	<div class=\"alert alert-danger alert-dismissable fade in\">
														<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
														<p id=\"msgtext\"><strong>Σφάλμα!</strong> Δεν υπάρχει χρήστης με id = ".$_SESSION['ntuarisUserID']."</p>
													</div>";
				} else {
					$updateUserForm= "	
							<div id=\"msg\" class=\"alert alert-danger alert-dismissable fade in\" style=\"display:none\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
								<p id=\"msgtext\"></p>
							</div>
							<div class=\"container\">
								<div>
									<div><h4><p>Ενημέρωση Στοιχείων Χρήστη</p></h4></div>
									<div class=\"well\">
										<form action=\"http://".$this->getHost()."updateUser.php\" method=\"post\">
											<div class=\"form-group\">
												<label for=\"username\">Username χρήστη:</label>
												<input type=\"text\" class=\"form-control\" id=\"username\" placeholder=\"Εισαγωγή username\" name = \"username\" value = \"".$this->username."\">
											</div>
											<div class=\"form-group\">
												<label for=\"epvn\">Επώνυμο χρήστη:</label>
												<input type=\"text\" class=\"form-control\" id=\"epvn\" placeholder=\"Εισαγωγή Επωνύμου\" name = \"epvn\" onkeyup=\"upperCase('epvn')\" value = \"".$this->epvn."\">
											</div>
											<div class=\"form-group\">
												<label for=\"onoma\">Όνομα χρήστη:</label>
												<input type=\"text\" class=\"form-control\" id=\"onoma\" placeholder=\"Εισαγωγή Ονόματος\" name = \"onoma\" onkeyup=\"upperCase('onoma')\" value = \"".$this->onoma."\">
											</div>
											<div class=\"form-group\">
												<label for=\"email\">Email χρήστη:</label>
												<input type=\"email\" class=\"form-control\" id=\"email\" placeholder=\"Εισαγωγή Email\" name = \"email\" onchange=\"emailValidation('email') \" value = \"".$this->email."\" autocomplete=\"on\">
											</div>
											<div class=\"form-group\">
												<label for=\"role\">Ρόλος χρήστη:</label>
												</br>
												<label class=\"radio-inline\"><input type=\"radio\" id =\"role\" name=\"role\" value = \"1\" ";
					if ($this->role==1) {
						$updateUserForm .= "checked";
					}
					$updateUserForm .= " onclick=\"display('k_tm','none');display('k_tm_label','none');display('k_f','none');display('k_f_label','none');clearInput('k_f')\">Υπάλληλος</label>
												<label class=\"radio-inline\"><input type=\"radio\" id =\"role\" name=\"role\" value = \"2\" ";
					if ($this->role==2) {
						$updateUserForm .= "checked";
					}
					$updateUserForm .= " onclick=\"display('k_tm','block');display('k_tm_label','block');display('k_f','block');display('k_f_label','block');\">Φοιτητής</label>
												<label class=\"radio-inline\"><input type=\"radio\" id =\"role\" name=\"role\" value = \"3\" ";
					if ($this->role==3) {
						$updateUserForm .= "checked";
					}
					$updateUserForm .= " onclick=\"display('k_tm','block');display('k_tm_label','block');display('k_f','block');display('k_f_label','block');\">Υπάλληλος & Φοιτητής</label>
											</div>";
					
					$updateUserForm .= "<div class=\"form-group\">
														<label id=\"k_f_label\" for=\"k_f\">Μητρώο φοιτητή:</label>
														<input type=\"text\" class=\"form-control\" id=\"k_f\" placeholder=\"Εισαγωγή Μητρώου\" name = \"k_f\" maxlength=\"8\" onchange=\"k_fValidation('k_f')\" value=\"".$this->k_f."\">
													</div>
													<div class=\"form-group\">
														<label id=\"k_tm_label\" for=\"k_tm\">Σχολή Φοιτητή:</label>
														<select id=\"k_tm\" class=\"form-control\" name=\"k_tm\">
														<option value=\"0\" ";
													
					if (!$this->isStudent()) {
						$updateUserForm .= "selected";
					}
					$updateUserForm .= ">Καμία επιλογή...</option>
													<option value=\"1\" ";
					if ($this->k_tm==1) {
						$updateUserForm .= "selected";
					}
					$updateUserForm .= ">Σχολή Πολιτικών Μηχανικών</option>
													<option value=\"2\" ";
					if ($this->k_tm==2) {
						$updateUserForm .= "selected";
					}
					$updateUserForm .= ">Σχολή Μηχανολόγων Μηχανικών</option>
													<option value=\"3\" ";
					if ($this->k_tm==3) {
						$updateUserForm .= "selected";
					}
					$updateUserForm .= ">Σχολή Ηλεκτρολόγων Μηχανικών και Μηχανικών Υπολογιστών</option>
													<option value=\"4\" ";
					if ($this->k_tm==4) {
						$updateUserForm .= "selected";
					}
					$updateUserForm .= ">Σχολή Αρχιτεκτόνων Μηχανικών</option>
													<option value=\"5\" ";
					if ($this->k_tm==5) {
						$updateUserForm .= "selected";
					}
					$updateUserForm .= ">Σχολή Χημικών Μηχανικών</option>
													<option value=\"6\" ";
					if ($this->k_tm==6) {
						$updateUserForm .= "selected";
					}
					$updateUserForm .= ">Σχολή Αγρονόμων και Τοπογράφων Μηχανικών</option>
													<option value=\"7\" ";
					if ($this->k_tm==7) {
						$updateUserForm .= "selected";
					}
					$updateUserForm .= ">Σχολή Μηχανικών Μεταλλείων Μεταλλουργών</option>
													<option value=\"8\" ";
					if ($this->k_tm==8) {
						$updateUserForm .= "selected";
					}
					$updateUserForm .= ">Σχολή Ναυπηγών Μηχανολόγων Μηχανικών</option>
													<option value=\"9\" ";
					if ($this->k_tm==9) {
						$updateUserForm .= "selected";
					}
					$updateUserForm .= ">Σχολή Εφαρμοσμένων Μαθηματικών και Φυσικών Επιστημών</option>
												</select>
											</div>
											<button type=\"button\" class=\"btn btn-info\" name=\"cancel\" value =\"cancel\" onClick=\"window.location='http://".$this->getHost()."loginForm.php';\">Άκυρο</button>
											<button type=\"submit\" class=\"btn btn-info\">Ενημέρωση</button>
										</form>
									</div>
								</div>
							</div>";
					return $updateUserForm;
				}
				$this->disconnect($conn);
			}
		}
	}
	
	function getMenu() {

		if ($this->isConnected()) {	
			$this->getUserDataByID();
		}
	
		if ($this->id == null) {
			$menu = "	<div class=\"alert alert-danger alert-dismissable fade in\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
								<p id=\"msgtext\"><strong>Σφάλμα!</strong> Δεν υπάρχει σύνδεση. Πατήστε <a href=\"http://".$this->getHost()."loginForm.php\"> εδώ </a> για να συνδεθείτε</p>
							</div>";
		} else {
			if (($this->role == 1)||($this->role == 2)||($this->role == 3)) {
		
				$menu = "	<div class=\"container text-center\">
									<div class=\"well well-sm row\">
										<div class=\"col-xs-4 text-right\">
											<img src=\"./img/pyrforos.png\" class=\"img-circle\" alt=\"pyrforos\" width=\"45\" height=\"45\">
										</div>
										<div class=\"col-xs-8 text-left\">
											<h4>Ηλεκτρονικές Υπηρεσίες Ε.Μ.Π.</h4>
										</div>
									</div>
									<div class=\"container-fluid row\">";
				if ($this->isEmployer()) {
					$menu = $menu."	<div class=\"col-xs-4 text-right\">
													<a href=\"http://".$this->getHost()."underconstruction.php\"><img src=\"./img/statistics.jpg\" class=\"img-thumbnail\" height=\"65\" width=\"65\" alt=\"Statistics\"></a>
												</div>
												<div class=\"col-xs-8 text-left\">
													<h4><a href=\"http://".$this->getHost()."underconstruction.php\">Στατιστικά Στοιχεία Φοιτητολογίου</a></h4>
													</br>
												</div>";
				}
				if ($this->isStudent()) {
					$menu = $menu."	<div class=\"col-xs-4 text-right\">
													<a href=\"http://dasta1.ece.ntua.gr:8080/dastaReports\"><img src=\"./img/dasta.jpg\" class=\"img-thumbnail\" height=\"65\" width=\"65\" alt=\"Dasta\"></a>
												</div>
												<div class=\"col-xs-8 text-left\">
													<h4><a href=\"http://dasta1.ece.ntua.gr:8080/dastaReports\">Δομή Απασχόλησης & Σταδιοδρομίας</a></h4>
													</br>
												</div>
												<div class=\"col-xs-4 text-right\">
													<a href=\"http://".$this->getHost()."underconstruction.php\"><img src=\"./img/registration.jpg\" class=\"img-thumbnail\" height=\"65\" width=\"65\" alt=\"Registration\"></a>
												</div>
												<div class=\"col-xs-8 text-left\">
													<h4><a href=\"http://".$this->getHost()."underconstruction.php\">Εγγραφές & Δηλώσεις Μαθημάτων</a></h4>
													</br>
												</div>
												<div class=\"col-xs-4 text-right\">
													<a href=\"http://".$this->getHost()."underconstruction.php\"><img src=\"./img/certificate.jpg\" class=\"img-thumbnail\" height=\"65\" width=\"65\" alt=\"Certificate\"></a>
												</div>
												<div class=\"col-xs-8 text-left\">
													<h4><a href=\"http://".$this->getHost()."underconstruction.php\">Αιτήσεις Έκδοσης Πιστοποιητικών</a></h4>
													</br>
												</div>
												<div class=\"col-xs-4 text-right\">
													<a href=\"http://praktiki.ntua.gr/site/Eisodos.html\"><img src=\"./img/praxis.jpg\" class=\"img-thumbnail\" height=\"65\" width=\"65\" alt=\"Praxis\"></a>
												</div>
												<div class=\"col-xs-8 text-left\">
													<h4><a href=\"http://praktiki.ntua.gr/site/Eisodos.html\">Πρακτική Άσκηση Φοιτητών</a></h4>
													</br>
												</div>";
				}
				$menu = $menu."		</div>
											</div>";
			} else {
				$menu ="	<div class=\"alert alert-danger alert-dismissable fade in\">
									<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
									<p id=\"msgtext\"><strong>Σφάλμα!</strong> Δεν ορίστηκε αποδεκτός ρόλος στον χρήστη (Υπάλληλος - Φοιτητής - Υπάλληλος & Φοιτητής</p>
								</div>";
			}
		} 
		return $menu;
	}
}
?>