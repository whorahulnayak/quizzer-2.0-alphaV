<?php
	include("database.php");
	session_start();
	// only email pw
	if(isset($_POST['submit']))
	{	

		$email = $_POST['email'];
		$email = stripslashes($email);
		$email = addslashes($email);

		$password = $_POST['password'];
		$password = stripslashes($password);
		$password = addslashes($password);

		
		$str="SELECT email from admin WHERE email='$email'";
		$result=mysqli_query($con,$str);
		
		if((mysqli_num_rows($result))>0)	
		{
            echo "<center><h3><script>alert('Sorry.. This email is already registered !!');</script></h3></center>";
            header("refresh:0;url=admin.php");
        }
		else
		{
            $str="insert into admin set email='$email',password='$password'";
			if((mysqli_query($con,$str)))	
			echo "<center><h3><script>alert('Congrats.. You have successfully registered !!');</script></h3></center>";
			header('location: admin.php?q=1');
		}
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Faculty Signup</title>
		<link rel="icon" type="image/png" sizes="32x32" href="image/favicon-16x16.png">
		<link rel="stylesheet" type="text/css" href="css/login.css" />
		<link
			href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap"
			rel="stylesheet"
		/>
		<script src="https://kit.fontawesome.com/a81368914c.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
	</head>
	<body>
		<img class="wave" src="image/wave.png" />
		<div class="container">
			<div class="img">
				<img src="image/bg.svg" />
			</div>
			<div class="login-content">
			<form method="post" action="register1.php" enctype="multipart/form-data">
					<img src="image/avatar.svg" />
					<h2 class="title">Faculty Signup</h2>
					
					<div class="input-div one">
						<div class="i">
							<i class="fas fa-user"></i>
						</div>
						<div class="div">
							<h5>email</h5>
							<input type="email" name="email" class="input" required/>
						</div>
					</div>
					<div class="input-div pass">
						<div class="i">
							<i class="fas fa-lock"></i>
						</div>
						<div class="div">
							<h5>Password</h5>
							<input type="password" name="password" class="input" required/>
						</div>
					</div>
					<div class="form-group text-right">
						<button class="btn btn-primary" name="submit">Register</button>
</div>	
				</form>
			</div>
		</div>
		<script type="text/javascript" src="js/main.js"></script>
	</body>
</html>
