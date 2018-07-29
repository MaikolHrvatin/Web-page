<?php
	// backend for editing groups
	
	// Connect to database
	$connection = mysqli_connect('localhost', 'root', 'vertrigo', 'financije');
	if (!$connection){
	    die("Database Connection Failed" . mysqli_error($connection));
	}
	// Data for new bill
	$group_id = "";
	$name = "";
	$info = "";
	$errors = array();
		
	if (isset($_POST['edit_group'])){
		
		// Assigning POST values to variables.
		$group_id = $_POST['group_id'];
		$name = $_POST['name'];
		$info = $_POST['info'];
		
		// check if empty
		if(empty($name)){
			array_push($errors, "Name is required");
		}
		if(empty($info)){
			array_push($errors, "Description is required");
		}
		
		// check if there are no errors
		if(count($errors) == 0){
			$query = "UPDATE `grupe` SET ime='$name', info='$info' WHERE id='$group_id'";
			$rez = mysqli_query($connection, $query);
			
			$_SESSION['success'] = "Edit was successful";
			header('location: edit_groups.php');
		}
	}
?>