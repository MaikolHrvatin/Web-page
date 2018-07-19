<?php
	// search engine and pagination
	
	// Connect to database
	$connection = mysqli_connect('localhost', 'root', 'vertrigo', 'financije');
	if (!$connection){
	    die("Database Connection Failed" . mysqli_error($connection));
	}
	
	// Data for the search
	$user_id = $_SESSION["user_id"];
	$search_term = isset($_GET['term']) ? $_GET['term'] : '';
	$category = isset($_GET['category']) ? $_GET['category'] : '';
	$max_date = isset($_GET['max_date']) ? $_GET['max_date'] : '';
	$min_date = isset($_GET['min_date']) ? $_GET['min_date'] : '';
	$max_val = isset($_GET['max_val']) ? $_GET['max_val'] : '';
	$min_val = isset($_GET['min_val']) ? $_GET['min_val'] : '';
	$currency = isset($_GET['currency']) ? $_GET['currency'] : '';
	
	// making sql query and link to new page
	$link = "";
	$query_count = "SELECT COUNT(*) FROM `racun` WHERE id_user='$user_id' AND (`opis` LIKE '%".$search_term."%' OR `kategorija` LIKE '%".$search_term."%')"; //nema zagrade, treba dodat
	$query_search = "SELECT * FROM `racun` WHERE id_user='$user_id' AND (`opis` LIKE '%".$search_term."%' OR `kategorija` LIKE '%".$search_term."%')";
	
	if(!empty($_GET['term'])){
		$link = $link."&term=".$search_term;
	}
	if(!empty($_GET['category'])){
		$link = $link."&category=".$category;
		$query_count = $query_count." AND kategorija='".$category."'";
		$query_search = $query_search." AND kategorija='".$category."'";
	}
	if(!empty($_GET['max_date'])){
		$link = $link."&max_date=".$max_date;
		$query_count = $query_count." AND datum<='".$max_date."'";
		$query_search = $query_search." AND datum<='".$max_date."'";
	}
	if(!empty($_GET['min_date'])){
		$link = $link."&min_date=".$category;
		$query_count = $query_count." AND datum>='".$min_date."'";
		$query_search = $query_search." AND datum>='".$min_date."'";
	}
	if(!empty($_GET['max_val'])){
		$link = $link."&max_val=".$category;
		$query_count = $query_count." AND iznos<='".$max_val."'";
		$query_search = $query_search." AND iznos<='".$max_val."'";
	}
	if(!empty($_GET['min_val'])){
		$link = $link."&min_val=".$category;
		$query_count = $query_count." AND iznos>='".$min_val."'";
		$query_search = $query_search." AND iznos>='".$min_val."'";
	}
	if(!empty($_GET['currency'])){
		$link = $link."&currency=".$category;
		$query_count = $query_count." AND valuta='".$currency."'";
		$query_search = $query_search." AND valuta='".$currency."'";
	}
	
	// PAGINATION
	// current page number
	$page_no = isset($_GET['page_no']) ? $_GET['page_no'] : 1;
	/*if (isset($_POST['page_no'])) {
		$page_no = $_POST['page_no'];
	} else {
		$page_no = 1;
	}*/

	// bills per page
	$no_of_records_per_page = 10;
	$offset = ($page_no-1)*$no_of_records_per_page;
	
	// query made to work with pagination
	$query_search = $query_search." ORDER BY `datum` DESC LIMIT $offset, $no_of_records_per_page";
	
	// number of total pages
	$result_page = mysqli_query($connection,$query_count);
	$total_rows = mysqli_fetch_array($result_page)[0];
	$total_pages = ceil($total_rows / $no_of_records_per_page);
	
	//  Search query
	$rez = mysqli_query($connection, $query_search);
	
	echo "<table class='table table-striped table-condensed'><thead><tr>";
		echo "<th>Price</th>";
		echo "<th>Currency</th>";
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
	<li><a href="?pageno=1<?php echo $link; ?>">First</a></li>
	<li class="<?php if($page_no <= 1){ echo 'disabled'; } ?>">
		<a href="<?php if($page_no <= 1){ echo '#'; } else { echo "?page_no=".($page_no - 1).$link; } ?>">Prev</a>
	</li>
	<li class="<?php if($page_no >= $total_pages){ echo 'disabled'; } ?>">
		<a href="<?php if($page_no >= $total_pages){ echo '#'; } else { echo "?page_no=".($page_no + 1).$link; } ?>">Next</a>
	</li>
	<li><a href="?page_no=<?php echo $total_pages.$link; ?>">Last</a></li>
</ul>