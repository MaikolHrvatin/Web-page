<?php include('server.php'); ?>
<?php include('bck_categories.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit bill categories</title>
</head>
<body>
	<!-- Logged user -->
	<?php if(isset($_SESSION['username'])): ?>
		<h3>Please edit your bill categories</h3>
		
		<!-- validation errors -->
		<?php include('validators.php'); ?>
		
		<p>Expenses</p>
		<form method='post' action='edit_categories.php'>
			<label for="category">New expense category</label>
			<!-- Add new category -->
			<input type="text" name="category">
			<input type='hidden' name="type" value="Expenses">
			<button type="submit" name="new_expense_category" class="btn">Create</button>
		</form>
		<?php
			// Show all expenses, and delete selected
			$query = "SELECT * FROM `bill_type` WHERE id_user=".$_SESSION['user_id']." AND category='Expenses'";
			$result = $connection->query($query);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo "<form method='post' action='edit_categories.php'>";
					echo "<label for=".$row['ime'].">".$row['ime']."</label>";
					echo "<input type='hidden' name='category_id' value=".$row['id_type'].">";
					echo "<input type='submit' name='new_expense' class='btn' value='Delete'>";
					echo "</form>";
				}
			}
		?>
		
		<p>Income</p>
		<form method='post' action='edit_categories.php'>
			<label for="category">New income category</label>
			<!-- Add new category -->
			<input type="text" name="category">
			<input type='hidden' name="type" value="Income">
			<button type="submit" name="new_income_category" class="btn">Create</button>
		</form>
		<?php
			// Show all income, and delete selected
			$query = "SELECT * FROM `bill_type` WHERE id_user=".$_SESSION['user_id']." AND category='Income'";
			$result = $connection->query($query);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo "<form method='post' action='edit_categories.php'>";
					echo "<label for=".$row['ime'].">".$row['ime']."</label>";
					echo "<input type='hidden' name='category_id' value=".$row['id_type'].">";
					echo "<input type='submit' name='new_expense' class='btn' value='Delete'>";
					echo "</form>";
				}
			}
		?>
		</br><a href='index.php'><button>Back</button></a>
	<?php else:?>	
	<!-- Not logged user, go to register/login -->
		<a href="login.php"><button type="button">Login</button></a>
		<a href="register.php"><button type="button">Register</button></a>
	<?php endif ?>	
</body>
</html>