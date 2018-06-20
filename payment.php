<?php include('server.php'); ?>
<?php include('create_bill.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Create bill</title>
</head>
<body>
	<!-- Logged user -->
	<?php if(isset($_SESSION['username'])): ?>
		<h3>Create a new payment bill</h3>
	
		<!-- validation errors -->
		<?php include('validators.php'); ?>
		
		<form method="post" action="payment.php">
		<table border="1">
			<tr>
				<td><label for="price">Price</label></td>
				<td><input type="text" name="price"></td>
			</tr>
			<tr>
				<td><label for="currency">Currency</label></td>
				<td><select name="currency">
					<option value="HRK" selected="selected">HRK</option>
					<option value="EU">EU</option>
					<option value="USD">USD</option>
				</select></td>
			</tr>
			<tr>
				<td><label for="category">Category</label></td>
				<td><select name="category">
					<option value="Car">Car</option>
					<option value="Entertainment">Entertainment</option>
					<option value="Food">Food</option>
				    <option value="Travel">Travel</option>
					<option value="Shopping">Shopping</option>
					<option value="Household">Household</option>
					<option value="Overhead" selected="selected">Overhead</option>
					<option value="Other">Other</option>
				</select></td>
			</tr>
			<tr>
				<td><label for="date">Date<label></td>
				<td><input type="date" name="date" value="<?php echo date("Y-m-d"); ?>"></td>
			</tr>
			<tr>
				<td><label for="description">Description</label></td>
				<td><input type="text" name="description"></td>
			</tr>
			<tr>
				<td colspan="2"><button type="submit" name="create_payment" class="btn">Create</button></td>
			</tr>
		</table>
		<a href="index.php"><button type="button" name="back">Back</button></a>
	</form>
		
	<?php else:?>	
	<!-- Not logged user, go to register/login -->
		<a href="login.php"><button type="button">Login</button></a>
		<a href="register.php"><button type="button">Register</button></a>
	<?php endif ?>	
</body>
</html>