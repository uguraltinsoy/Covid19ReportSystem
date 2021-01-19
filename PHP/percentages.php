<?php
$servername = "localhost";
$database = "covidservice";
$username = "root";
$password = null;

$conn = mysqli_connect($servername, $username, $password, $database);

$queryValues = $_POST['queryValues'];

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
                <th style="height: 60px;">Flag</th>
                <th style="height: 60px;">Country</th>
                <th style="height: 60px;">Case By Pop</th>
                <th style="height: 60px;">Test By Pop</th>
                <th style="height: 60px;">Case By Test</th>
                <th style="height: 60px;">Dead By Pop</th>
                <th style="height: 60px;">Dead By Case</th>
                <th style="height: 60px;">Recover By Pop</th>
                <th style="height: 60px;">Recover By Case</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn, $queryValues);
            $count = 1;
            while ($row = mysqli_fetch_array($result)) {
                $country = $row[0];
                $caseByPop = $row[1];
                $testByPop  = $row[2];
                $caseByTest = $row[3];
                $deadByPop = $row[4];
                $deadByCase = $row[5];
                $recoverByPop = $row[6];
                $recoverByCase = $row[7];
                $flag = $row[8];

                echo "<tr>";
                echo "<td>{$count}</td>";
                echo "<td><img src=\"$flag\"></td>";
                echo "<td>{$country}</td>";
                echo "<td>{$caseByPop}</td>";
                echo "<td>{$testByPop}</td>";
                echo "<td>{$caseByTest}</td>";
                echo "<td>{$deadByPop}</td>";
                echo "<td>{$deadByCase}</td>";
                echo "<td>{$recoverByPop}</td>";
                echo "<td>{$recoverByCase}</td>";
                echo "</tr>";
                $count++;
            }
            ?>
        </tbody>
</body>

</html>