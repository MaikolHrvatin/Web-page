<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>All bills</title>
	<!-- frontend showing all bills with pagination, deleting and editing bills -->
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
				<li class="active"><a href="show_bill.php">Acount balance</a></li>
				<li><a href="">Group balance</a></li>
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
			<h2>Most recent bills</h2>
			
			<!-- After deleting or editing a bill -->
			<?php if(isset($_SESSION['success'])):
				echo $_SESSION['success'];
				unset($_SESSION['success']);
			endif ?>
			
			<?php
				$user_id = $_SESSION["user_id"];
				
				// PAGINATION
				// current page number
				if (isset($_GET['page_no'])) {
					$page_no = $_GET['page_no'];
				} else {
					$page_no = 1;
				}
				// bills per page
				$no_of_records_per_page = 10;
				$offset = ($page_no-1)*$no_of_records_per_page;
				// number of total pages
				$total_pages_sql = "SELECT COUNT(*) FROM `racun` WHERE id_user='$user_id'";
				$result_page = mysqli_query($connection,$total_pages_sql);
				$total_rows = mysqli_fetch_array($result_page)[0];
				$total_pages = ceil($total_rows / $no_of_records_per_page);
				
				$query = "SELECT * FROM `racun` WHERE id_user='$user_id' ORDER BY `datum` DESC LIMIT $offset, $no_of_records_per_page";
				$result = $connection->query($query);
				
				// show each bill
				if($result->num_rows > 0){
					echo "<table class='table table-striped table-condensed'><thead><tr>";
						echo "<th>Price</th>";
						echo "<th>Valute</th>";
						echo "<th>Category</th>";
						echo "<th>Date</th>";
						echo "<th>Info</th>";
						echo "<th></th>";
						echo "<th></th>";
					echo "</tr></thead>";
					echo "<tbody>";
					
					while($row = $result->fetch_assoc()){
						echo "<tr>";
							echo "<td>".$row["iznos"]."</td>";
							echo "<td>".$row["valuta"]."</td>";
							echo "<td>".$row["kategorija"]."</td>";
							echo "<td>".$row["datum"]."</td>";
							echo "<td>".$row["opis"]."</td>";
							// edit bill
							echo "<td>";
							echo "<form method='post' action='edit_bill.php'>";
							echo "<input type='hidden' name='id' value=".$row['id'].">";
							echo "<input type='submit' name='edit_b' class='btn' value='Edit'>";
							echo "</form>";
							echo "</td>";
							// delete bill
							echo "<td>";
							echo "<form method='post' action='delete_bill.php'>";
							echo "<input type='hidden' name='id' value=".$row['id'].">";
							echo "<input type='submit' name='delete_b' class='btn' value='Delete'>";
							echo "</form>";
							echo "</td>";
						echo "</tr>";
					}
					echo "</tbody>";
					echo "</table>";
				}
			?>
			<ul class="pagination">
				<li><a href="?page_no=1">First</a></li>
				<li class="<?php if($page_no <= 1){ echo 'disabled'; } ?>">
					<a href="<?php if($page_no <= 1){ echo '#'; } else { echo "?page_no=".($page_no - 1); } ?>">Prev</a>
				</li>
				<li class="<?php if($page_no >= $total_pages){ echo 'disabled'; } ?>">
					<a href="<?php if($page_no >= $total_pages){ echo '#'; } else { echo "?page_no=".($page_no + 1); } ?>">Next</a>
				</li>
				<li><a href="?page_no=<?php echo $total_pages; ?>">Last</a></li>
			</ul>
				
			<?php else:?>
			<!-- Not logged user, go to register/login -->
				<p>Please login or register</p>
			<?php endif ?>
		</div>
	</div>
	
</body>
</html>