<?php
	// backend for removing users from groups
	
	// Connect to database
	$connection = mysqli_connect('localhost', 'root', 'vertrigo', 'financije');
	if (!$connection){
	    die("Database Connection Failed" . mysqli_error($connection));
	}
	
	if (isset($_POST['remove_user'])){
		$group_id = $_POST["group_id"];
		$user_id = $_POST["user_id"];
		
		// deleting connection
		$query = "DELETE FROM `user_grupe` WHERE id_grupa='$group_id' and id_user='$user_id'";
		mysqli_query($connection, $query);
		
		$_SESSION['success'] = "The user was removed from the group";
		header('location: edit_groups.php');
	}
?>