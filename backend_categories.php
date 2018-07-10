<?php
	// backend for deleting and adding new categories
	
	// Connect to database
	$connection = mysqli_connect('localhost', 'root', 'vertrigo', 'financije');
	if (!$connection){
	    die("Database Connection Failed" . mysqli_error($connection));
	}
	//	Data for new category
	$category = "";
	$type = "";
	$category_id = "";
	$user_id = $_SESSION["user_id"];
	$errors = array();
		
	if (isset($_POST['new_expense_category']) || isset($_POST['new_income_category'])){
		
		// Assigning POST values to variables.
		$category = $_POST['category'];
		$type = $_POST['type'];
		
		// check if category is empty
		if(empty($category)){
			array_push($errors, "Please add a category name");
		}
		
		// check if there are no errors
		if(count($errors) == 0){
			// ime==$category AND category==$type !!!
			$query = "INSERT INTO `bill_type` (ime, id_user, category) VALUES ('$category', '$user_id', '$type')";
			$rez = mysqli_query($connection, $query);
			
			header('location: edit_categories.php');
		}
	}
	
	if (isset($_POST['del_category'])){
		
		$category_id = $_POST['category_id'];
		
		$query = "DELETE FROM `bill_type` WHERE id_type='$category_id'";
		$rez = mysqli_query($connection, $query);
		
		header('location: edit_categories.php');
	}
?>