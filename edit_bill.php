<?php include('server.php'); ?>
<?php include('edit.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit bill</title>
</head>
<body>
	<!-- Logged user -->
	<?php if(isset($_SESSION['username'])): ?>
		<h3>Please edit the bill</h3>
		<?php
			// search target bill
			$bill_id = $_GET["id"];
			$query = "SELECT * FROM `racun` WHERE id='$bill_id'";
			$result = $connection->query($query);
			
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo "<form method='post' action='edit_bill.php'>";
					echo "<table>";
						echo "<tr><td><label for='price'>Price</label></td>";
						echo "<td><input type='text' name='price' value=".$row['iznos']."></td></tr>";
						
						//naci izmjenu da bude oznacen atocna valuta !!!
						echo "<tr><td><label for='currency'>Currency</label></td>
							<td><select name='currency'>
								<option value='HRK' selected='selected'>HRK</option>
								<option value='EU'>EU</option>
								<option value='USD'>USD</option>
							</select></td></tr>";
							
						echo "<tr><td><label for='category'>Category</label></td>";
						echo "<td><select name='category'>
								<option value='Auto'>Auto</option>
								<option value='Zabava'>Zabava</option>
								<option value='Prehrana'>Prehrana</option>
								<option value='Putovanja'>Putovanja</option>
								<option value='Trgovina'>Trgovina</option>
								<option value='Kuća'>Kuća</option>
								<option value='Režije' selected='selected'>Režije</option>
								<option value='Plaća'>Plaća</option>
								<option value='Uplate'>Uplate</option>
								<option value='Ostali troškovi'>Ostali troškovi</option>
							</select></td></tr>";
							
						echo "<tr><td><label for='date'>Date<label></td>";
						echo "<td><input type='date' name='date' value=".$row['datum']."></td></tr>";
						
						echo "<tr><td><label for='description'>Description</label></td>";
						echo "<td><input type='text' name='description' value=".$row['opis']."></td></tr>";
						
						//hidden input type
						echo "<tr><td colspan='2'><input type='hidden' name='bill_id' value=".$bill_id."></td></tr>";
						echo "<tr><td colspan='2'><input type='submit' name='edit_bill' class='btn' value='Edit'></td></tr>";
					echo "</tr></table></form>";
				}
			}
			echo "<a href='show_bill.php'><button>Back</button></a>";
		?>	
	<?php else:?>	
	<!-- Not logged user, go to register/login -->
		<a href="login.php"><button type="button">Login</button></a>
		<a href="register.php"><button type="button">Register</button></a>
	<?php endif ?>	
</body>
</html>