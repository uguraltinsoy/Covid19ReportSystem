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
	<style>
		.styled-table {
			width: 100%;
			border-collapse: collapse;
			margin: 25px 0;
			font-size: 0.9em;
			font-family: sans-serif;
			min-width: 400px;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
		}

		.styled-table thead tr {
			background-color: #5D5D5D;
			color: #ffffff;
			text-align: left;
		}

		.styled-table th,
		.styled-table td {
			padding: 12px 15px;
		}

		.styled-table tbody tr {
			border-bottom: 1px solid #dddddd;
		}

		.styled-table tbody tr:nth-of-type(even) {
			background-color: #D6D6D6;
		}

		.styled-table tbody tr:last-of-type {
			border-bottom: 2px solid #009879;
		}

		img {
			width: 80px;
		}

		tbody {
			border-left: 1px solid #D6D6D6;
			border-right: 1px solid #D6D6D6;
		}

		.TopDiv {
			text-align: center;
			font-size: 50px;
			font-family: sans-serif;
			color: #303030;
		}

		.navbarDiv {
			height: 80px;
			width: 100%;
			font-size: 40px;
			background-color: #343434;
			text-align: left;
			padding-left: 40px;
			padding-top: 6px;
			color: white;
			font-weight: bold;
		}
	</style>

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
	<div style="width: 70%; margin:auto;">
		<form method="get">
			<div style="float:left; width: 50%;">Search : </div>
			<div style="float:left; width: 50%;"></div>
			<div style="float:left; width: 50%;"><input type="text" name="subject"></div>
		</form>
		<?php echo $_GET['subject']; ?>
	</div>
	<div style="width: 70%; margin:auto;">
		<table class="styled-table">
			<thead>
				<tr>
					<th>#</th>
					<th>Flag</th>
					<th>Country</th>
					<th>Total Cases</th>
					<th>Total Deaths</th>
					<th>Total Recovered</th>
					<th>Active</th>
					<th>Critical</th>
					<th>Cases Per 1M</th>
					<th>Deaths Per 1M</th>
					<th>Tests</th>
					<th>Tests 1M Pop</th>
					<th>Population</th>
					<th>Continent</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$query = "SELECT SUM(cases)as 'Cases', SUM(deaths)as 'Deaths', SUM(recovered) as 'Recovered', SUM(active)as 'Active', SUM(critical) as 'Critical' FROM generaltable";
				$result = mysqli_query($conn, $query);
				$json = mysqli_fetch_object($result);
				$encode = json_encode($json);
				$Cases = number_format($json->Cases);
				$Deaths = number_format($json->Deaths);
				$Recovered = number_format($json->Recovered);
				$Active = number_format($json->Active);
				$Critical = number_format($json->Critical);
				echo "<tr>";
				echo "<td></td>";
				echo "<td><img src=\"https://bit.ly/39M6fkO\"></td>";
				echo "<td>World</td>";
				echo "<td>{$Cases}</td>";
				echo "<td>{$Deaths}</td>";
				echo "<td>{$Recovered}</td>";
				echo "<td>{$Active}</td>";
				echo "<td>{$Critical}</td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "</tr>";
				?>
				<?php
				$query = "SELECT * FROM generaltable Order By cases DESC";
				$result = mysqli_query($conn, $query);
				$count = 1;
				while ($row = mysqli_fetch_array($result)) {
					$country = $row[1];
					$flag = $row[2];
					$todayCases = number_format($row[3]);
					$todayDeaths  = number_format($row[5]);
					$todayRecovered = number_format($row[7]);
					$active = number_format($row[9]);
					$critical = number_format($row[10]);
					$casesPerOneMillion = number_format($row[11]);
					$deathsPerOneMillion = number_format($row[12]);
					$tests = number_format($row[13]);
					$testsPerOneMillion = number_format($row[14]);
					$population = number_format($row[15]);
					$continent = $row[16];

					echo "<tr>";
					echo "<td>{$count}</td>";
					echo "<td><img src=\"$flag\">";
					echo "<td>{$country}</td>";
					echo "<td>{$todayCases}</td>";
					echo "<td>{$todayDeaths}</td>";
					echo "<td>{$todayRecovered}</td>";
					echo "<td>{$active}</td>";
					echo "<td>{$critical}</td>";
					echo "<td>{$casesPerOneMillion}</td>";
					echo "<td>{$deathsPerOneMillion}</td>";
					echo "<td>{$tests}</td>";
					echo "<td>{$testsPerOneMillion}</td>";
					echo "<td>{$population}</td>";
					echo "<td>{$continent}</td>";
					echo "</tr>";
					$count++;
				}
				?>

			</tbody>
		</table>
	</div>
	<div style="height: 80px; width: 100%; background-color:#343434;"></div>
</body>

</html>