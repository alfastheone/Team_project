<?php require_once('Action.php'); $db=new db_class(); ?>
<style>
	.only{
		font-size: 250%;
	}
</style>
<div>
	<?= isset($_GET['section']) ? $_GET['section'] : 'Dashbord'; ?>
	<hr>
	<div>
		<strong><i><?= "Welcome ".$_SESSION['fullname']."!";?></i></strong>

		<div style="border:1px solid; margin: 2%; padding: 0% 4%; width: 20%; border-radius: 20px;">
			<p>You have</p>
			<h1>
				<i class="only bi bi-file-earmark-medical"></i>
				<?= $db->conn->query("SELECT * FROM application WHERE email = '$_SESSION[email]'")->num_rows; ?>
			</h1>
			<p>submitted application in total</p>
		</div>
	</div>
</div>