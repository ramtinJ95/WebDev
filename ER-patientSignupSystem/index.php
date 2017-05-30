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
	<title>LABB 2</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid"> 
			<div class="navbar-header">
				<a class = "navbar-brand" href="#">Patient submission forms</a>
			</div>
			<ul class = "nav navbar-nav">
				<li class ="active"><a href="#">Home</a></li>
				<li><a href="./nurse.php">Nurse</a></li>
				<li><a href="./doktor.php">Doktor</a></li>
				<li><a href="./queue.php">Queue Lists</a></li>
				<li><a href="./log.php">Log</a></li>
			</ul>
		</div>
	</nav>
	<div class ="container-fluid">
		<h2>All Patients Currently In Queue</h2>
		<?php 
				$sql = "SELECT * FROM Patient ORDER BY Assigned_Team, Prio DESC";
				$run = mysqli_query($connection, $sql);
				echo "
					<table class = 'table'>
						<thead>
							<tr>
								<th>Prio</th>
								<th>PID</th>
								<th>Name</th>
								<th>Age</th>
								<th>Gender</th>
								<th>Arrival</th>
								<th>Assigned Team</th>
								<th>Issue</th>
							</tr>
						</thead>
						<tbody>
				";
				while($rows = mysqli_fetch_assoc($run))
				{
					echo "
						<tr>
							<td>$rows[Prio]</td>
							<td>$rows[PID]</td>
							<td>$rows[Name]</td>
							<td>$rows[Age]</td>
							<td>$rows[Gender]</td>
							<td>$rows[Arrival]</td>
							<td>$rows[Assigned_Team]</td>
							<td>$rows[Issue]</td>
						</tr>
					";
				}
			?>
		</div>
</body>

</html>