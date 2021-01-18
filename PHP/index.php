<?php
$servername = "localhost";
$database = "covidservice";
$username = "root";
$password = null;

$conn = mysqli_connect($servername, $username, $password, $database);

?>

<html>

<head>
	<title>Covid 19 Table</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="index.css" />

</head>

<body>
	<div class="navbarDiv">Covid-19 Report System</div>
	<div class="TopDiv">
		<div style="color:#555;font-weight: bold;">Coronavirus Cases</div>
		<?php
		$query = "SELECT sum(cases) as 'sumValue' FROM generaltable";
		$result = mysqli_query($conn, $query);
		$json = mysqli_fetch_object($result);
		$encode = json_encode($json);
		$div = $json->sumValue;
		$format = number_format($div);
		echo "<div style=\"color:#aaa;font-weight: bold;\">$format</div>";
		?>
		<div style="margin-top: 20px; color:#555;font-weight: bold;">Deaths</div>
		<?php
		$query = "SELECT sum(deaths) as 'sumValue' FROM generaltable";
		$result = mysqli_query($conn, $query);
		$json = mysqli_fetch_object($result);
		$encode = json_encode($json);
		$div = $json->sumValue;
		$format = number_format($div);
		echo "<div style=\"color:#696969;font-weight: bold;\">$format</div>";
		?>
		<div style="margin-top: 20px; color:#555;font-weight: bold;">Recovered</div>
		<?php
		$query = "SELECT sum(recovered ) as 'sumValue' FROM generaltable";
		$result = mysqli_query($conn, $query);
		$json = mysqli_fetch_object($result);
		$encode = json_encode($json);
		$div = $json->sumValue;
		$format = number_format($div);
		echo "<div style=\"color:#8ACA2B;font-weight: bold;\">$format</div>";
		?>

		<div class="container" style="width: 40%; margin-top:50px;">
			<div class="row">
				<div class="col-md" style="border: 1px solid #ddd; margin:2px">
					<div style="font-size: 20px;  border-bottom: 1px solid #ddd; width: 100% !important;">ACTIVE CASES</div>
					<?php
					$query = "Select sum(active) as 'sumValue' from generaltable";
					$result = mysqli_query($conn, $query);
					$json = mysqli_fetch_object($result);
					$encode = json_encode($json);
					$div = $json->sumValue;
					$format = number_format($div);
					echo "<div style=\"font-size: 20px;\">$format</div>";
					?>

				</div>
				<div class="col-md" style="border: 1px solid #ddd; margin:2px; ">
					<div style="font-size: 20px; border-bottom: 1px solid #ddd; width: 100% !important;">CLOSED CASES</div>
					<?php
					$query = "Select (sum(cases)-sum(active)) as 'sumValue' from generaltable";
					$result = mysqli_query($conn, $query);
					$json = mysqli_fetch_object($result);
					$encode = json_encode($json);
					$div = $json->sumValue;
					$format = number_format($div);
					echo "<div style=\"font-size: 20px;\">$format</div>";
					?>
				</div>
			</div>
		</div>
	</div>

	<div style="margin-top: 20px;">
		<div style="width: 70%; margin:auto; height: 40px;">
			<div id="table-tab" class="inactice">World Record</div>
			<div class="active" id="graph-tab">Percentages</div>
		</div>
	</div>

	<?php
	$query = "SELECT * FROM generaltable Order By cases DESC LIMIT 1";
	$result = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_array($result)) {
		$updated = $row[0];
		$dt = date('H:i d.m.Y', $updated / 1000);
		$country = $row[1];
		$flag = $row[2];
		$cases = $row[3];
		$todayCases = $row[4];
		$deaths = $row[5];
		$todayDeaths  = $row[6];
		$recovered = $row[7];
		$todayRecovered = $row[8];
		$active = $row[9];
		$critical = $row[10];
		$casesPerOneMillion = $row[11];
		$deathsPerOneMillion = $row[12];
		$tests = $row[13];
		$testsPerOneMillion = $row[14];
		$population = $row[15];
		$continent = $row[16];
		$oneCasePerPeople = $row[17];
		$oneDeathPerPeople = $row[18];
		$oneTestPerPeople = $row[19];
		$activePerOneMillion = $row[20];
		$recoveredPerOneMillion = $row[21];
		$criticalPerOneMillion = $row[22];
	}
	echo "<script>
			google.charts.load('current', {
				'packages': ['corechart']
			});
			google.charts.setOnLoadCallback(drawChart);
			function drawChart() {
				var data = google.visualization.arrayToDataTable([
					['Task', 'Hours per Day'],
					['Today Cases', {$todayCases}],
					['Today Deaths', {$todayDeaths}],
					['Today Recovered', {$todayRecovered}],
					['Critical', {$critical}]
				]);
				
				var options = {
					'title': 'My Average Day',
					'width': 500,
					'height': 300
				};			
				var chart = new google.visualization.PieChart(document.getElementById('piechart'));
				chart.draw(data, options);
			}
			</script>";
	?>

	<div hidden id="piechart"></div>

	<div>
		<div id="mTableContainer" style="width: 100%;">
			<div style="width: 70%; margin:auto;">
				<div style="margin-top: 10px;">
					<div class="post_div txt" style="float:left; width: 160px;">Search Country : </div>
					<div class="post_div" style="float:left; width: 200px"><input class="form-control" type="text" id="mSumbit"></div>
				</div>
			</div>

			<div style="padding-top:40px;">
				<div style=" width: 70%;  margin:auto;">
					<div style="width: 100%;">
						<table class="styled-table">
							<thead>
								<tr>
									<th style="cursor:pointer; width:60px !important;">#</th>
									<th style="cursor:pointer; width:120px !important;">Flag</th>
									<th style="cursor:pointer; width:120px !important;">Country</th>
									<th id="mCases" style="cursor:pointer; width:120px !important;">Total Cases</th>
									<th id="mDeaths" style="cursor:pointer; width:100px !important;">Total Deaths</th>
									<th id="mRecovered" style="cursor:pointer; width:110px !important;">Total Recovered</th>
									<th id="mActive" style="cursor:pointer; width:110px !important;">Active</th>
									<th id="mCritical" style="cursor:pointer; width:100px !important;">Critical</th>
									<th id="mCasesPer" style="cursor:pointer; width:100px !important;">Cases Per 1M</th>
									<th id="mDeathsPer" style="cursor:pointer; width:100px !important;">Deaths Per 1M</th>
									<th id="mTests" style="cursor:pointer; width:120px !important;">Tests</th>
									<th id="mTestsPop" style="cursor:pointer; width:100px !important;">Tests 1M Pop</th>
									<th id="mPopulation" style="cursor:pointer; width:130px !important;">Population</th>
									<th style="width:120px;">Continent</th>
								</tr>
							</thead>
						</table>
					</div>
					<div id='tableDiv' style="width: 100%; margin:auto;"></div>
				</div>
			</div>
		</div>

		<div id="mGraphContainer" style="width: 100%; display:none;">
			<div id="graphDiv" style="width: 70%; margin:auto; padding-top:40px;"></div>
		</div>
	</div>


	<div style="height: 80px; margin-top:50px; width: 100%; background-color:#8ACA2B;"></div>
	<script type="text/javascript" src="index.js"></script>
</body>

</html>