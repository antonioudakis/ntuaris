<?php
session_start();
session_unset(); 
session_destroy(); 
include 'ntuaris.php';
echo $header;
echo getNavBar('gr');
echo "	<div class=\"alert alert-success alert-dismissable fade in\">
				<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
				<p id=\"msgtext\"><strong>Επιτυχής αποσύνδεση!</strong> Έχετε αποσυνδεθεί από τις ηλεκτρονικές υπηρεσίες του Ε.Μ.Π.</p>
			</div>";
echo getLoginForm('gr');
echo getFooter('gr');
?>