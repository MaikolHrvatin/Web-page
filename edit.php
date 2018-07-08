<?php
	// Connect to database
	$connection = mysqli_connect('localhost', 'root', 'vertrigo', 'financije');
	if (!$connection){
	    die("Database Connection Failed" . mysqli_error($connection));
	}
	// Data for new bill
	$bill_id = "";
	$price = "";
	$currency = "";
	$category = "";
	$description = "";
	$date = "";
	$errors = array();
		
	if (isset($_POST['edit_bill'])){
		
		// Assigning POST values to variables.
		$price = $_POST['price'];
		$currency = $_POST['currency'];
		$category = $_POST['category'];
		$description = $_POST['description'];
		$date = $_POST['date'];
		$bill_id = $_POST['bill_id'];
		
		// check if price is empty
		if(empty($price)){
			array_push($errors, "Price is required");
		}
		
		// check if there are no errors
		if(count($errors) == 0){
			$query = "UPDATE `racun` SET iznos='$price', valuta='$currency', datum='$date', kategorija='$category', opis='$description' WHERE id='$bill_id'";
			$rez = mysqli_query($connection, $query);
			
			header('location: show_bill.php');
		}
	}
?>