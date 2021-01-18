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
			/*margin: 25px 0;*/
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
		tbody{
			border-left: 1px solid #D6D6D6;
    		border-right: 1px solid #D6D6D6;
		}
	</style>
</head>

<body>
</body>
<div style="width: 70%;  margin:auto;">
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

</html>