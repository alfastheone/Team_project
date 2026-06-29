
<?php
	require_once 'Action.php';

	if (isset($_POST['signup'])){
		$fullname = $_POST['fullname'];
		$mobile = $_POST['mobile'];
		$email = $_POST['mail'];
		$code = $_POST['code'];
		$address = $_POST['address'];
		$db = new db_class();

		$is_verified = $db->verify_mail($email, "siginup");
		
		if ($is_verified) {
			//echo "<script>alert('A mail has been sent to you.\nAlso check your spam box.');</scrip>";
			$sign = $db->signup_student($fullname, $mobile, $email, $code, $address);
			//echo "<script>location.href='?verify_mail';</script>";
			if ($sign){
				echo "<script>location.href='?verify_mail';</script>";
			} else {
					echo "<script>alert('Oops! An error occur There an account that exist with the same email.');</script>";
					echo "<script>location.href='index.php';</script>";
				}

		} else {
			echo"<script>alert('Oops! An error occur trying to verify your email Please Try again.')</script>";
			echo"<script>window.location='user.php'</script>";
		}
	}

	if(isset($_GET['verify_mail'])){
		/*echo "<center><div style='
				background-color:blue;
				color:white;
				padding:5%;
				width:25%;
				font-size:120%;
				font-family: sans-serif;
				border-bottom-left-radius: 40%;
				border-bottom-right-radius: 40%;
				border-top-left-radius: 10%;
				border-top-right-radius:10%;
		'>
		<h2>A mail has been sent to you.<br>Also check your spam box.</h2>";*/

		echo "<script>alert('A mail has been sent to you. Also check your spam box.');</script>";
		echo "<script>location.href='index.php';</script>";
	}

	if (isset($_GET['resend'])){
		$db = new db_class();

		if($db->verify_mail($_GET['resend'], "siginup") == true){;

		//if ($verified['valid'] == 0) {
			echo "<script>alert('A resend was successfull, Please check you inbox and spam');</script>";
			echo"<script>location.href='index.php?login';</script>";
		} else {
			echo"<script>alert('Oops! An error occur trying to verify your email Please Try again.')</script>";
		}
	}

	if (isset($_POST['login'])){
		$db = new db_class();
		$user_form = $_POST['mail'];
		$pass = $_POST['code'];

		//echo "$user $pass";

		$verified = $db->is_verified($user_form);
		$mssg = "";

		if ($verified['valid'] == 0) {
			//echo "string";			
			echo "<center><div style='
						background-color:blue;
						color:white;
						padding:5%;
						width:25%;
						font-size:120%;
						font-family: sans-serif;
						border-bottom-left-radius: 40%;
						border-bottom-right-radius: 40%;
						border-top-left-radius: 10%;
						border-top-right-radius:10%;
				'><p>Sorry, you have not yet verified your email</p><p>Please verify or <a href='?resend=$user_form' style='color:black'>click here</a> to resend verification again.</p></div></center>";
		}

		if ($verified['valid'] == 1) {
			$user = $db->check_user($user_form);
			//echo "$user[email] pass: $user[code]<br>";
			//echo "$user_form pass: $pass";

			if ($user['valid'] != null) {
				if (($user['email'] == $user_form) && ($user['code'] == MD5($pass))) {
					/*$db->verify_mail($user_form, "login");
					echo "<meta name='viewport' content='width=device-width, initial-scale=1'>
						<form method='POST' action=''>
							<h3>Enter the code you recieved in your email below.</h3>
							<small><i>NOTE: Also check your spam box.</i></small>
							<input type='text' name='fcode'><br>
							<input type='text' name='fuser' hidden value='$user[email]'><br>
							<input type='submit' name='final_login' value='LOGIN'><br>
							<a href=''>click here to resent mail</a>
						</form>";*/
						session_start();
						$_SESSION['fullname'] = $user['fullname'];
						$_SESSION['email'] = $user['email'];
						$_SESSION['address'] = $user['address'];
						$_SESSION['phone'] = $user['phone'];

						echo "<script>location.href='home.php?section=Dashboard';</script>";

				} else {
					echo "<script>alert('Wrong username or password');</script>";
					echo "<script>location.href='index.php?login';</script>";
				}
			}
			//echo "<script>alert('Welcome user');</script>";
			//echo "<script>location.href='home.php';</script>";
		}

		if ($verified['valid'] == 5) {
			echo "<p>Sorry, you have not sign up yet please sign up before login</p>";
		}

		//echo "<script>alert('hello');</script>";
	}

	if (isset($_POST['reset'])){
		$db = new db_class();
		$reset_mail = $_POST['mail'];
		
		$verified = $db->is_verified($reset_mail);

		if ($verified['result'] == 1) {
			$db->verify_mail($reset_mail, "login");

			echo "<meta name='viewport' content='width=device-width, initial-scale=1'>
				<form method='POST' action=''>
					<h3>Enter the code you recieved in your email below.</h3>
					<small><i>NOTE: Also check your spam box.</i></small>
					<input type='text' name='fcode' placeholder='Enter verification code here'><br>
					<input type='password' name='fcode1' id='passcode2' placeholder='New password'><br>
					<input type='password' name='fcode2' oninput=\"verify_password2(this)\" id='cfcode' placeholder='confirm new password'><br>
					<input type='text' name='fuser' hidden value='$reset_mail'><br>
					<input type='submit' name='final_login' value='RESET' class='button2'><br>
					<a href=''>click here to resent mail</a>
				</form>";
		} else {
			echo "<script>alert('Sorry it seems like the email ($reset_mail) is not found in the system.');</script>";
			echo "<script>location.href='index.php?reset';</script>";
		}
	}

	if (isset($_POST['final_login'])) {
		$fuser = $_POST['fuser'];
		$fcode = $_POST['fcode'];
		$fcode1 = $_POST['fcode1'];
		$db = new db_class();

		$final_check = $db->is_verified($fuser);

		if ($final_check['otp_verify'] == $fcode) {
			if($db->update_password($fuser, $fcode1)) echo "reset was successfull, please proceed to login";
			else echo "Oops! something went wrong, please try again.";
		} else {
			echo "Wrong OTP code.";
		}
	}

	/*if (isset($_POST['final_login'])) {
		$fuser = $_POST['fuser'];
		$fcode = $_POST['fcode'];
		$db = new db_class();

		$final_check = $db->is_verified($fuser);

		if ($final_check['otp_verify'] == $fcode) {
			$sess = $db->check_user($fuser);

			session_start();
			$_SESSION['fullname'] = $sess['fullname'];
			$_SESSION['email'] = $sess['email'];
			$_SESSION['address'] = $sess['address'];
			$_SESSION['phone'] = $sess['phone'];

			echo "<script>location.href='home.php?section=Dashboard';</script>";

		} else {
			echo "<script>alert('Wrong otp');</script>";
			echo "<meta name='viewport' content='width=device-width, initial-scale=1'>
						<form method='POST' action=''>
							<h3 style='color:red'>Renter the code you recieved in your email below.</h3>
							<small><i>NOTE: Also check your spam box.</i></small>
							<input type='text' name='fcode'><br>
							<input type='text' name='fuser' hidden value='$fuser'><br>
							<input type='submit' name='final_login' value='LOGIN'><br>
							<a href=''>click here to resent mail</a>
						</form>";
		}
	}*/
	/*if (isset($_POST['signup'])) {
		echo "post";
	} else if(isset($_REQUEST['signup'])){
		echo "request";
	} else {
		echo "none";
	}*/
	if (isset($_POST['register'])) {
		$fname = $_POST['fname'];
		$sname = $_POST['sname'];
		$phone = $_POST['mobile'];
		$email = $_POST['mail'];
		$dob = $_POST['dob'];
		$addr = $_POST['address'];
		$sex = $_POST['gender'];
		$db = new db_class();

		if ($db->register($fname, $sname, $phone, $email, $dob, $addr, $sex)) {
			echo "<script>alert('Dear $fname $sname, Your Application has been submitted successfully.');</script>";
			echo "<script>location.href='home.php?section=form';</script>";
		} else {
			echo "<script>alert('Oops! Something went wrong please try again later.');</script>";
			//echo "<script>location.href='home.php?section=form';</script>";
		}
	}
?>
<script type="text/javascript">
	function verify_password2(code){
		var n = code.value;
		var nn = passcode2.value;
		var b = document.getElementsByClassName('button2');
		if (n!=nn) {
			cfcode.style.color = 'red';
			//document.getElementsByTagName('i')[0].style.display='block';
			b[0].setAttribute("disabled","true");
			//b[0].classList.remove("bstyle");
		} else {
			cfcode.style.color = 'white';
			document.getElementsByTagName('i')[0].style.display='none';
			b[0].removeAttribute("disabled","true");
			//b[0].classList.add("bstyle");
		}
	}
</script>