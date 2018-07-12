<?php include('server.php'); ?>
<?php include('backend_categories.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete category</title>
	<!-- frontend for deleting categories -->
</head>
<body>
	<!-- Logged user -->
	<?php if(isset($_SESSION['username'])): ?>
	<h3>Are you sure you want to delete this category?</h3>
	<?php
		// search target bill
		$category_id = $_POST["category_id"];
		$query = "SELECT * FROM `bill_type` WHERE id_type='$category_id'";
		$result = $connection->query($query);
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				echo "<p>".$row['ime']."</p>";
				echo "<form method='post' action='del_categories.php'>";
				echo "<input type='hidden' name='category_id' value=".$row['id_type'].">";
				echo "<input type='submit' name='del_category' class='btn' value='Delete'>";
				echo "</form>";
			}
		}
	?>
	</br><a href='edit_categories.php'><button>Back</button></a>
	<?php else:?>	
	<!-- Not logged user, go to register/login -->
		<a href="login.php"><button type="button">Login</button></a>
		<a href="register.php"><button type="button">Register</button></a>
	<?php endif ?>	
</body>
</html>