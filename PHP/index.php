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
			/*margin: 25px 0;*/
			font-size: 0.9em;
			font-family: sans-serif;
			min-width: 400px;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
		}

		.styled-table thead tr {
			background-color: #8ACA2B;
			color: #ffffff;
			text-align: left;
		}

		.styled-table th,
		.styled-table td {
			padding: 10px;
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
			background-color: #8ACA2B;
			text-align: left;
			padding-left: 40px;
			padding-top: 6px;
			color: white;
			font-weight: bold;
		}

		.txt {
			color: rgb(0, 0, 0);
			font-size: 20px;
			width: 80%;
			margin: auto;
			text-align: left;
			font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
		}

		.form-control {
			margin: auto;
			margin-top: 2px;
			border: 1px solid rgb(150, 150, 150);
			box-sizing: border-box;
			border-radius: .25rem;
			height: 30px;
		}

		#table-tab,
		#percent-tab,
		#continen-tab {
			width: 33%;
			padding: 10px;
			display: inline-block;
			box-sizing: border-box;
			text-align: center;
			
			cursor: pointer;
			font-weight: bold;
			border: 1px solid #ddd;
		}

		.active {
			background: #8ACA2B;
			color: white;
		}

		.inactice {
			color: black;
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

	<div style="margin-top: 20px;">
		<div style="width: 70%; margin:auto; height: 40px;">
			<div id="table-tab" class="inactice">World Record</div>
			<div class="active" id="percent-tab">Percentages</div>
			<div class="active" id="continen-tab">Continents</div>
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
					<div style="width: 100%;" id="mtopTableDiv">
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

		<div id="mPercentContainer" style="width: 100%; display:none;">
			<div style="width: 70%; margin:auto;">
				<div style="margin-top: 10px;">
					<div class="post_div txt" style="float:left; width: 160px;">Search Country : </div>
					<div class="post_div" style="float:left; width: 200px"><input class="form-control" type="text" id="mPercentages"></div>
				</div>
			</div>
			<div id="percentDiv" style="width: 70%; margin:auto; padding-top:40px;"></div>
		</div>

		<div id="mContinentContainer" style="width: 100%; display:none;">			
			<div id="continentDiv" style="width: 70%; margin:auto; padding-top:40px;"></div>
		</div>
	</div>


	<div style="height: 80px; margin-top:50px; width: 100%; background-color:#8ACA2B;"></div>

	<script type="text/javascript">
		var sorting = "DESC";
		var totalCases = true;
		var type = 0;

		$(document).ready(function() {
			readData();

			$('#tableDiv').on(function() {
				$('#tableDiv').width($('#mtopTableDiv').width());
			});

			$.post("percentages.php", {
				queryValues: "SELECT cp.country, caseByPop, testByPop, caseByTest, deadByPop, deadByCase, recoverByPop, recoverbyCase,  flag FROM casesPercentage AS cp JOIN testsPercentage AS tp ON cp.country = tp.country JOIN deathsPercentage AS dp ON tp.country = dp.country JOIN recoveredPercentage AS rp ON dp.country = rp.country JOIN generaltable AS gt ON rp.country = gt.country ORDER BY `cp`.`country` ASC"
			}, function(sendData) {
				$('#percentDiv').html(sendData);
			});

			$("#continentDiv").load("continents.php");

			$("#table-tab").click(function() {
				$("#mTableContainer").show();
				$("#mPercentContainer").hide();				
				$("#mContinentContainer").hide();		

				$("#table-tab").addClass("inactice");
				$("#percent-tab").addClass("active");
				$("#continen-tab").addClass("active");
				

				$("#table-tab").removeClass("active");						
				$("#percent-tab").removeClass("inactice");
				$("#continen-tab").removeClass("inactice");		
			});

			$("#percent-tab").click(function() {
				$("#mTableContainer").hide();
				$("#mPercentContainer").show();				
				$("#mContinentContainer").hide();	

				$("#table-tab").addClass("active");
				$("#percent-tab").addClass("inactice");
				$("#continen-tab").addClass("active");
				

				$("#table-tab").removeClass("inactice");						
				$("#percent-tab").removeClass("active");
				$("#continen-tab").removeClass("inactice");	
			});

			$("#continen-tab").click(function() {
				$("#mTableContainer").hide();
				$("#mPercentContainer").hide();				
				$("#mContinentContainer").show();	

				$("#table-tab").addClass("active");
				$("#percent-tab").addClass("active");
				$("#continen-tab").addClass("inactice");
				

				$("#table-tab").removeClass("inactice");						
				$("#percent-tab").removeClass("inactice");
				$("#continen-tab").removeClass("active");	
			});

			$("#mCases").click(function() {
				if (totalCases) {
					sorting = "ASC"
					totalCases = false;
					type = 0;
					readData();
				} else {
					sorting = "DESC"
					totalCases = true;
					type = 0;
					readData();
				}
			});

			$("#mDeaths").click(function() {
				if (totalCases) {
					sorting = "ASC"
					totalCases = false;
					type = 1;
					readData();
				} else {
					sorting = "DESC"
					totalCases = true;
					type = 1;
					readData();
				}
			});

			$("#mRecovered").click(function() {
				if (totalCases) {
					sorting = "ASC"
					totalCases = false;
					type = 2;
					readData();
				} else {
					sorting = "DESC"
					totalCases = true;
					type = 2;
					readData();
				}
			});

			$("#mActive").click(function() {
				if (totalCases) {
					sorting = "ASC"
					totalCases = false;
					type = 3;
					readData();
				} else {
					sorting = "DESC"
					totalCases = true;
					type = 3;
					readData();
				}
			});

			$("#mCritical").click(function() {
				if (totalCases) {
					sorting = "ASC"
					totalCases = false;
					type = 4;
					readData();
				} else {
					sorting = "DESC"
					totalCases = true;
					type = 4;
					readData();
				}
			});

			$("#mCasesPer").click(function() {
				if (totalCases) {
					sorting = "ASC"
					totalCases = false;
					type = 5;
					readData();
				} else {
					sorting = "DESC"
					totalCases = true;
					type = 5;
					readData();
				}
			});

			$("#mDeathsPer").click(function() {
				if (totalCases) {
					sorting = "ASC"
					totalCases = false;
					type = 6;
					readData();
				} else {
					sorting = "DESC"
					totalCases = true;
					type = 6;
					readData();
				}
			});

			$("#mTests").click(function() {
				if (totalCases) {
					sorting = "ASC"
					totalCases = false;
					type = 7;
					readData();
				} else {
					sorting = "DESC"
					totalCases = true;
					type = 7;
					readData();
				}
			});

			$("#mTestsPop").click(function() {
				if (totalCases) {
					sorting = "ASC"
					totalCases = false;
					type = 8;
					readData();
				} else {
					sorting = "DESC"
					totalCases = true;
					type = 8;
					readData();
				}
			});

			$("#mPopulation").click(function() {
				if (totalCases) {
					sorting = "ASC"
					totalCases = false;
					type = 9;
					readData();
				} else {
					sorting = "DESC"
					totalCases = true;
					type = 9;
					readData();
				}
			});

			$('#mPercentages').on('input', function(e) {
				var txt = $('#mPercentages').val();
				if (txt != "") {
					$.post("percentages.php", {
						queryValues: "SELECT cp.country, caseByPop, testByPop, caseByTest, deadByPop, deadByCase, recoverByPop, recoverbyCase, flag FROM casesPercentage AS cp JOIN testsPercentage AS tp ON cp.country = tp.country JOIN deathsPercentage AS dp ON tp.country = dp.country JOIN recoveredPercentage AS rp ON dp.country = rp.country JOIN generaltable AS gt ON rp.country = gt.country WHERE `cp`.`country` LIKE\'" + txt + "%\' ORDER BY `cp`.`country` ASC"
					}, function(sendData) {
						$('#percentDiv').html(sendData);
					});
				} else {
					$.post("percentages.php", {
						queryValues: "SELECT cp.country, caseByPop, testByPop, caseByTest, deadByPop, deadByCase, recoverByPop, recoverbyCase,  flag FROM casesPercentage AS cp JOIN testsPercentage AS tp ON cp.country = tp.country JOIN deathsPercentage AS dp ON tp.country = dp.country JOIN recoveredPercentage AS rp ON dp.country = rp.country JOIN generaltable AS gt ON rp.country = gt.country ORDER BY `cp`.`country` ASC"
					}, function(sendData) {
						$('#percentDiv').html(sendData);
					});
				}
			});


			$('#mSumbit').on('input', function(e) {
				var txt = $('#mSumbit').val();
				if (txt != "") {
					$.post("table.php", {
						queryValues: "SELECT * FROM generaltable WHERE country LIKE \'" + txt + "%\' Order By country " + sorting
					}, function(gonderVeri) {
						$('#tableDiv').html(gonderVeri);
					});
				} else {
					$.post("table.php", {
						queryValues: "SELECT * FROM generaltable Order By cases " + sorting
					}, function(gonderVeri) {
						$('#tableDiv').html(gonderVeri);
					});
				}
			});

			function readData() {
				var queryValues = "SELECT * FROM generaltable Order By cases " + sorting;
				switch (type) {
					case 0:
						queryValues = "SELECT * FROM generaltable Order By cases " + sorting;
						break;
					case 1:
						queryValues = "SELECT * FROM generaltable Order By deaths " + sorting;
						break;
					case 2:
						queryValues = "SELECT * FROM generaltable Order By recovered " + sorting;
						break;
					case 3:
						queryValues = "SELECT * FROM generaltable Order By active " + sorting;
						break;
					case 4:
						queryValues = "SELECT * FROM generaltable Order By critical " + sorting;
						break;
					case 5:
						queryValues = "SELECT * FROM generaltable Order By casesPerOneMillion " + sorting;
						break;
					case 6:
						queryValues = "SELECT * FROM generaltable Order By deathsPerOneMillion " + sorting;
						break;
					case 7:
						queryValues = "SELECT * FROM generaltable Order By tests " + sorting;
						break;
					case 8:
						queryValues = "SELECT * FROM generaltable Order By testsPerOneMillion " + sorting;
						break;
					case 9:
						queryValues = "SELECT * FROM generaltable Order By population " + sorting;
						break;
					default:
				}
				$.post("table.php", {
					queryValues: queryValues
				}, function(gonderVeri) {
					$('#tableDiv').html(gonderVeri);
				});
			}
		});
	</script>
</body>

</html>