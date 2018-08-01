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
		
		//check if user added themselves
		if($username == $_SESSION['username']){
			array_push($errors, "You are already in the group");
		}
		
		// search if member is already in the group
		$query = "SELECT user_id FROM `user_grupe` WHERE id_user='$user_id' AND id_grupa='$group_id'";
		$result = $connection->query($query);
		if($result->num_rows > 0){
			array_push($errors, "User is already in the group");
		}
		
		if(count($errors) == 0){
			// add user
			$query = "INSERT INTO `user_grupe` (id_grupa, id_user) VALUES ('$group_id', '$user_id')";
			mysqli_query($connection, $query);
			
			$_SESSION['success'] = "New member was added";
		}
	}
?>