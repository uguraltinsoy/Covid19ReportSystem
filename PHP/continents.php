<?php
$servername = "localhost";
$database = "covidservice";
$username = "root";
$password = null;

$conn = mysqli_connect($servername, $username, $password, $database);

$query = "SELECT * From continents";

?>

<html>


<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #181A1B;
        }
    </style>
</head>

<body>
    <table class="styled-table">
        <thead>
            <tr>
                <th style="height: 60px;">#</th>
                <th style="height: 60px;">Continent</th>
                <th style="height: 60px;">Cases</th>
                <th style="height: 60px;">Deaths</th>
                <th style="height: 60px;">Recovered</th>
                <th style="height: 60px;">Active</th>
                <th style="height: 60px;">Critical</th>
                <th style="height: 60px;">Tests</th>
                <th style="height: 60px;">Population</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn, $query);
            $count = 1;
            while ($row = mysqli_fetch_array($result)) {
                $continent = $row[0];
                $cases = number_format($row[1]);
                $testByPop  = number_format($row[2]);
                $deaths = number_format($row[3]);
                $recovered = number_format($row[4]);
                $active = number_format($row[5]);
                $tests = number_format($row[6]);
                $population = number_format($row[7]);

                echo "<tr>";
                echo "<td style=\"height: 60px;\">{$count}</td>";
                echo "<td style=\"height: 60px;\">{$continent}</td>";
                echo "<td style=\"height: 60px;\">{$cases}</td>";
                echo "<td style=\"height: 60px;\">{$testByPop}</td>";
                echo "<td style=\"height: 60px;\">{$deaths}</td>";
                echo "<td style=\"height: 60px;\">{$recovered}</td>";
                echo "<td style=\"height: 60px;\">{$active}</td>";
                echo "<td style=\"height: 60px;\">{$tests}</td>";
                echo "<td style=\"height: 60px;\">{$population}</td>";
                echo "</tr>";
                $count++;
            }
            ?>
        </tbody>
</body>

</html>