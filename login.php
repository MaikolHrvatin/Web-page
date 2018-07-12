<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>User login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="signin.css" rel="stylesheet">
</head>
<body>
	<div class="container">
	
		<form class="form-signin" method="post" action="login.php">
			<h1 class="form-signin-heading">Please login</h1>
			<!-- validation errors -->
			<?php include('validators.php'); ?>
			<label for="user" class="sr-only">User name</label>
			<input type="text" name="user_name" class="form-control" placeholder="Username" autofocus>
			<label for="password" class="sr-only">Password</label>
			<input type="password" name="user_pass" class="form-control" placeholder="Password">
			<br>
			<button  class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
			<a href="index.php"><button class="btn btn-lg btn-secondary btn-block" type="button">Back</button></a>
		</form>
		
	</div>
</body>
</html>