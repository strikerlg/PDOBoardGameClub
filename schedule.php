<?php
include 'config/dbconnect.php';
include 'structure/header.php';
?>

<h1>Games Schedule</h1>

<div class="table-responsive">
<table class="table display table table-bordered table-striped" cellspacing="0">
<thead>
<tr>
<th>Location Playing</th>
<th>Date</th>
<th>Options</th>
</tr>
</thead>

<tbody>
<?php
// Connect to the database and print the location and date that games are being played
$pdo = Database::connect();
$sql = 'SELECT * FROM schedule ORDER BY scheduleID ASC';
foreach ($pdo->query($sql) as $row) 
{
	?>

	<tr>
		<td><?php echo $row['location'] ?></td>
    	<td><?php echo $row['dayPlaying'] ?></td>
    	<td>
    	<a href="schedule/update.php?scheduleID=<?php echo $row['scheduleID'] ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  Edit  </a>
    	<a href="schedule/delete.php?scheduleID=<?php echo $row['scheduleID'] ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>  Delete</a>
    	</td>
	</tr>

	<?php 
	Database::disconnect();
}
?>

</tbody>

</table>
</div>

<a class = "btn btn-primary" href = "index.php" role = "button">Home</a>

<a class = "btn btn-primary" href = "schedule/add.php" role = "button">Add Match</a>

<?php
include 'structure/footer.php';
?>