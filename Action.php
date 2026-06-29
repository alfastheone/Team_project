<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require_once'config.php';
	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';
	
	class db_class extends db_connect{
		
		public function __construct(){
			$this->connect();
		}
		
		public function verify_mail($user_email, $type){

			$mail = new PHPMailer(true);
			$hash = md5('$user_email');
			$verify_link = "http://82.101.139.187/team_project/verify_mail.php?user=$hash&mail=$user_email";
			$code = mt_rand(1,99999999);

			try{
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'lawal.abdulhamid@udusok.edu.ng';
				$mail->Password = 'dpugyswkabmmnkck';
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;
				$mail->setFrom('lawal.abdulhamid@udusok.edu.ng', 'Verify Email Address');
				$mail->addAddress($user_email, "Email Verification");
				$mail->isHTML(true);
				$mail->Subject = 'New Email Verification';
				if ($type == "login"){
					$this->conn->query("UPDATE `users` SET `otp` = '$code' WHERE `email` = '$user_email'");
					$mail->Body = "Please get your verification code here <h1>$code</h1>";
				} 

				if ($type == "siginup"){
					$mail->Body = "Hi New user, kindly confirm this action is done by you, please click the button below to verify.<br><br> <html><a href=\"$verify_link\" style='background-color:#007bff;color:white;padding:10px 20px;text-decoration:none;border-radius:5px;'>Verify Email</a><br><br>";
				}
				//$mail->Body = "It worked";
				$mail->send();
				return true;
			} catch (Exception $e){
				return "Error:{$mail->ErrorInfo}";
			}
		}

		public function signup_student($fullname, $mobile, $email, $code, $address)
		{
			$check = $this->conn->prepare("SELECT `email` FROM `users` WHERE `email` = '$email'") or die($this->conn->error);

			if ($check->execute()) {
				$result = $check->get_result();
				$result2 = $result->num_rows;
				//$fetch = $result->fetch_array();

				/*return array('result2'=>"$result2",
								'f3'=>"$fetch[email]",
								'f4'=>"$address"
							);*/
				if ($result2 == 0) {
					$check->close();
					$query = $this->conn->prepare("INSERT INTO `users`(`fullname`,`phone`,`email`,`address`,`password`) VALUES ('$fullname', '$mobile', '$email', '$address',md5('$code'))");// or die($this->conn->error);
					//$query->bind_param("ssssss","$fullname","$mobile","$email","$address","$code","f");

					if ($query->execute()) {
						$query->close();
						$this->conn->close();
						return true;
					} else {return false;}
				} else {
					return false;
				} 

			} else {
				return false;
			}
			
			//echo "$fullname, $mobile, $email, $code, $address";
		}

		public function verify_user($value)
		{
			$query = $this->conn->prepare("UPDATE `users` SET `is_verified` = '1' WHERE `email` = '$value' ") or die($this->conn->error);
			//$query->bind_param("is", 1, $value);
			if ($query->execute()) {
				$query->close();
				return true;
			}


		}

		public function check_user($value)
		{
			$query = $this->conn->prepare("SELECT * FROM `users` WHERE `email` = '$value'") or die($this->conn->error);

			if ($query->execute()) {
				$result1 = $query->get_result();
				$result2 = $result1->num_rows;
				$fetch = $result1->fetch_array();

				return array(
					'valid'=>isset($result2) ? $result2 : null,
					'code'=>isset($fetch['password']) ? $fetch['password'] : null,
					'email' => isset($fetch['email']) ? $fetch['email'] : 5,
					'fullname' => isset($fetch['fullname']) ? $fetch['fullname'] : null,
					'phone' => isset($fetch['phone']) ? $fetch['phone'] : null,
					'address' => isset($fetch['address']) ? $fetch['address'] : null,
					'id' => isset($fetch['sn']) ? $fetch['sn'] : null
				);
			} else {
				return array('valid'=>null);
			}
		}

		public function is_verified($user)
		{
			$check_mail = $this->conn->prepare("SELECT * FROM `users` WHERE `email` = '$user'") or die($this->conn->error);

			if ($check_mail->execute()) {
				$result1 = $check_mail->get_result();
				$result2 = $result1->num_rows;
				$fetch = $result1->fetch_array();

				return array(
					'result' => $result2,
					'valid' => isset($fetch['is_verified']) ? $fetch['is_verified'] : 5,
					'otp_verify' => isset($fetch['otp']) ? $fetch['otp'] : 0);
			} else {
				return false;
			}
		}
		public function update_password($value1, $value2)
		{
			$query = $this->conn->prepare("UPDATE `users` SET `password` = MD5('$value2') WHERE `email` = '$value1' ") or die($this->conn->error);
			//$query->bind_param("is", 1, $value);
			if ($query->execute()) {
				$query->close();
				return true;
			} else {
				return false;
			}
		}
		public function register($fname, $sname, $phone, $email, $dob, $addr, $sex)
		{
			$user_id = $this->check_user($email);

			$query = $this->conn->prepare("INSERT INTO `application`(`users_id`, `fname`, `sname`, `dob`, `gander`, `phone`,`email`,`address`) VALUES ('$user_id[id]','$fname', '$sname', '$dob', '$sex', '$phone', '$email', '$addr')");// or die($this->conn->error);
					//$query->bind_param("ssssss","$fullname","$mobile","$email","$address","$code","f");

			if ($query->execute()) {
				$query->close();
				$this->conn->close();
				return true;
			} else {return false;}

		}

		public function display_form($value)
		{
			// code...
		}
	}
?>	