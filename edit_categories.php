<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit bill categories</title>
</head>
<body>
	<!-- Logged user -->
	<?php if(isset($_SESSION['username'])): ?>
		<h3>Please edit your bill categories</h3>
		<p>Expenses</p>
		<form method='post' action='edit_categories.php'>
			<label for="category">New expense category</label>
			<input type="text" name="category">
			<button type="submit" name="new_expense_cat" class="btn">Create</button>
		</form>
		<?php
			$query = "SELECT * FROM `bill_type` WHERE id_user=".$_SESSION['user_id']." AND category='Expenses'";
			$result = $connection->query($query);
			if($result->num_rows == 1){
				while($row = $result->fetch_assoc()){
					echo "<form method='post' action='edit_categories.php'>";
					echo "<table>";
					//tu sam stao, dovrši kod
		?>
		
		<p>Income</p>
		<form method='post' action='edit_categories.php'>
			<label for="category">New income category</label>
			<input type="text" name="category">
			<button type="submit" name="new_income_cat" class="btn">Create</button>
		</form>
	<?php else:?>	
	<!-- Not logged user, go to register/login -->
		<a href="login.php"><button type="button">Login</button></a>
		<a href="register.php"><button type="button">Register</button></a>
	<?php endif ?>	
</body>
</html>