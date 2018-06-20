<?php
	// Connect to database
	$connection = mysqli_connect('localhost', 'root', 'vertrigo', 'financije');
	if (!$connection){
	    die("Database Connection Failed" . mysqli_error($connection));
	}
	$bill_id = "";
	
	$price = "";
	$currency = "";
	$category = "";
	$description = "";
	$date = "";
	$type = "";
	$errors = array();
		
	if (isset($_POST['edit_bill'])){
		
		// Assigning POST values to variables.
		$price = $_POST['price'];
		$currency = $_POST['currency'];
		$category = $_POST['category'];
		$description = $_POST['description'];
		$date = $_POST['date'];
		$bill_id = $_POST['bill_id'];
		
		// check if income or expense
		if($category == "Plaća" || $category == "Uplate"){
			$type = "income";
		}else{
			$type = "expense";
		}
		
		// check if price is empty
		if(empty($price)){
			array_push($errors, "Price is required");
		}
		
		// check if there are no errors
		if(count($errors) == 0){
			echo "usao u if";
			$query = "UPDATE `racun` SET iznos='$price', valuta='$currency', datum='$date', kategorija='$category', opis='$description', vrsta='$type' WHERE id='$bill_id'";
			$rez = mysqli_query($connection, $query);
			
			header('location: show_bill.php');
		}
	}
?>