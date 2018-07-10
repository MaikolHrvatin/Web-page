<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete bill</title>
	<!-- frontend for deleting bills --!>
</head>
<body>
	<!-- Logged user -->
	<?php if(isset($_SESSION['username'])): ?>
		<h3>Are you sure you want to delete the bill?</h3>
		<?php
			// search target bill
			$bill_id = $_POST["id"];
			$query = "SELECT * FROM `racun` WHERE id='$bill_id'";
			$result = $connection->query($query);
			
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo $row["iznos"]." ".$row["valuta"]."<br>";
					echo $row["kategorija"]."<br>";
					echo $row["datum"]."<br>";
					echo $row["opis"]."<br>";
					echo "<a href='delete.php?id=".$bill_id."'><button>Delete</button></a>"." ";
					echo "<a href='show_bill.php'><button>Back</button></a>";
				}
			}
		?>	
	<?php else:?>	
	<!-- Not logged user, go to register/login -->
		<a href="login.php"><button type="button">Login</button></a>
		<a href="register.php"><button type="button">Register</button></a>
	<?php endif ?>	
</body>
</html>