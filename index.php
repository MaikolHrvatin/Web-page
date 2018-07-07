<?php include('server.php'); ?>
<?php include('logout.php');?>
<!DOCTYPE html>
<html>
<head>
	<title>Home page</title>
</head>
<body>
	<h3>Home page</h3>
	<!-- After login -->
	<?php if(isset($_SESSION['success'])):
		echo $_SESSION['success'];
		unset($_SESSION['success']);
	endif ?>
	
	<!-- Logged user -->
	<?php if(isset($_SESSION['username'])): ?>
		<p>Welcome <b><?php echo $_SESSION['username']; ?></b></p>
		<a href="payment.php"><button type="button">New payment</button></a>
		<a href="income.php"><button type="button">New income</button></a>
		<a href="show_bill.php"><button type="button">Account balance</button></a>
		<a href=""><button type="button">Group balance</button></a>
		<a href=""><button type="button">Edit bill categories</button></a>
		<a href="index.php?logout='1'"><button type="button">Logout</button></a>
		
	<?php else:?>	
	<!-- Not logged user, go to register/login -->
		<a href="login.php"><button type="button">Login</button></a>
		<a href="register.php"><button type="button">Register</button></a>
	<?php endif ?>	
</body>
</html>