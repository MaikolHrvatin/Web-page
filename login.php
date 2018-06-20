<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>User login</title>
</head>
<body>
	<h3>Please login</h3>
	<!-- validation errors -->
	<?php include('validators.php'); ?>
	
	<form method="post" action="login.php">
		<table border="1">
			<tr>
				<td><label for="user">User name</label></td>
				<td><input type="text" name="user_name" value="<?php echo $username; ?>"></td>
			</tr>
			<tr>
				<td><label for="password">Password</label></td>
				<td><input type="password" name="user_pass"></td>
			</tr>
			<tr>
				<td colspan="2"><button type="submit" name="login" class="btn">Login</button></td>
			</tr>
		</table>
		<a href="index.php"><button type="button">Back</button></a>
	</form>
</body>
</html>