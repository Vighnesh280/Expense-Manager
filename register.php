<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>
<body class= "bg-primary">
	<section class="w-50 mx-auto p-5 bg-white mt-5">
		<?php 
		include 'connect.php';

		if(isset($_POST['register'])){
			$name = trim($_POST['name']);
			$email = trim($_POST['email']);
			$phone = trim($_POST['phone']);
			$password = trim($_POST['password']);
			$password = md5($password);

			$check = mysqli_query($conn ,"SELECT * FROM `user` WHERE `user`.`email` = '$email' OR `user`.`phone` = '$phone';");
			$count = mysqli_num_rows($check);
			if($count !=0 ){
				echo '<div class="alert alert-danger">Email or Phone already registered</div>';

			}
			else{
				$insert="INSERT INTO `user` (`name`, `email`, `phone`, `password`) VALUES ( '$name', '$email', '$phone', '$password');";
				$insert_run=mysqli_query($conn,$insert);
				if($insert){echo '<div class="alert alert-success">Successfully added</div>';}
				else{ echo '<div class="alert alert-warning">Error saving data</div>';}
			}
		}
				
				?>
		<h2>Register now</h2>

		<form method="post">
			<label>Name:</label>
			<input type="text" name="name" class="form-control"><br>
			<label>Phone:</label>
			<input type="number" name="phone" class="form-control"><br>
			<label>Email: </label>
			<input type="email" name="email" class="form-control">
			<br>
			<label>Password</label>
			<input type="Password" name="password" class="form-control">
			<br>
			<input type="submit" name="register" value="Register Now" clas="btn btn-info">
		</form>
		<p><a href="index.php">Already registered? login Now</a></p>
		
	</section>

</body>
</html>