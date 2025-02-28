<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>
</head>
<body class="bg-primary">
	<section class="w-50 mx-auto p-5 bg-white">
		<?php
		if (isset($_GET['logout'])) {
			echo '<div class= "alert alert-warning">Logged out Successfully</div>';
		}
		include 'connect.php';

		if (isset($_POST['login'])) {
			$email = trim($_POST['email']);
			$password = trim($_POST['password']);
			$password = md5($password);
			$check = mysqli_query($conn, "SELECT * FROM `user` WHERE `user`.`email` = '$email' AND `password` ='$password';");

			$count = mysqli_num_rows($check);

			if ($count == 0) {
				echo '<div class ="alert alert-warning">Email and password donot match</div>';
			}// no user found or email password doesn't match
			else{
				while($row = mysqli_fetch_assoc($check)){
					$_SESSION['name'] = $row['name'];
					$_SESSION['user_id'] = $row['id'];
					$_SESSION['email'] = $row['email'];

				}//while loop
				header("Location: dashboard.php");

			}//else, email and password match




		}// if user clicks on login

		?>
		<h2>Login now</h2>
		<form method="post">
			<label>Email:</label>
			<input type="email" name="email" class="form-control"><br>
			<label>Password:</label>
			<input type="password" name="password" class="form-control"><br>
			<input type="submit" name="login" value="Login Now" class="btn btn-info">
		</form><br>
		<p><a href="register.php">Are you a new user? Register now</a></p>
	</section>


</body>
</html>