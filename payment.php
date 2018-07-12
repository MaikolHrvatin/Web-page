<?php include('server.php'); ?>
<?php include('create_bill.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Create bill</title>
	<!-- frontend for adding new expense bills -->
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
				<li class="dropdown active">
					<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">New payment <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li class="active"><a href="payment.php">Expense</a></li>
						<li><a href="income.php">Income</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Edit <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="edit_categories.php">Bill categories</a></li>
						<li><a href="">Placeholder</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<!-- Logged user -->
				<?php if(isset($_SESSION['username'])): ?>
					<li class="active"><a href="index.php?logout='1'">Logout</a></li>
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
			<h2>Create a new expense payment</h2><br>
			
			<!-- validation errors -->
			<?php include('validators.php'); ?>
		
			<form method="post" action="payment.php">
				<table class="table table-condensed">
					<tr>
						<td><label for="price">Price</label></td>
						<td><input class="form-control" type="text" name="price"></td>
					</tr>
					<tr>
						<td><label for="currency">Currency</label></td>
						<td><select class="form-control" name="currency">
							<option value="HRK" selected="selected">HRK</option>
							<option value="EU">EU</option>
							<option value="USD">USD</option>
						</select></td>
					</tr>
					<tr>
						<td><label for="category">Category</label></td>
						<td><select class="form-control" name="category">
						<?php
							$query = "SELECT * FROM `bill_type` WHERE id_user=".$_SESSION['user_id']." AND category='Expenses' ORDER BY ime ASC";
							$result = $connection->query($query);
							if($result->num_rows > 0){
								while($row = $result->fetch_assoc()){
									echo "<option value='".$row["ime"]."'>".$row["ime"]."</option>";
								}
							}
						?>
						</select></td>
					</tr>
					<tr>
						<td><label for="date">Date<label></td>
						<td><input class="form-control" type="date" name="date" value="<?php echo date("Y-m-d"); ?>"></td>
					</tr>
					<tr>
						<td><label for="description">Description</label></td>
						<td><input class="form-control" type="text" name="description"></td>
					</tr>
					<tr>
						<td colspan="2"><button type="submit" name="create_payment" class="btn btn-lg btn-primary">Create</button></td>
					</tr>
				</table>
			</form>
				
			<?php else:?>	
			<!-- Not logged user, go to register/login -->
				<p>Please login or register</p>
			<?php endif ?>
		</div>
	</div>
	
</body>
</html>