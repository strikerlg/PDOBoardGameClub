<?php
include '../config/dbconnect.php';
include '../structure/header.php';

$scheduleID = 0;
     
if ( !empty($_GET['scheduleID'])) 
{
	$scheduleID = $_REQUEST['scheduleID'];
}
     
if ( !empty($_POST)) 
{
	// Get the POST value 
	$scheduleID = $_POST['scheduleID'];
         
	// Delete the selected match using the scheduleID 
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM schedule  WHERE scheduleID = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($scheduleID));
	Database::disconnect();
	header("Location: ../schedule.php");         
}

?>

<?php

// Get the scheduleID, redirect to the schedule page if null 

$scheduleID = null;
if ( !empty($_GET['scheduleID'])) {
$scheduleID = $_REQUEST['scheduleID'];
}
     
if ( null==$scheduleID ) 
{
	header("Location: ../schedule.php");
} 
else 
{
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM schedule where scheduleID = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($scheduleID));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
}

?>

<!-- Confirm with user what they are deleting -->
 
<h1>Confirm Deletion?</h1>
<form action="schedule/delete.php" method="post">
<input type="hidden" name="scheduleID" value="<?php echo $scheduleID;?>"/>
<p>Are you sure you would like to delete the game at <b><?php echo $data['location'] ?></b> on <b><?php echo $data['dayPlaying'] ?></b> from the schedule database?</p>
<button type="submit" class="btn btn-danger">Yes</button>
<a href="schedule.php" class="btn btn-success btn-md"> No</a>
</form>

<?php
include '../structure/footer.php';
?>