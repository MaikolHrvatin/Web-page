<?php include('server.php'); ?>
<?php include('remove_user.php'); ?>
<?php include('new_user.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit bill</title>
	<!-- frontend for editing group users -->
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
			<a class="navbar-brand" href="">Finances</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home page</a></li>
				<li><a href="show_bill.php">Acount balance</a></li>
				<li class="dropdown  active">
					<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Group finances <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="new_group.php">New group</a></li>
						<li class="active"><a href="edit_groups.php">Edit groups</a></li>
						<li><a href="">Group bills</a></li>
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
			
			<?php
				$group_id = $_POST["id"];
				$query = "SELECT * FROM `grupe` WHERE id='$group_id'";
				$result = $connection->query($query);
				
				if($result->num_rows == 1){
					while($row = $result->fetch_assoc()){
						echo "<h2>Group: ".$row['ime']."</h2>";
					}
				}
			?>
			
			<h2>Browse all members</h2><br>
			
			<!-- validation errors -->
			<?php include('validators.php'); ?>
			
			<?php
				$query_admin = "SELECT * FROM `grupe` WHERE id='$group_id'";
				$result_admin = $connection->query($query_admin);
				$admin_id = "";
				while($row = $result_admin->fetch_assoc()){
					$admin_id = $row['admin_id'];
				}
				
				// if user is admin give option to delete and add users
				if($admin_id == $_SESSION['user_id']){ ?>

					<!-- add new members -->
					<h3>Add a new member</h3>
					<form method='post' action='edit_group_users.php'>
						<label for="username">Input member username</label>
						<input class='form-control' type="text" name="username" required>
						<input type='hidden' name='group_id' value="<?php echo $group_id; ?>">
						<button class='btn btn-lg btn-primary' type="submit" name="new_user">Add member</button>
					</form>
					<br>
					
					<?php
						// remove members
						$query = "SELECT username,user.id FROM `user` INNER JOIN `user_grupe` ON user.id=id_user INNER JOIN `grupe` ON grupe.id=id_grupa WHERE grupe.id='$group_id'";
						$result = $connection->query($query);
						
						if($result->num_rows > 0){
							echo "<h3>Current members</h3>";
							echo "<table class='table table-striped table-condensed'>";
							while($row = $result->fetch_assoc()){
								echo "<tr><form method='post' action='edit_group_users.php'>";
								echo "<td><label for='username'>".$row['username']."</label></td>";
								
								//hidden input type
								echo "<td><input type='hidden' name='user_id' value=".$row['id'].">";
								echo "<input type='hidden' name='group_id' value=".$group_id.">";
								echo "<input class='btn btn-lg btn-primary' type='submit' name='remove_user' value='Remove user'></td>";
								echo "</tr></form>";
							}
							echo "</table>";
						}
						
						echo "<a class='btn btn-lg btn-default' href='edit_groups.php'>Back</a>";
					?>
					
				<?php }else{
					// normal user that can only see other users
					
					echo "<h3>Group administrator: ";
					$query = "SELECT username FROM `user` INNER JOIN `grupe` ON admin_id=user.id WHERE grupe.id='$group_id'";
					$result = $connection->query($query);
					if($result->num_rows == 1){
						while($row = $result->fetch_assoc()){
							echo $row['username']."</h3>";
						}
					}
					
					echo "<h3>Other members</h3>";
					$query = "SELECT username FROM `user` INNER JOIN `user_grupe` ON user.id=id_user INNER JOIN `grupe` ON grupe.id=id_grupa WHERE grupe.id='$group_id'";
					$result = $connection->query($query);
					
					if($result->num_rows > 0){
						echo "<table class='table table-striped table-condensed'>";
						while($row = $result->fetch_assoc()){
							echo "<tr>";
								echo "<td><label for='username'>".$row['username']."</label></td>";
							echo "</tr>";
						}
						echo "</table>";
					}
					
					echo "<a class='btn btn-lg btn-default' href='edit_groups.php'>Back</a>";
				} ?>
				
			<?php else:?>	
			<!-- Not logged user, go to register/login -->
				<p>Please login or register</p>
			<?php endif ?>
		</div>
	</div>
	
</body>
</html>