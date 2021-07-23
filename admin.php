<?php
    include_once 'database.php';
    session_start();
    if(isset($_SESSION["email"]))
	{
		session_destroy();
    }
    
    $ref=@$_GET['q'];
    if(isset($_POST['submit']))
	{	
        $email = $_POST['email'];
        $password = $_POST['password'];

        $email = stripslashes($email);
        $email = addslashes($email);
        $password = stripslashes($password); 
        $password = addslashes($password);

        $email = mysqli_real_escape_string($con,$email);
        $password = mysqli_real_escape_string($con,$password);
        
        $result = mysqli_query($con,"SELECT email FROM admin WHERE email = '$email' and password = '$password'") or die('Error');
        $count=mysqli_num_rows($result);
        if($count==1)
        {
            session_start();
            if(isset($_SESSION['email']))
            {
                session_unset();
            }
            $_SESSION["name"] = 'Admin';
            $_SESSION["key"] ='admin';
            $_SESSION["email"] = $email;
            header("location:dashboard.php?q=0");
        }
        else
        {
            echo "<center><h3><script>alert('Sorry.. Wrong Username (or) Password');</script></h3></center>";
            header("refresh:0;url=admin.php");
        }
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Login</title>
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
			<form method="post" action="admin.php" enctype="multipart/form-data">
					<img src="image/avatar.svg" />
					<h2 class="title">Admin Login</h2>
					
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
