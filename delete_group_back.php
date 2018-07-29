<?php include('server.php'); ?>
<?php
	// backend for deleting groups
	
	// Connect to database
	$connection = mysqli_connect('localhost', 'root', 'vertrigo', 'financije');
	if (!$connection){
	    die("Database Connection Failed" . mysqli_error($connection));
	}
	$group_id = $_GET["id"];
	
	// deleting members
	$query = "DELETE FROM `user_grupe` WHERE id_grupa='$group_id'";
	mysqli_query($connection, $query);
	
	// deleting group
	$query = "DELETE FROM `grupe` WHERE id='$group_id'";
	mysqli_query($connection, $query);
	
	$_SESSION['success'] = "The group was deleted successfully";
	header('location: edit_groups.php');
	//exit;
?>