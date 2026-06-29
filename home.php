<?php session_start(); ?>
<?php
	if (!isset($_SESSION['email'])) {
		echo "<script>alert('Please login again');</script>";
		echo "<script>location.href='index.php?login';</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.1">
	<link rel="stylesheet" type="text/css" href="bootstrap-icons-1.3.0/bootstrap-icons.css">
	<title>STUDENT APP | Home</title>
	<style>
		body{
			font-family: sans-serif;
			background-color: blue;
		}
		.body{
			margin: 5% 0% 0% 10%;
			color: white;
		}
		.top_div{
			width: 98%;
			background-color: whitesmoke;
			text-align: right;
			padding: 1%;
			left:0;
			top:0;
			position: fixed;
		}
		aside{
			background-color: white;
			position: fixed;
			left: 0;
			top: 0;
			padding: 2% 0%;
			height: 100%;
			width: 10%;
		}
		aside ul{
			display: flex; 
			flex-direction: column;
			justify-content: space-evenly;
			height: 40%;
			margin: 0px;
			padding: 0px;
			list-style: none;
		}
		aside ul li{
			float: right;
		}
		aside ul li a{
			text-decoration: none;
			color: blue;
			margin: 1px;
			padding: 10px 30px 10px 30px;
			nbackground-color: transparent;
		}
		aside ul li a:hover{
			color: white;
			background-color: blue;
			transition: .8s;
		}
	</style>
</head>
<body>
	<div class="top_div">
		<a href="logout.php">Log Out</a>
	</div>

	<aside>
		<h3>USER PANEL</h3>
		<ul>
			<li><a href="?section=Dashboard"><i class="bi bi-speedometer2"></i> Dashbord</a></li>
			<li><a href="?section=Profile"><i class="bi bi-person-circle"></i> Profile</a></li>
			<li><a href="?section=Form"><i class="bi bi-file-earmark-medical"></i> App Form</a></li>
		</ul>
	</aside>
	<div class="body">
		<?php	$page = isset($_GET['section']) ? $_GET['section'] : 'Dashboard';
			if (file_exists($page.".php")) {
				include $page.".php";
			} else {
				echo "<script>location.href='404.html';</script>";
			}
		?>
	</div>
</body>
</html>