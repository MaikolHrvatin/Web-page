<?php
	// Connect to database
	$connection = mysqli_connect('localhost', 'root', 'vertrigo', 'financije');
	if (!$connection){
	    die("Database Connection Failed" . mysqli_error($connection));
	}
	
	$user_id = $_SESSION["user_id"];
	
	$expenses = 0;
	$income = 0;
	$expenses_chart = array();
	$income_chart = array();
	
	$temp = 0; //used as temporary help
	$EU_to_HRK = 7.39;
	$USD_to_HRK = 6.314;
	
	// Data for first piechart, expenses & income ratio
	$query_ratio = "SELECT * FROM `racun` WHERE id_user='$user_id' AND grupa_id IS NULL";
	$result = $connection->query($query_ratio);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			//saving the price of the bill
			$temp = $row['iznos'];
			//checking if the currency is not kuna
			if($row['valuta'] == 'EU'){
				$temp = $temp * $EU_to_HRK;
			}else if($row['valuta'] == 'USD'){
				$temp = $temp * $USD_to_HRK;
			}
			//checking if expense or income
			if($row['vrsta'] == 'Expense'){
				$expenses = $expenses + $temp;
			}else{
				$income = $income + $temp;
			}
		}
	}
	
	// Data for second piechart, all expenses
	//creating categories
	$query_expenses = "SELECT DISTINCT kategorija FROM `racun` WHERE id_user='$user_id' AND vrsta='Expense' AND grupa_id IS NULL";
	$result = $connection->query($query_expenses);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			array_push($expenses_chart, $row['kategorija'], 0);
		}
	}
	//geting data
	$array_length = count($expenses_chart);
	$query_expenses = "SELECT * FROM `racun` WHERE id_user='$user_id' AND vrsta='Expense' AND grupa_id IS NULL";
	$result = $connection->query($query_expenses);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			//checking which category
			for($x=0; $x<$array_length; $x+=2){
				if($row['kategorija'] == $expenses_chart[$x]){
					//saving the price of the bill
					$temp = $row['iznos'];
					//checking if the currency is not kuna
					if($row['valuta'] == 'EU'){
						$temp = $temp * $EU_to_HRK;
					}else if($row['valuta'] == 'USD'){
						$temp = $temp * $USD_to_HRK;
					}
					$expenses_chart[$x+1] += $temp;
				}
			}
		}
	}
	
	// Data for third piechart, all incomes
	//creating categories
	$query_income = "SELECT DISTINCT kategorija FROM `racun` WHERE id_user='$user_id' AND vrsta='Income' AND grupa_id IS NULL";
	$result = $connection->query($query_income);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			array_push($income_chart, $row['kategorija'], 0);
		}
	}
	//geting data
	$array_length = count($income_chart);
	$query_income = "SELECT * FROM `racun` WHERE id_user='$user_id' AND vrsta='Income' AND grupa_id IS NULL";
	$result = $connection->query($query_income);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			//checking which category
			for($x=0; $x<$array_length; $x+=2){
				if($row['kategorija'] == $income_chart[$x]){
					//saving the price of the bill
					$temp = $row['iznos'];
					//checking if the currency is not kuna
					if($row['valuta'] == 'EU'){
						$temp = $temp * $EU_to_HRK;
					}else if($row['valuta'] == 'USD'){
						$temp = $temp * $USD_to_HRK;
					}
					$income_chart[$x+1] += $temp;
				}
			}
		}
	}
?>

<div id="piechart_ratio"></div>
<div id="piechart_expenses"></div>
<div id="piechart_income"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
	// Load google charts
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);

	// Draw the chart and set the chart values
	function drawChart() {
		//first piechart, expense & income ratio
		var data_ratio = google.visualization.arrayToDataTable([
			['Bill', 'Value'],
			['Expenses', <?php echo $expenses; ?>],
			['Income', <?php echo $income; ?>]
		]);

		// Optional; add a title and set the width and height of the chart
		var options_ratio = {'title':'Expense to income ratio', 'width':500, 'height':400};

		// Display the chart inside the <div> element with id="piechart"
		var chart = new google.visualization.PieChart(document.getElementById('piechart_ratio'));
		chart.draw(data_ratio, options_ratio);
		
		//second piechart, expenses
		var data_expenses = google.visualization.arrayToDataTable([
			['Bill', 'Value'],
			<?php
				$array_length = count($expenses_chart);
				for($x=0; $x<$array_length; $x+=2){
					echo "['".$expenses_chart[$x]."', ".$expenses_chart[$x+1]."],";
				}
			?>
		]);

		// Optional; add a title and set the width and height of the chart
		var options_expenses = {'title':'All expenses', 'width':500, 'height':400};

		// Display the chart inside the <div> element with id="piechart"
		var chart = new google.visualization.PieChart(document.getElementById('piechart_expenses'));
		chart.draw(data_expenses, options_expenses);
		
		//third piechart, income
		var data_income = google.visualization.arrayToDataTable([
			['Bill', 'Value'],
			<?php
				$array_length = count($income_chart);
				for($x=0; $x<$array_length; $x+=2){
					echo "['".$income_chart[$x]."', ".$income_chart[$x+1]."],";
				}
			?>
		]);

		// Optional; add a title and set the width and height of the chart
		var options_income = {'title':'All incomes', 'width':500, 'height':400};

		// Display the chart inside the <div> element with id="piechart"
		var chart = new google.visualization.PieChart(document.getElementById('piechart_income'));
		chart.draw(data_income, options_income);
	}
</script>