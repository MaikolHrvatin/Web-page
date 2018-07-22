<?php include('server.php'); ?>
<?php include('backend_categories.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit bill categories</title>
	<!-- frontend for adding new categories for bills -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="navbar-fixed-top.css" rel="stylesheet">
</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<p class="navbar-brand">Finances</p>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home page</a></li>
				<li><a href="show_bill.php">Acount balance</a></li>
				<li><a href="">Group balance</a></li>
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">New payment <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="payment.php">Expense</a></li>
						<li class="active"><a href="income.php">Income</a></li>
					</ul>
				</li>
				<li class="dropdown active">
					<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Edit <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li class="active"><a href="edit_categories.php">Bill categories</a></li>
						<li><a href="">Placeholder</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<!-- Logged user -->
				<?php if(isset($_SESSION['username'])): ?>
					<li class="active"><a href="logout.php">Logout</a></li>
				<!-- Not logged user, go to register/login -->
				<?php else:?>	
					<li class="active"><a href="login.php">Login</a></li>
					<li><a href="register.php">Register</a></li>
				<?php endif ?>
			</ul>
		</div>
		</div>
    </nav>
	
	<div class="container">
		<div class="jumbotron">
		
			<!-- Logged user -->
			<?php if(isset($_SESSION['username'])): ?>
			<h2>Please edit your bill categories</h2><br>
		
			<!-- validation errors -->
			<?php include('validators.php'); ?>
			
			<h3>Expenses</h3>
			<form method='post' action='edit_categories.php'>
				<label for="category">New expense category</label>
				<!-- Add new category -->
				<input class='form-control' type="text" name="category">
				<input type='hidden' name="type" value="Expenses">
				<button class='btn btn-lg btn-primary' type="submit" name="new_expense_category">Create</button>
			</form>
			<br>
			<?php
				// Show all expenses, and delete selected
				echo "<table class='table table-striped table-condensed'>";
				
					$query = "SELECT * FROM `bill_type` WHERE id_user=".$_SESSION['user_id']." AND category='Expenses'";
					$result = $connection->query($query);
					if($result->num_rows > 0){
						while($row = $result->fetch_assoc()){
							echo "<tr><form method='post' action='del_categories.php'>";
								echo "<td><label for=".$row['ime'].">".$row['ime']."</label></td>";
								echo "<td><input type='hidden' name='category_id' value=".$row['id_type'].">";
								echo "<input type='submit' name='del_expense' class='btn' value='Delete'></td>";
							echo "</form></tr>";
						}
					}
					
				echo "</table>";
			?>
			
			<h3>Income</h3>
			<form method='post' action='edit_categories.php'>
				<label for="category">New income category</label>
				<!-- Add new category -->
				<input class='form-control' type="text" name="category">
				<input type='hidden' name="type" value="Income">
				<button class='btn btn-lg btn-primary' type="submit" name="new_income_category">Create</button>
			</form>
			<br>
			<?php
				// Show all income, and delete selected
				echo "<table class='table table-striped table-condensed'>";
				
					$query = "SELECT * FROM `bill_type` WHERE id_user=".$_SESSION['user_id']." AND category='Income'";
					$result = $connection->query($query);
					if($result->num_rows > 0){
						while($row = $result->fetch_assoc()){
							echo "<tr><form method='post' action='del_categories.php'>";
								echo "<td><label for=".$row['ime'].">".$row['ime']."</label></td>";
								echo "<td><input type='hidden' name='category_id' value=".$row['id_type'].">";
								echo "<input type='submit' name='del_income' class='btn' value='Delete'></td>";
							echo "</form></tr>";
						}
					}
				
				echo "</table>";
			?>
				
			<?php else:?>	
			<!-- Not logged user, go to register/login -->
				<p>Please login or register</p>
			<?php endif ?>
		</div>
	</div>
		
</body>
</html>