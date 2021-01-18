<?php
$servername = "localhost";
$database = "covidservice";
$username = "root";
$password = null;
$conn = mysqli_connect($servername, $username, $password, $database);
$query = "SELECT cp.country, caseByPop, testByPop, caseByTest, deadByPop, deadByCase, recoverByPop, recoverbyCase,  flag FROM casesPercentage AS cp JOIN testsPercentage AS tp ON cp.country = tp.country JOIN deathsPercentage AS dp ON tp.country = dp.country JOIN recoveredPercentage AS rp ON dp.country = rp.country JOIN generaltable AS gt ON rp.country = gt.country ORDER BY `cp`.`country` ASC";
?>

<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="index.css" />
</head>

<body>
    <table class="styled-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Flag</th>
                <th>Country</th>
                <th>Case By Pop</th>
                <th>Test By Pop</th>
                <th>Case By Test</th>
                <th>Dead By Pop</th>
                <th>Dead By Case</th>
                <th>Recover By Pop</th>   
                <th>Recover By Case</th>                  
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn, $query);
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