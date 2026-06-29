<?php session_start(); if (isset($_SESSION['email'])) {
	echo "<script>location.href='home.php?section=Dashboard';</script>";
}?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.1">
	<title>STUDENT APP | Sign up</title>
	<style type="text/css">
		#home{
			font-family: Arial, Helvetica, sans-serif;
		}
		.nav{
			background-color: whitesmoke;
			width: 100%;
			position: fixed;
			padding: 4% 0%;
			top: 0;
			left: 0;
			buttom:0;
			box-shadow: 0px -10px 20px 0px;
		}
		input{
			width: 90%;
			padding: 5px 15px;
			border-radius: 10px;
			font-size: 120%;
		}
		table tr td span, h2 {
			color: white;
		}
		.form_div, .form_div2{
			position: absolute;
			top:0;
			left: 0;
			width: 100%;
			height: 100%;
			display: flex;
			justify-content: center;
		}
		.form_div2{
			z-index: 6;
			background: rgba(0, 0, 0, 0.7);
			align-items: center;
		}
		.curve{
			position: absolute;
			width: 100%;
			height: 40%;
			background: blue;
			left: 0;
			border-bottom-left-radius: 100%;
			border-bottom-right-radius: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			padding-bottom: 5%;
		}
		.button{
			font-size: 120%;
			padding: 1% 2%;
			border-radius: 20px;
			background-color: white;
			border-color: white;
			cursor: pointer;
			width: 30%;
		}
		.bstyle:hover{opacity: 70%;}
		.form_div form, form{
			background-color: blue;
			margin-top: 4%;
			position: absolute;
			width: 45%;
			border-radius: 20px;
			padding: 2%;
			z-index: 1;
			animation: slider 3s;
			font-size: 130%;
		}
		.form_div2 form{
			margin-top: 0%;
		}
		.login_form{
			z-index: 7;
		}
		table{width: 100%}

		#close{
			color: white;
			font-size: 150%;
			cursor: pointer;
		}
		#close:hover{
			padding: 0% 1%;
			background-color: red;
			border-radius: 10px;
		}
		@keyframes slider{
			0%{margin-top: 6%; opacity: 0%}
			45%{opacity: 70%}
			100%{opacity: 100%}
		}
	</style>
</head>
<body>
	<span class="nav"></span>
		
	<section id="home">
		<div class="form_div">
			<form action="verify.php" method="POST">
				<table>
					<tr><th colspan="2"><h2>SIGN UP</h2></th></tr>
					<tr>
						<td><span>NAME:</span></td>
						<td><input required type="text" name="fullname" placeholder="Enter your fullname"></td>
					</tr>
					<tr>
						<td><span>PHONE NO.:</span></td>
						<td><input required type="number" name="mobile" placeholder="Enter mobile phone"></td>
					</tr>
					<tr>
						<td><span>E-MAIL:</span></td>
						<td><input required type="email" name="mail" placeholder="Enter email address"></td>
					</tr>
					<tr>
						<td><span>ADDRESS:</span></td>
						<td><input required type="text" name="address" placeholder="Enter home address"></td>
					</tr>
					<tr>
						<td><span id="Npasscode">PASSWORD:</span></td>
						<td><input required type="password" name="code" placeholder="Enter password" id="passcode"></td>
					</tr>
					<tr>
						<td><span id="Cpasscode">CONFIRM PASSWORD:</span></td>
						<td><input required type="password" name="ccode" placeholder="Confirm password" oninput="verify_password(this)"></td>
					</tr>
					<tr><th colspan="2"><i style="display: none; color: red;">password input does not match</i></th></tr>
				</table>
				<span class="curve"><!--button type="submit" name="signp">SIGN UP</button--><input class="button bstyle" type="submit" name="signup" value="SIGN UP"></span>
			</form>

			<div  style="position:absolute; z-index: 5; margin-top: 45%;"><a href="?login">Click here to login instead</a></div>
		</div>

		<div class="form_div2">
			<?php

				if (isset($_GET['login'])) {
					include 'login.php';
					echo "<script>document.getElementsByClassName('form_div')[0].style.display='none';</script>";
					
				} 
				else if (isset($_GET['reset'])) {
					include 'forget.php';
					echo "<script>document.getElementsByClassName('form_div')[0].style.display='none';</script>";
					
				} 
				else {
					echo "<script>document.getElementsByClassName('form_div2')[0].style.display='none';</script>";
				}


			?>
		</div>
	</section>

</body>
<script type="text/javascript">
	function verify_password(code){
		var n = code.value;
		var nn = passcode.value;
		var b = document.getElementsByClassName('button');
		if (n!=nn) {
			Cpasscode.style.color = 'red';
			document.getElementsByTagName('i')[0].style.display='block';
			b[0].setAttribute("disabled","true");
			b[0].classList.remove("bstyle");
		} else {
			Cpasscode.style.color = 'white';
			document.getElementsByTagName('i')[0].style.display='none';
			b[0].removeAttribute("disabled","true");
			b[0].classList.add("bstyle");
		}
	}
</script>
</html>