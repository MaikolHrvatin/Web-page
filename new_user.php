<?php
	// backend for adding new members to groups
	
	// Connect to database
	$connection = mysqli_connect('localhost', 'root', 'vertrigo', 'financije');
	if (!$connection){
	    die("Database Connection Failed" . mysqli_error($connection));
	}
	
	if (isset($_POST['new_user'])){
		$group_id = $_POST["group_id"];
		$username = $_POST["username"];
		$user_id = "";
		$errors = array();
		
		// search user
		$query = "SELECT * FROM `user` WHERE username='$username'";
		$result = $connection->query($query);
		if($result->num_rows == 1){
			while($row = $result->fetch_assoc()){
				$user_id = $row['id'];
			}
		}else{
			array_push($errors, "Username was not found");
		}
		
		if(count($errors) == 0){
			// add user
			$query = "INSERT INTO `user_grupe` (id_grupa, id_user) VALUES ('$group_id', '$user_id')";
			mysqli_query($connection, $query);
			
			$_SESSION['success'] = "New member was added";
			header('location: edit_groups.php');
		}
	}
?>