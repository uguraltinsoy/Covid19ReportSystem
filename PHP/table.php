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
			background-color: #009879;
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
			background-color: #f3f3f3;
		}

		.styled-table tbody tr:last-of-type {
			border-bottom: 2px solid #009879;
		}
		img{
			width: 80px;
		}
	</style>
</head>

<body>
</body>
<div style="width: 100%; height: 100%;">
	<table class="styled-table">
		<thead>
			<tr>
				<th>Flag</th>
				<th>Country</th>
				<th>Updated</th>
				<th>Cases</th>
				<th>Today Cases</th>
				<th>Deaths</th>
				<th>Today Deaths</th>
				<th>Recovered</th>
				<th>Today Recovered</th>
				<th>Active</th>
				<th>Critical</th>
				<th>Cases Per One Million</th>
				<th>Deaths Per One Million</th>
				<th>Tests</th>
				<th>Tests Per One Million</th>
				<th>Population</th>
				<th>Continent</th>
				<th>One Case Per People</th>
				<th>One Death Per People</th>
				<th>One Test Per People</th>
				<th>Active Per One Million</th>
				<th>Recovered Per One Million</th>
				<th>Critical Per One Million</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM generaltable";
			$result = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_array($result)) {
                $updated = $row[0];                
                $dt = date('H:i d.m.Y', $updated/1000);
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
                                
				echo "<tr>";
				echo "<td><img src=\"$flag\">";
				echo "<td>{$country}</td>";
				echo "<td>{$dt}</td>";
				echo "<td>{$cases}</td>";
				echo "<td>{$todayCases}</td>";
				echo "<td>{$deaths}</td>";
				echo "<td>{$todayDeaths}</td>";
				echo "<td>{$recovered}</td>";
				echo "<td>{$todayRecovered}</td>";
				echo "<td>{$active}</td>";
				echo "<td>{$critical}</td>";
				echo "<td>{$casesPerOneMillion}</td>";
				echo "<td>{$deathsPerOneMillion}</td>";
				echo "<td>{$tests}</td>";
				echo "<td>{$testsPerOneMillion}</td>";
				echo "<td>{$population}</td>";	
				echo "<td>{$continent}</td>";	
				echo "<td>{$oneCasePerPeople}</td>";	
				echo "<td>{$oneDeathPerPeople}</td>";	
				echo "<td>{$oneTestPerPeople}</td>";	
				echo "<td>{$activePerOneMillion}</td>";
				echo "<td>{$recoveredPerOneMillion}</td>";
				echo "<td>{$criticalPerOneMillion}</td>";
				echo "</tr>";			
			}
			?>
			
		</tbody>
	</table>

</html>