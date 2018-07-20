<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>All bills</title>
	<!-- frontend showing all bills with pagination, deleting and editing bills -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="navbar-fixed-top.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<p class="navbar-brand">Finances</p>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home page</a></li>
				<li class="active"><a href="show_bill.php">Acount balance</a></li>
				<li><a href="">Group balance</a></li>
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">New payment <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="payment.php">Expense</a></li>
						<li><a href="income.php">Income</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Edit <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="edit_categories.php">Bill categories</a></li>
						<li><a href="">Placeholder</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<!-- Logged user -->
				<?php if(isset($_SESSION['username'])): ?>
					<li class="active"><a href="index.php?logout='1'">Logout</a></li>
				<!-- Not logged user, go to register/login -->
				<?php else:?>	
					<li class="active"><a href="login.php">Login</a></li>
					<li><a href="register.php">Register</a></li>
				<?php endif ?>
			</ul>
		</div>
		</div>
    </nav>
	
	<div class="container">
		<div class="jumbotron">
		
			<!-- Logged user -->
			<?php if(isset($_SESSION['username'])): ?>
			<h2>All bills sorted by date</h2>
			
			<!-- After deleting or editing a bill -->
			<?php if(isset($_SESSION['success'])):
				echo $_SESSION['success'];
				unset($_SESSION['success']);
			endif ?>
		
			<!-- Search form -->
			<p>Search form</p>
			<form name='search_form' action='show_bill.php' method='GET'>
				<!-- If empty page number is one -->
				<input type='hidden' name='page_no' value=<?php echo isset($_GET['page_no']) ? $_GET['page_no'] : 1; ?>>
				<!-- After _get text in input is saved -->
				<input type='text' name='term' class="form-control" placeholder="Input search term" value="<?php if(!empty($_GET['term'])) {echo $_GET['term'];} ?>">
				<select name="category" class="form-control">
					<option value="">Select category</option>
					<?php
						$query = "SELECT * FROM `bill_type` WHERE id_user=".$_SESSION['user_id']." ORDER BY category ASC";
						$result = $connection->query($query);
						if($result->num_rows > 0){
							while($row = $result->fetch_assoc()){
								if(!empty($_GET['category'])){
									if($row['ime'] == $_GET['category']){
										echo "<option value='".$row["ime"]."' selected>".$row["ime"]."</option>";
									}
								}else{
									echo "<option value='".$row["ime"]."'>".$row["ime"]."</option>";
								}
							}
						}
					?>
				</select>
				
				<input type='text' name='max_val' class="form-control" placeholder="Input highest price" value="<?php if(!empty($_GET['max_val'])) {echo $_GET['max_val'];} ?>">
				<input type='text' name='min_val' class="form-control" placeholder="input lowest price" value="<?php if(!empty($_GET['min_val'])) {echo $_GET['min_val'];} ?>">
				<select name="currency" class="form-control">
					<?php $flag = !empty($_GET['currency']) ? $_GET['currency'] : ''?>
					<option value="">Select currency</option>
					<option value="HRK" <?php if($flag == 'HRK') echo 'selected';?> >HRK</option>
					<option value="EU" <?php if($flag == 'EU') echo 'selected';?> >EU</option>
					<option value="USD" <?php if($flag == 'USD') echo 'selected';?> >USD</option>
				</select>
				
				<input class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="max_date" placeholder="Input latest date" value="<?php if(!empty($_GET['max_date'])) {echo $_GET['max_date'];} ?>">
				<input class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="min_date" placeholder="Input earliest date" value="<?php if(!empty($_GET['min_date'])) {echo $_GET['min_date'];} ?>">

				<input type='submit' class="btn btn-lg btn-primary" value='Search'>
			</form>
			<br>
			
			<p>All bills</p>
			<?php include('search.php'); // search bills ?>
				
			<?php else:?>
			<!-- Not logged user, go to register/login -->
				<p>Please login or register</p>
			<?php endif ?>
		</div>
	</div>
	
</body>
</html>