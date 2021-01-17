<html>

<head>
	<title>Covid 19 Table</title>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		$("#refreshData").load("table.php");
		$(document).ready(function(){
			setInterval(function(){
				$("#refreshData").load("table.php");
				refresh();
			},1000);
		});
	</script>
</head>
<body>
</body>
<div id="refreshData" style="width: 100%; height: 100%;"></div>
</html>