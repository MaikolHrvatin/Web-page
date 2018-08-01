<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit bill categories</title>
	<!-- frontend for editing and deleting groups -->
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
				<li class="dropdown active">
					<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Group finances <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="new_group.php">New group</a></li>
						<li><a href="edit_groups.php">Edit groups</a></li>
						<li class="active"><a href="group_bills.php">Group bills</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">New payment <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="payment.php">Expense</a></li>
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
					<li class="active"><a href="logout.php">Logout</a></li>
				<!-- Not logged user, go to register/login -->
				<?php else:?>	
					<li><a href="login.php">Login</a></li>
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
			<h2>Please choose a group</h2><br>
			
			<?php
				// groups where admin
				echo "<h3>Groups where administrator</h3>";
				echo "<table class='table table-striped table-condensed'>";
					$query = "SELECT * FROM `grupe` WHERE admin_id=".$_SESSION['user_id']."";
					$result = $connection->query($query);
					if($result->num_rows > 0){
						while($row = $result->fetch_assoc()){
							echo "<tr>";
								echo "<td><label for=".$row['ime'].">".$row['ime']."</label></td>";
								echo "<td><label for=".$row['date_start'].">".$row['date_start']."</label></td>";
								
								// show bills
								echo "<td><a class='btn btn-lg btn-primary' href='show_group_bills.php?group_id=".$row['id']."'>Show bills</a></td>";
							echo "</tr>";
						}
					}
				echo "</table>";
				
				// other groups
				echo "<h3>Other groups</h3>";
				echo "<table class='table table-striped table-condensed'>";
					$query = "SELECT grupe.ime, grupe.id, date_start FROM `grupe` INNER JOIN `user_grupe` ON grupe.id=id_grupa INNER JOIN `user` ON user.id=id_user WHERE user.id=".$_SESSION['user_id'].""; //tu stao
					$result = $connection->query($query);
					if($result->num_rows > 0){
						while($row = $result->fetch_assoc()){
							echo "<tr>";
								echo "<td><label for=".$row['ime'].">".$row['ime']."</label></td>";
								echo "<td><label for=".$row['date_start'].">".$row['date_start']."</label></td>";
								
								// show bills
								echo "<td><a class='btn btn-lg btn-primary' href='show_group_bills.php?group_id=".$row['id']."'>Show bills</a></td>";
							echo "</tr>";
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