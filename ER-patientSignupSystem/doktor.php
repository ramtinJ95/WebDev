<?php 
	$host = 'localhost';
	$user = 'ramtin';
	$pass = 'hello123';
	$db_name = 'labb';

	$connection = mysqli_connect($host,$user,$pass,$db_name);

	global $connection;

	$query = "SELECT * FROM Drug";
	$Drug_result = mysqli_query($connection, $query);
	$Drug = "";
	while($row = mysqli_fetch_array($Drug_result))
	{
		//$Drug = $Drug."<option>$row[0], Cost: $row[1]</option>";
		$Drug = $Drug."<option>$row[0]</option>";
	}

	$query2 = "SELECT * FROM Procedures";
	$Procedures_result = mysqli_query($connection, $query2);
	$Procedures = "";

	while($row2 = mysqli_fetch_array($Procedures_result))
	{
		//$Procedures = $Procedures."<option>$row2[0], Cost: $row2[1]</option>";
		$Procedures = $Procedures."<option>$row2[0]</option>";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title> Doktor Page</title>

	<!-- Alla link grejer för att importa in lite css och bootstrap till sidan -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body>
	<div class = "container">
		<div class="jumbotron">
			<h2>Doktor Page</h2>
			</div>
		<form class = "col-md-6" method = "post">
			<div class = "form-group">
				<label> Patient Social Security Number </label>
				<input type = "text" name = "PID" class = "form-control" required>
			</div>

			<div class = "form-group">
				<select name="Drug1">
					<option value="">Select Drug used</option>
					<?php echo $Drug; ?>
				</select>
			</div>

			<div class = "form-group">
				<select name="Drug2">
					<option value="">Select Drug used</option>
					<?php echo $Drug; ?>
				</select>
			</div>

			<div class = "form-group">
				<select name="Drug3">
					<option value="">Select Drug used</option>
					<?php echo $Drug; ?>
				</select>
			</div>

			<div class = "form-group">
				<select name="Procedure1">
					<option value="">Select Procedure used</option>
					<?php echo $Procedures; ?>
				</select>
			</div>

			<div class = "form-group">
				<select name="Procedure2">
					<option value="">Select Procedure used</option>
					<?php echo $Procedures; ?>
				</select>
			</div>

			<div class = "form-group">
				<select name="Procedure3">
					<option value="">Select Procedure used</option>
					<?php echo $Procedures; ?>
				</select>
			</div>

			<div class = "form-group">
				<select name="Status">
					<option value="">Select Patient Status</option>
					<option><?php echo "Further Care"; ?></option>
					<option><?php echo "Send Home" ?></option>
				</select>
			</div>

			<div class = "form-group">
				<input type ="submit" name = "submitPatient" class = "btn btn-primary">
			</div>

			<div class = "form-group">
				<a href = './index.php' class = 'btn btn-success'>Home</a>
			</div>
		</form>
	</div>
</body>
</html>

<?php 

		if(isset($_POST['submitPatient']))
		{
			$PID = mysqli_real_escape_string($connection, strip_tags($_POST['PID']));
			$Drug1 = mysqli_real_escape_string($connection, strip_tags($_POST['Drug1']));
			$Drug2 = mysqli_real_escape_string($connection, strip_tags($_POST['Drug2']));
			$Drug3 = mysqli_real_escape_string($connection, strip_tags($_POST['Drug3']));
			$Procedure1 = mysqli_real_escape_string($connection, strip_tags($_POST['Procedure1']));
			$Procedure2 = mysqli_real_escape_string($connection, strip_tags($_POST['Procedure2']));
			$Procedure3 = mysqli_real_escape_string($connection, strip_tags($_POST['Procedure3']));
			$Status = mysqli_real_escape_string($connection, strip_tags($_POST['Status']));

			// Plockar ut data för att logga patienten
			$costP1 = mysqli_query($connection, "SELECT Cost FROM Procedures WHERE procedure_id = '$_POST[Procedure1]'");
			$C1 = mysqli_fetch_array($costP1);
			$C1_result = $C1['Cost'];

			$costP2 = mysqli_query($connection, "SELECT Cost FROM Procedures WHERE procedure_id = '$_POST[Procedure2]'");
			$C2 = mysqli_fetch_array($costP2);
			$C2_result = $C2['Cost'];

			$costP3 = mysqli_query($connection, "SELECT Cost FROM Procedures WHERE procedure_id = '$_POST[Procedure3]'");
			$C3 = mysqli_fetch_array($costP3);
			$C3_result = $C3['Cost'];

			$costD1 = mysqli_query($connection, "SELECT Cost FROM Drug WHERE Name = '$_POST[Drug1]'");
			$D1 = mysqli_fetch_array($costD1);
			$D1_result = $D1['Cost'];

			$costD2 = mysqli_query($connection, "SELECT Cost FROM Drug WHERE Name = '$_POST[Drug2]'");
			$D2 = mysqli_fetch_array($costD2);
			$D2_result = $D2['Cost'];

			$costD3 = mysqli_query($connection, "SELECT Cost FROM Drug WHERE Name = '$_POST[Drug3]'");
			$D3 = mysqli_fetch_array($costD3);
			$D3_result = $D3['Cost'];
			
			$sum = $C1_result + $C2_result + $C3_result + $D1_result + $D2_result + $D3_result;
			

			//  Datum och tid då patienten fick hjälp
			$signout = (new DateTime()) -> format('Y-m-d H:i:s');

			
			// Vitals värden hämtas
			$Vitals_sql = mysqli_query($connection, "SELECT * FROM Vitals WHERE PID = '$_POST[PID]'");
			$Vitals = mysqli_fetch_array($Vitals_sql);
			$HeartRate = $Vitals['Heart_Rate'];
			$BloodPressure = $Vitals['Blood_pressure'];

		
			// Datum och tid då patienten kom in
			$Que_sql = mysqli_query($connection, "SELECT * FROM Queue WHERE PID = '$PID'");
			$Que = mysqli_fetch_array($Que_sql);
			$Entered = $Que['Entered'];


			// Patientens medical issue
			$patientInfo_sql = mysqli_query($connection, "SELECT * FROM Patient WHERE PID = '$_POST[PID]'");
			$patientInfo = mysqli_fetch_array($patientInfo_sql);
			$MedIssue = $patientInfo['Issue'];
	

			$ins_LP = "INSERT INTO log (PId, Heart_Rate, Blood_pressure, Medical_issue, Entered, Recived_Help, Status, Cost, Drug1, Drug2, Drug3, Procedure1, Procedure2, Procedure3) VALUES ('$PID', '$HeartRate', '$BloodPressure', '$MedIssue', '$Entered', '$signout', '$Status', '$sum', '$Drug1', '$Drug2', '$Drug3', '$Procedure1', '$Procedure2', '$Procedure2')";

			if(mysqli_query($connection, $ins_LP))
			{
				if($Status == "Send Home")
				{
					$removePatient = "DELETE FROM Patient WHERE PID = '$PID'";
					if(mysqli_query($connection, $removePatient))
					{
						?>
						<script>window.location = "log.php";</script>
						<?php
					}
				}else
				{
					$removePatientQue = "DELETE FROM Queue WHERE PID = '$PID' "; 
					if(mysqli_query($connection, $removePatientQue))
					{
						?>
						<script>window.location = "index.php";</script>
						<?php
					}
				}
			}


		}
?>