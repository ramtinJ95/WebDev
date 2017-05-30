<?php 
	$host = 'localhost';
	$user = 'ramtin';
	$pass = 'hello123';
	$db_name = 'labb';

	$connection = mysqli_connect($host,$user,$pass,$db_name);

	global $connection;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Log Page</title>

	<!-- Alla link grejer för att importa in lite css och bootstrap till sidan -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body>
	<div class = "container">
		<div class = "jumbotron">
			<h2> Log Page</h2>
		</div>
		<div class = "form-group">
			<a href = './index.php' class = 'btn btn-success'>Home</a>
		</div>
		<?php
			$sql = mysqli_query($connection, "SELECT * FROM LOG");
			echo "
				<table class = 'table'>
					<thead>
						<tr>
							<th>Patient number</th>
							<th>PID</th>
							<th>Heart Rate</th>
							<th>Blood Pressure</th>
							<th>Medical Issue</th>
							<th>Entered</th>
							<th>Recived Help</th>
							<th>Status</th>
							<th>Cost</th>
							<th>Drug1</th>
							<th>Drug2</th>
							<th>Drug3</th>
							<th>Procedure1</th>
							<th>Procedure2</th>
							<th>Procedure3</th>
						</tr>
					</thead>
					<tbody>
			";
			$counter = 0;
			while ($rows = mysqli_fetch_assoc($sql))
			{
				echo "
						<tr>
							<td>$counter</td>
							<td>$rows[PId]</td>
							<td>$rows[Heart_Rate]</td>
							<td>$rows[Blood_pressure]</td>
							<td>$rows[Medical_issue]</td>
							<td>$rows[Entered]</td>
							<td>$rows[Recived_Help]</td>
							<td>$rows[Status]</td>
							<td>$rows[Cost]</td>
							<td>$rows[Drug1]</td>
							<td>$rows[Drug2]</td>
							<td>$rows[Drug3]</td>
							<td>$rows[Procedure1]</td>
							<td>$rows[Procedure2]</td>
							<td>$rows[Procedure3]</td>
						</tr>
					";
					$counter++;
			}

		?>
	</div>

</body>
</html>