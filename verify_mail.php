<?php
	require_once 'Action.php';

	if (isset($_GET['mail']) && isset($_GET['user'])) {
		$user_mail = $_GET['mail'];
		$user_auth = $_GET['user'];
		$db = new db_class();

		$check_user = $db->check_user($user_mail);
		//echo "$user_mail, $user_auth";
		if ($check_user['valid'] != null) {
			//echo "$check_user[email]";
			$db->verify_user($user_mail);
			echo "<script>alert('Verification is successfull');</script>";
			echo "<script>location.href='index.php';</script>";
		} else {
			echo "Sorry you cannot be verified, sign up again.";
		}
		//echo "<script>alert('Verification is successfull');</script>";
		//echo "<script>location.href='index.php';</script>";
	}
?>