<?php
	// search engine
	
	// Connect to database
	$connection = mysqli_connect('localhost', 'root', 'vertrigo', 'financije');
	if (!$connection){
	    die("Database Connection Failed" . mysqli_error($connection));
	}
	// Data for the search
	$user_id = $_SESSION["user_id"];
	$search_term = "";
	$date = "";
	$category = "";
	$valute = "";
	$price1 = "";
	$price2 = "";
		
	if (isset($_POST['search_bill'])){
		
		// Assigning POST values to variables.
		$search_term = $_POST['term'];
		//$date = $_POST['date'];
		//$category = $_POST['category'];
		//$valute = $_POST['valute'];
		//$price1 = $_POST['price1'];
		//$price2 = $_POST['price2'];
		
		//  Search query
		$query = "SELECT * FROM `racun` WHERE id_user='$user_id' AND (`opis` LIKE '%".$search_term."%') ORDER BY `datum` DESC"; // LIMIT $offset, $no_of_records_per_page";
		$rez = mysqli_query($connection, $query);
		
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
		
		if($rez->num_rows > 0){
			while($row = $rez->fetch_assoc()){
				echo "<tr><td>".$row["iznos"]."</td>";
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
				echo "</td></tr>";
			}
		}
		echo "</tbody>";
		echo "</table>";
	}
?>