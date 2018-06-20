<?php
	// Connect to database
	$connection = mysqli_connect('localhost', 'root', 'vertrigo', 'financije');
	if (!$connection){
	    die("Database Connection Failed" . mysqli_error($connection));
	}
	$bill_id = $_GET["id"];
	
	$query = "DELETE FROM `racun` WHERE id='$bill_id'";
	
	if (mysqli_query($connection, $query)){
		$_SESSION['success'] = "The bill was deleted successfully";
		header('Location: show_bill.php');
		exit;
	} else {
		echo "Error deleting";
	}
?>