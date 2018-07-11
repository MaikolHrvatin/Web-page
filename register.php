<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
	
		<form class="form-signin" method="post" action="register.php">
			<h1 class="form-signin-heading">Please register</h1>
			<!-- validation errors -->
			<?php include('validators.php'); ?>
			<label for="user" class="sr-only">User name</label>
			<input type="text" name="user_name" class="form-control" placeholder="Username" required autofocus>
			<label for="email" class="sr-only">E-mail</label>
			<input type="text" name="email" class="form-control" placeholder="E-mail" required>
			<label for="password" class="sr-only">Password</label>
			<input type="password" name="user_pass" class="form-control" placeholder="Password" required>
			<label for="check" class="sr-only">Confirm password</label>
			<input type="password" name="conf_pass" class="form-control" placeholder="Confirm password" required>
			<br>
			<button  class="btn btn-lg btn-primary btn-block" type="submit" name="register">Register</button>
			<a href="index.php"><button class="btn btn-lg btn-secondary btn-block" type="button">Back</button></a>
		</form>
		
	</div>
</body>
</html>