<?php 
	
	$host = 'localhost';
	$user = 'ramtin';
	$pass = 'hello123';
	$db_name = 'labb';

	$connection = mysqli_connect($host,$user,$pass,$db_name);

	global $connection;

	// Den här lilla kod snutten behövs för att få rätt alternativ för listorna. 
	$query = "SELECT * FROM Medical_issue";
	$query2 = "SELECT * FROM Team"; 

	$Issue_Results = mysqli_query($connection, $query);
	$Issues = "";

	// tar ut alla sjukdomar
	while($row = mysqli_fetch_array($Issue_Results))
	{
		$Issues = $Issues."<option>$row[1]</option>";
	}

	$Team_Results = mysqli_query($connection, $query2);
	$Team = "";

	// tar ut alla team nummer
	while($row2 = mysqli_fetch_array($Team_Results))
	{
		$Team = $Team."<option>$row2[0]</option>";
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Nurse page</title>

	<!-- Alla link grejer för att importa in lite css och bootstrap till sidan -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body>
	<div class = "container">
		<div class="jumbotron">
			<h2>Nurse Page</h2>
		</div>
		<h2> Insert new patient </h2>
			<form class = "col-md-6" method = "post">
				<div class = "form-group">
					<label> Patient priority level </label>
					<input type ="text" name="Prio" class = "form-control" required>
				</div>

				<div class = "form-group">
					<label> Patient Social Security Number </label>
					<input type ="text" name="PID" class = "form-control" required>
				</div>

				<div class = "form-group">
					<label> Patient Name </label>
					<input type ="text" name="PatientName" class = "form-control" required>
				</div> 

				<div class = "form-group">
					<label> Patient Age </label>
					<input type ="text" name="PatientAge" class = "form-control" required>
				</div> 

				<div class = "form-group">
					<label> Patient Gender</label>
					<input type ="text" name="PatientGender" class = "form-control" required>
				</div> 

				<div class = "form-group">
					<label> Patient Arrival</label>
					<input type ="text" name="PatientArrival" class = "form-control" required>
				</div>

				<div class = "form-group">
					<label> Patient Heart Rate</label>
					<input type ="text" name="PatientHeartR" class = "form-control" required>
				</div>

				<div class = "form-group">
					<label> Patient Blood Pressure</label>
					<input type ="text" name="PatientBloodP" class = "form-control" required>
				</div>

				<div class = "form-group">
					<select name="formIssue">
						<option value="">Select Medical issue</option>
						<?php echo $Issues; ?>
					</select>
				</div>

				<div class = "form-group">
					<select name="formTeam">
						<option value="">Select Medical Team</option>
						<?php echo $Team; ?>
					</select>
				</div>

				<div class = "form-group">
					<input type = "submit" name = "submitPatient" class = "btn btn-primary">
				</div>
	
				<div class = "form-group">
					<a href = './index.php' class = 'btn btn-success'>Home</a>
				</div>

			</form>
			<?php 
				$sql = "SELECT team_id,Fixes1,Fixes2,Fixes3 FROM Team";
				$run = mysqli_query($connection, $sql);
				echo "
					<table class = 'table'>
						<thead>
							<tr>
								<th>Team Number</th>
								<th>Fixes1</th>
								<th>Fixes2</th>
								<th>Fixes3</th>
							</tr>
						</thead>
						<tbody>
				";
				while($rows = mysqli_fetch_assoc($run))
				{
					echo "
						<tr>
							<td>$rows[team_id]</td>
							<td>$rows[Fixes1]</td>
							<td>$rows[Fixes2]</td>
							<td>$rows[Fixes3]</td>
							<td>$rows[Fixes4]</td>

						</tr>
					";
				}
			?>
		</div>
</body>

</html>

<?php
	
	if(isset($_POST['submitPatient']))
	{
		$Prio =strip_tags($_POST['Prio']);
		$PID = strip_tags($_POST['PID']);
		$PatientAge = strip_tags($_POST['PatientAge']);
		$PatientName =  strip_tags($_POST['PatientName']);
		$PatientGender =  strip_tags($_POST['PatientGender']);
		$PatientArrival =  strip_tags($_POST['PatientArrival']);
		$formTeam =  strip_tags($_POST['formTeam']);
		$formIssue =  strip_tags($_POST['formIssue']);
		$PatientHeartR = strip_tags($_POST['PatientHeartR']);
		$PatientBloodP =  strip_tags($_POST['PatientBloodP']);

		$insP_sql = "INSERT INTO patient (Prio, PID, Name, Age, Gender, Arrival, Assigned_Team, Issue) VALUES ('$Prio', '$PID', '$PatientName', '$PatientAge', '$PatientGender', '$PatientArrival', '$formTeam', '$formIssue')"; // insert patient

		$insV_sql = "INSERT INTO Vitals (PID, Heart_Rate, Blood_pressure) VALUES ('$PID', '$PatientHeartR', '$PatientBloodP') "; // insert patient vitals 

		$insQ_sql = "INSERT INTO Queue (Prio, PID, TeamID, Entered) VALUES ('$Prio', '$PID', '$formTeam', now())";

		if(mysqli_query($connection, $insP_sql) && mysqli_query($connection, $insV_sql) && mysqli_query($connection, $insQ_sql))
		{
			?>

			<script>window.location = "index.php";</script>

			<?php
		}else {
			echo "Något gick jävligt fel när du försökte sätta in patient data i databasen"; 
		}
	}
?>
