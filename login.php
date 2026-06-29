<form class="login_form" action="verify.php" method="POST">
	<span id="close" title="Close" onclick="location.href='index.php'">&times;</span>
	<table>
		<tr><th colspan="2"><h2>LOGIN</h2></th></tr>
		<tr>
			<td><span>E-MAIL:</span></td>
			<td><input type="email" name="mail" placeholder="Enter email address" required></td>
		</tr>
		<tr>
			<td><span id="Npasscode">PASSWORD:</span></td>
			<td><input type="password" name="code" placeholder="Enter password" id="passcode" required></td>
		</tr>
	</table>
	<span class="curve">
		<input class="button bstyle" type="submit" name="login" value="LOGIN" style="margin-top: 15%;">
		<a href="?reset" style="color:white; margin-top: 15%;">Forgotten password? <span>Click here to reset</span></a>
	</span>
</form>