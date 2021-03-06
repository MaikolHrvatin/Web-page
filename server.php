<?php
	// main backend with user session
	
	// Connect to database
	$connection = mysqli_connect('localhost', 'root', 'vertrigo', 'financije');
	if (!$connection){
	    die("Database Connection Failed" . mysqli_error($connection));
	}
	session_start();

	$username = "";
	$email = "";
	$password = "";
	$check = ""; //check password
	$errors = array();

	if (isset($_POST['register'])){
		
		// Assigning POST values to variables.
		$username = $_POST['user_name'];
		$email = $_POST['email'];
		$password = $_POST['user_pass'];
		$check = $_POST['conf_pass'];
		
		// check if fields are empty, or for errors
		if(empty($username)){
			array_push($errors, "Username is required");
		}
		if(empty($email)){
			array_push($errors, "Email is required");
		}
		if(empty($password)){
			array_push($errors, "Password is required");
		}
		if($password != $check){
			array_push($errors, "Passwords do not match");
		}
		
		// check if username is taken
		$query = "SELECT * FROM `user` WHERE username='$username'";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		$count = mysqli_num_rows($result);
		if ($count == 1){
			array_push($errors, "Username is already taken");
		}
		
		// check if there are no errors
		// register new user
		if(count($errors) == 0){
			// encrypting the password
			$password = md5($password);
			$query = "INSERT INTO `user` (username, email, password) VALUES ('$username', '$email', '$password')";
			mysqli_query($connection, $query);
			
			//session login
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "Successful login";
			//setting user_id for bills
			$query = "SELECT * FROM `user` WHERE username='$username'";
			$result = $connection->query($query);
			while($row = $result->fetch_assoc()){
				$id = $row["id"];
			}
			$_SESSION["user_id"] = $id;
			
			//create new categories for bills
			$query = "INSERT INTO `bill_type` (ime, id_user, category) VALUES ('Car', '$id', 'Expenses')";
			mysqli_query($connection, $query);
			$query = "INSERT INTO `bill_type` (ime, id_user, category) VALUES ('Entertainment', '$id', 'Expenses')";
			mysqli_query($connection, $query);
			$query = "INSERT INTO `bill_type` (ime, id_user, category) VALUES ('Food', '$id', 'Expenses')";
			mysqli_query($connection, $query);
			$query = "INSERT INTO `bill_type` (ime, id_user, category) VALUES ('Travel', '$id', 'Expenses')";
			mysqli_query($connection, $query);
			$query = "INSERT INTO `bill_type` (ime, id_user, category) VALUES ('Shopping', '$id', 'Expenses')";
			mysqli_query($connection, $query);
			$query = "INSERT INTO `bill_type` (ime, id_user, category) VALUES ('Household', '$id', 'Expenses')";
			mysqli_query($connection, $query);
			$query = "INSERT INTO `bill_type` (ime, id_user, category) VALUES ('Overhead', '$id', 'Expenses')";
			mysqli_query($connection, $query);
			$query = "INSERT INTO `bill_type` (ime, id_user, category) VALUES ('Other', '$id', 'Expenses')";
			
			//create new categories for income
			mysqli_query($connection, $query);
			$query = "INSERT INTO `bill_type` (ime, id_user, category) VALUES ('Salary', '$id', 'Income')";
			mysqli_query($connection, $query);
			$query = "INSERT INTO `bill_type` (ime, id_user, category) VALUES ('Income', '$id', 'Income')";
			mysqli_query($connection, $query);
			$query = "INSERT INTO `bill_type` (ime, id_user, category) VALUES ('Other', '$id', 'Income')";
			mysqli_query($connection, $query);
			
			//go back to index
			header('location: index.php');
		}
	}
	
	if (isset($_POST['login'])){
		
		// Assigning POST values to variables.
		$username = $_POST['user_name'];
		$password = $_POST['user_pass'];
		
		// check if fields are empty, or for errors
		if(empty($username)){
			array_push($errors, "Username is required");
		}
		if(empty($password)){
			array_push($errors, "Password is required");
		}
		
		// if there are no errors
		if(count($errors) == 0){
				
			// CHECK FOR THE RECORD FROM TABLE
			$password = md5($password);
			$query = "SELECT * FROM `user` WHERE username='$username' and Password='$password'";
			 
			$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
			$count = mysqli_num_rows($result);

			if ($count == 1){
				// session login
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "Successful login";
				
				// setting user_id for bills
				$query = "SELECT * FROM `user` WHERE username='$username'";
				$result = $connection->query($query);
				while($row = $result->fetch_assoc()){
					$id = $row["id"];
				}
				$_SESSION["user_id"] = $id;
				
				header('location: index.php');
			}else{
				array_push($errors, "Wrong username/password");
			}
		}
	}
?>