<?php
	// backend for making new groups
	
	// Connect to database
	$connection = mysqli_connect('localhost', 'root', 'vertrigo', 'financije');
	if (!$connection){
	    die("Database Connection Failed" . mysqli_error($connection));
	}

	$name = "";
	$info = "";
	$date = date("Y-m-d");
	$admin_id = $_SESSION["user_id"];
	$errors = array();

	if (isset($_POST['new_group'])){
		
		// Assigning POST values to variables.
		$name = $_POST['group_name'];
		$info = $_POST['group_info'];
		
		// check if price is empty
		if(empty($name)){
			array_push($errors, "Please input a group name");
		}
		if(empty($info)){
			array_push($errors, "Please provide a short description  of the group");
		}
		if(empty($date)){
			array_push($errors, "Date error");
		}
		
		// check if name is taken
		$query = "SELECT * FROM `grupe` WHERE ime='$name'";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		$count = mysqli_num_rows($result);
		if ($count == 1){
			array_push($errors, "A group with this name already exists");
		}
		
		// check if there are no errors
		if(count($errors) == 0){
			//create new group
			$query = "INSERT INTO `grupe` (ime, info, admin_id, date_start) VALUES ('$name', '$info', '$admin_id', '$date')";
			mysqli_query($connection, $query);
			
			/*
			// getting group id
			$group_id = "";
			$query = "SELECT * FROM `grupe` WHERE ime='$name'";
			$result = $connection->query($query);
			while($row = $result->fetch_assoc()){
				$group_id = $row["id"];
			}
			
			//add new user to group
			$query = "INSERT INTO `user_grupe` (id_grupa, id_user) VALUES ('$group_id', ".$_SESSION['user_id'].")";
			mysqli_query($connection, $query);
			
			*/
			
			$_SESSION['success'] = "The group was created successfully";
			header('location: edit_groups.php');
		}
	}
?>