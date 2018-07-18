<?php
	// search engine and pagination
	
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
	}
	
	// PAGINATION
	// current page number
	if (isset($_POST['page_no'])) {
		$page_no = $_POST['page_no'];
	} else {
		$page_no = 1;
	}
	// bills per page
	$no_of_records_per_page = 10;
	$offset = ($page_no-1)*$no_of_records_per_page;
	// number of total pages
	$total_pages_sql = "SELECT COUNT(*) FROM `racun` WHERE id_user='$user_id' AND (`opis` LIKE '%".$search_term."%')";
	$result_page = mysqli_query($connection,$total_pages_sql);
	$total_rows = mysqli_fetch_array($result_page)[0];
	$total_pages = ceil($total_rows / $no_of_records_per_page);
	
	//  Search query
	$query = "SELECT * FROM `racun` WHERE id_user='$user_id' AND (`opis` LIKE '%".$search_term."%') ORDER BY `datum` DESC LIMIT $offset, $no_of_records_per_page";
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
?>

<ul class="pagination">
	<form name='pagination_form' action='show_bill.php' method='POST'>
		<li><input type="hidden" name="page_no" value="<?php echo $page_no; ?>"><input type="submit" name="page" value="First"></li>
		<li class="<?php if($page_no <= 1){ echo 'disabled'; } ?>">
			<a href="<?php if($page_no <= 1){ echo '#'; } else { echo "?page_no=".($page_no - 1); } ?>">Prev</a>
		</li>
		<li class="<?php if($page_no >= $total_pages){ echo 'disabled'; } ?>">
			<a href="<?php if($page_no >= $total_pages){ echo '#'; } else { echo "?page_no=".($page_no + 1); } ?>">Next</a>
		</li>
		<li><a href="?page_no=<?php echo $total_pages; ?>">Last</a></li>
	</form>
</ul>