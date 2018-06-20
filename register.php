<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
</head>
<body>
	<h3>Please register</h3>
	<!-- validation errors -->
	<?php include('validators.php'); ?>
	
	<form method="post" action="register.php">
		<table border="1">
			<tr>
				<td><label for="user">User name</label></td>
				<td><input type="text" name="user_name" value="<?php echo $username; ?>"></td>
			</tr>
			<tr>
				<td><label for="email">Email</label></td>
				<td><input type="text" name="email" value="<?php echo $email; ?>"></td>
			</tr>
			<tr>
				<td><label for="password">Password</label></td>
				<td><input type="password" name="user_pass"></td>
			</tr>
			<tr>
				<td><label for="check">Confirm password</label></td>
				<td><input type="password" name="conf_pass"></td>
			</tr>
			<tr>
				<td colspan="2"><button type="submit" name="register" class="btn">Register</button></td>
			</tr>
		</table>
		<a href="index.php"><button type="button" name="back">Back</button></a>
	</form>
</body>
</html>