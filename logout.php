<?php
	session_start();
	/*session_unset('fullname');
	session_unset('email');
	session_unset($_SESSION['address']);
	session_unset($_SESSION['phone']);*/
	session_destroy();
	header('location: index.php')
?>