<?php
	// backend for making new bills
	
	// Connect to database
	$connection = mysqli_connect('localhost', 'root', 'vertrigo', 'financije');
	if (!$connection){
	    die("Database Connection Failed" . mysqli_error($connection));
	}

	$price = "";
	$currency = "";
	$category = "";
	$description = "";
	$date = "";
	$group = "";
	$type = ""; //income-expense
	$user_id = $_SESSION["user_id"];
	$errors = array();

	if (isset($_POST['create_payment'])||isset($_POST['create_income'])){
		
		// Assigning POST values to variables.
		$price = $_POST['price'];
		$currency = $_POST['currency'];
		$category = $_POST['category'];
		$description = $_POST['description'];
		$date = $_POST['date'];
		$group = !empty($_POST['group']) ? "'".$_POST['group']."'" : "NULL";
		if (isset($_POST['create_payment'])){$type = "Expense";}
		else {$type = "Income";}
		
		// check if price is empty
		if(empty($price)){
			array_push($errors, "Price is required");
		}
		
		// check if there are no errors
		if(count($errors) == 0){
			$query = "INSERT INTO `racun` (iznos, valuta, datum, kategorija, opis, vrsta, id_user, grupa_id) VALUES ('$price', '$currency', '$date', '$category', '$description', '$type', '$user_id', $group)";
			mysqli_query($connection, $query);
			
			$_SESSION['success'] = "The bill was created successfully";
			//old path after success
			//header('location: show_bill.php');
		}
	}
?>