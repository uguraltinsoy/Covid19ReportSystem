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
	<script>
		$(document).ready(function() {
			setInterval(function() {
				$("#refreshData").load("table.php");
				refresh();
			}, 1000);
		});
	</script>

	<style>
		.TopDiv {
			text-align: center;
			font-size: 50px;
			font-family: sans-serif;
			color: #303030;
		}
	</style>

</head>

<body>
	<div class="TopDiv">
		<div>Coronavirus Cases</div>
		<?php
		$query = "SELECT SUM(cases) FROM generaltable";
		$result = mysqli_query($conn, $query);
		$json = mysqli_fetch_object($result);
		$encode = json_encode($json);
		$div = $json['{SUM(cases)}'];
		echo "<div>{$encode}</div>";
		?>
		
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

	<div id="piechart"></div>
	<div id="refreshData" style="width: 100%; height: 100%;"></div>



</body>

</html>