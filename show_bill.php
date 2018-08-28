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
<body onload="load_function()">

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
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Group finances <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="new_group.php">New group</a></li>
						<li><a href="edit_groups.php">Edit groups</a></li>
						<li><a href="group_bills.php">Group bills</a></li>
					</ul>
				</li>
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
					<li class="active"><a href="logout.php">Logout</a></li>
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
			<h2>All private bills sorted by date</h2>
			
			<!-- After deleting or editing a bill -->
			<?php if(isset($_SESSION['success'])):
				echo "<p class='alert alert-success'>".$_SESSION['success']."</p>";
				unset($_SESSION['success']);
			endif ?>
		
			<!-- Search form -->
			<p>Search form</p>
			<form name='search_form' action='show_bill.php' method='GET'>
				<!-- If empty page number is one -->
				<input type='hidden' name='page_no' value=1>
				<!-- After _get text in input is saved -->
				<input type='text' name='term' class="form-control" placeholder="Input search term" value="<?php if(!empty($_GET['term'])) {echo $_GET['term'];} ?>">
				
				<!-- Selecting bill type, expenses or income -->
				<select name="bill_type" id="bill_type" class="form-control">
					<?php $flag = !empty($_GET['bill_type']) ? $_GET['bill_type'] : ''?>
					<option value="">Select bill type</option>
					<option value="Expense" <?php if($flag == 'Expense') echo 'selected';?> >Expense</option>
					<option value="Income" <?php if($flag == 'Income') echo 'selected';?> >Income</option>
				</select>
				
				<!-- Javascript to change dropbox below -->
				<script type="text/javascript">
				$('#bill_type').on('change', function(){
					if( $(this).val() == 'Expense'){
						$('.bill_income').hide();
						$('.bill_expenses').show();
					} else if( $(this).val() == 'Income'){
						$('.bill_expenses').hide();
						$('.bill_income').show();
					} else {
						$('.bill_expenses').show();
						$('.bill_income').show();
					}
				});
				
				function load_function(){
					if( $('#bill_type').val() == 'Expense'){
						$('.bill_income').hide();
						$('.bill_expenses').show();
					} else if( $('#bill_type').val() == 'Income'){
						$('.bill_expenses').hide();
						$('.bill_income').show();
					} else {
						$('.bill_expenses').show();
						$('.bill_income').show();
					}
				}
				</script>
				
				<select name="category" id="category" class="form-control">
					<option value="">Select category</option>
					<?php
						$query = "SELECT * FROM `bill_type` WHERE id_user=".$_SESSION['user_id']." ORDER BY `category`, `ime`";
						$result = $connection->query($query);
						if($result->num_rows > 0){
							while($row = $result->fetch_assoc()){
								if(!empty($_GET['category'])){
									if($row['ime'] == $_GET['category']){
										if($row['category'] == 'Expenses'){
											echo "<option class='bill_expenses' value='".$row["ime"]."' selected>".$row["ime"]."</option>";
										}else if($row['category'] == 'Income'){
											echo "<option class='bill_income' value='".$row["ime"]."' selected>".$row["ime"]."</option>";
										}
									}else{
										if($row['category'] == 'Expenses'){
											echo "<option class='bill_expenses' value='".$row["ime"]."'>".$row["ime"]."</option>";
										}else if($row['category'] == 'Income'){
											echo "<option class='bill_income' value='".$row["ime"]."'>".$row["ime"]."</option>";
										}
									}
								}else{
									if($row['category'] == 'Expenses'){
										echo "<option class='bill_expenses' value='".$row["ime"]."'>".$row["ime"]."</option>";
									}else if($row['category'] == 'Income'){
										echo "<option class='bill_income' value='".$row["ime"]."'>".$row["ime"]."</option>";
									}
								}
							}
						}
					?>
				</select>
				
				<input type='text' name='max_val' class="form-control" placeholder="Input highest price (ignore +/-)" value="<?php if(!empty($_GET['max_val'])) {echo $_GET['max_val'];} ?>">
				<input type='text' name='min_val' class="form-control" placeholder="input lowest price (ignore +/-)" value="<?php if(!empty($_GET['min_val'])) {echo $_GET['min_val'];} ?>">
				<select name="currency" class="form-control">
					<?php $flag = !empty($_GET['currency']) ? $_GET['currency'] : ''?>
					<option value="">Select currency</option>
					<option value="HRK" <?php if($flag == 'HRK') echo 'selected';?> >HRK</option>
					<option value="EU" <?php if($flag == 'EU') echo 'selected';?> >EU</option>
					<option value="USD" <?php if($flag == 'USD') echo 'selected';?> >USD</option>
				</select>
				
				<input class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="max_date" placeholder="Input latest date" value="<?php if(!empty($_GET['max_date'])) {echo $_GET['max_date'];} ?>">
				<input class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="min_date" placeholder="Input earliest date" value="<?php if(!empty($_GET['min_date'])) {echo $_GET['min_date'];} ?>">

				<input type='hidden' name="group_id" value="">
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