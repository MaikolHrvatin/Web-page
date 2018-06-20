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
						
						//naci izmjenu da bude oznacena tocna valuta !!!
						echo "<tr><td><label for='currency'>Currency</label></td>
							<td><select name='currency'>
								<option value='HRK' selected='selected'>HRK</option>
								<option value='EU'>EU</option>
								<option value='USD'>USD</option>
							</select></td></tr>";
						
						//	OVAJ DIO OBAVEZNO PROMIJENITI
						$bill_type = $row["vrsta"];
						//	za sada prikazuje samo payment NE income					
						echo "<tr><td><label for='category'>Category</label></td>";
						echo "<td><select name='category'>";
							$query = "SELECT * FROM `payment_type` WHERE id_user=".$_SESSION['user_id']." ORDER BY ime ASC";
							$result = $connection->query($query);
							if($result->num_rows > 0){
								while($row = $result->fetch_assoc()){
									echo "<option value='".$row["ime"]."'>".$row["ime"]."</option>";
								}
							}
						echo "</select></td></tr>";
							
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