<style>
	           
	table{
	    mbackground-color: rgb(11, 0, 172);
	     border-bottom-left-radius: 40%;
	     border-bottom-right-radius: 40%;
	     border-top-left-radius: 10%;
	     border-top-right-radius:10%;
	     padding:0px 20px 50px 50px; 
	     width: 60%;
	     font-size: 150%;
	}
	td{
	    font-style: bold;
	    font-family:sans-serif;
	}

	th{
	    font-size:20px;
	    font-style: italic;
	    padding-top: 2px;
	    
	}
	.text{
		width: 70%;
		padding: 5px 15px;
		font-size: 100%;
		border-radius: 10px;
	}
	.button{
			font-size: 100%;
			padding: 1% 2%;
			border-radius: 20px;
			background-color: white;
			border-color: white;
			cursor: pointer;
			width: 30%;
		}
		.bstyle:hover{opacity: 70%;}
		.img{
			width: 120px;
			height: 125px;
			border: 1px solid;
			overflow-y: hidden;
		}
		
</style>
<?php $names = explode(" ", $_SESSION['fullname'], 2); ?>

<div>
	<h2><?= isset($_GET['section']) ? $_GET['section'] : 'Dashbord'; ?></h2>
	<hr>
        <form action="verify.php" method="POST" enctype="multipart/form-dat">
    <table>
		<tr>
		<th colspan="2">Student Application Form </th>
		      </tr>
		<tr>
		    <td><div class="img"><img id="img" src="" alt="student image" width="100%"></div></td> <td><input type="file" id="imginp" name="img" accept="image/*"></td>
		</tr>
		<tr>
		    <td>First Name:</td> <td><input required class="text" placeholder="Enter" type="text" value="<?= $names[0]?>" name="fname"></td>
		</tr>
		<tr>
		    <td>Surname:</td> <td><input required class="text" placeholder="Enter" type="text" value="<?= $names[1] ?>" name="sname"></td>
		</tr>
		<!--tr>
		    <td>Other Name:</td> <td><input required class="text" placeholder="Enter" type="text"></td>
		</tr-->
		<tr>
		    <td>Date of Birth:</td> <td><input required class="text" name="dob" type="date"></td>
		</tr>
		<tr>
		    <td>Gender:</td> <td>Male<input required type="radio"  name="gender"> Female<input required type="radio" name="gender"></td>
		</tr>
		<tr>
		    <td>E-mail:</td> <td><input required type="text" class="text" value="<?= $_SESSION['email']?>" name="mail"></td>
		</tr><tr>
		    <td>Phone No:</td> <td><input required type="text" class="text" value="<?= $_SESSION['phone']?>" name="mobile"></td>
		</tr>
		<tr>
		    <td>Home Address:</td> <td><input required class="text" type="text" value="<?= $_SESSION['address']?>" name="address"></td>
		</tr>
		<!--tr>
		    <td>Nationality:</td>
		    <td>
		    	<select required class="text" type="text">
		    		<option>-- SELECT COUNTRY --</option>
		    		<option value="">Nigeria</option>
		    		<option value="">Niger</option>
		    		<option value="">Benin</option>
		    		<option value="">Iran</option>
		    	</select></td>
		</tr>
		<tr>
		    <td>State:</td> <td><input required placeholder="Enter state" class="text" type="text"></td>
		</tr>
		<tr>
		    <td>LGA:</td> <td><input required placeholder="Enter local government" class="text" type="text"></td>
		</tr-->
		<tr>
		<td></td><td><input type="submit" value="Register" class="button bstyle" name="register"></td>
		</tr>
	</table>
	</form>

	<script>
	imginp.onchange = evt => {
		const [file] = imginp.files
		if (file) {
			img.src=URL.createObjectURL(file);
		}
	}
	</script>  
</div>
