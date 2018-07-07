<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>All bills</title>
</head>
<body>
	<!-- After deleting or editing a bill -->
	<?php if(isset($_SESSION['success'])):
		echo $_SESSION['success'];
		unset($_SESSION['success']);
	endif ?>
	
	<!-- Logged user -->
	<?php if(isset($_SESSION['username'])): ?>
		<h3>Most recent bills</h3>
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
			
			$query = "SELECT * FROM `racun` WHERE id_user='$user_id' ORDER BY 'datum' DESc LIMIT $offset, $no_of_records_per_page";
			$result = $connection->query($query);
			
			// show each bill
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo $row["iznos"]." ".$row["valuta"]."<br>";
					echo $row["kategorija"]."<br>";
					echo $row["datum"]."<br>";
					echo $row["opis"]."<br>";
					echo "<a href='edit_bill.php?id=".$row["id"]."'><button>Edit</button></a>"." ";
					echo "<a href='delete_bill.php?id=".$row["id"]."'><button>Delete</button></a>";
					echo "<br>";
				}
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
		
		</br><a href='index.php'><button>Back</button></a>
		
	<?php else:?>	
	<!-- Not logged user, go to register/login -->
		<a href="login.php"><button type="button">Login</button></a>
		<a href="register.php"><button type="button">Register</button></a>
	<?php endif ?>	
</body>
</html>