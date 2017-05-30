<?php 
	$host = 'localhost';
	$user = 'ramtin';
	$pass = 'hello123';
	$db_name = 'labb';

	$connection = mysqli_connect($host,$user,$pass,$db_name);

	global $connection;

	$query = "SELECT * FROM Team";

	$Team_Results = mysqli_query($connection, $query);
	$Team = "";

	while($row = mysqli_fetch_array($Team_Results))
	{
		$Team = $Team."<option>$row[0]</option>";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Queue Page</title>

		<!-- Alla link grejer för att importa in lite css och bootstrap till sidan -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>
	<div class= "container">
		<div class ="jumbotron">
			<h2> Queue Lists For All The Medical Teams</h2>
		</div>
		<form class= "col-md-6" method = "post">
			<div class = "form-group">
				<select name="formTeam">
					<option value="">Select Medical Team</option>
					<?php echo $Team; ?>
				</select>
			</div>

			<div class = "form-group">
				<input type = "submit" name = "TeamPicked" class = "btn btn-primary">
			</div>

			<div class = "form-group">
				<a href = './index.php' class = 'btn btn-success'>Home</a>
			</div>
		</form>
		<?php 
			if(isset($_POST['TeamPicked']))
			{
				$TeamID = strip_tags($_POST['formTeam']);
				$sql = "SELECT * FROM Queue WHERE TeamID = '$TeamID' ORDER BY Prio DESC, Entered ";
				$run = mysqli_query($connection, $sql);
				echo "
						<table class='table'>
							<thead>
								<tr>
									<th>Prio</th>
									<th>PID</th>
									<th>TeamID</th>
									<th>Entered</th>
									<th>Estimatade Queue Time</th>
								</tr>
							</thead>
							<tbody>     
					";
					$i = 0;
					while ($table = mysqli_fetch_assoc($run))
					{
						$Prio = $table[Prio];
						$w8Time = 10*(6-$Prio)*$i . " (min)";
						echo "
								<tr>
									<td>$Prio</td>
									<td>$table[PID]</td>
									<td>$table[TeamID]</td>
									<td>$table[Entered]</td>
									<td>$w8Time</td>
								<tr>
							";
						$i++;
					}
				
			}
		?>
</body>
</html>
