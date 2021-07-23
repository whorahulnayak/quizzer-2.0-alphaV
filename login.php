<?php
	require('database.php');
	session_start();
	if(isset($_SESSION["email"]))
	{
		session_destroy();
	}
	
	$ref=@$_GET['q'];		
	if(isset($_POST['submit']))
	{	
		$email = $_POST['email'];
		$pass = $_POST['password'];
		$email = stripslashes($email);
		$email = addslashes($email);
		$pass = stripslashes($pass); 
		$pass = addslashes($pass);
		$email = mysqli_real_escape_string($con,$email);
		$pass = mysqli_real_escape_string($con,$pass);					
		$str = "SELECT * FROM user WHERE email='$email' and password='$pass'";
		$result = mysqli_query($con,$str);
		if((mysqli_num_rows($result))!=1) 
		{
			echo "<center><h3><script>alert('Sorry.. Wrong Username (or) Password');</script></h3></center>";
			header("refresh:0;url=login.php");
		}
		else
		{
			$_SESSION['logged']=$email;
			$row=mysqli_fetch_array($result);
			$_SESSION['name']=$row[1];
			$_SESSION['id']=$row[0];
			$_SESSION['email']=$row[2];
			$_SESSION['password']=$row[3];
			$_SESSION['key'] = $row[1];
			header('location: welcome.php?q=3'); 					
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Student Login</title>
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
			<form method="post" action="login.php" enctype="multipart/form-data">
					<img src="image/avatar.svg" />
					<h2 class="title">Student Login</h2>
					
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
						<button class="btn btn-primary btn-block" name="submit">Login</button>
					</div>
					<div class="form-group text-center">
						Don't have an account?<a href="register.php">Register Here</a>
					</div>

				</form>
			</div>
		</div>
		<script type="text/javascript" src="js/main.js"></script>
	</body>
</html>
