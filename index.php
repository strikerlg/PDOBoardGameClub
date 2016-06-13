<?php
include 'config/dbconnect.php';
include 'structure/header.php';
?>

<h1>Player Information</h1>

<div class="table-responsive">
<table class="table display table table-bordered table-striped" cellspacing="0">
<thead>
<tr>
<th>Player ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email Address</th>
<th>Phone Number</th>
<th>Options</th>
</tr>
</thead>

<!-- List all of the players in the 'players' database -->

<tbody>
<?php
$pdo = Database::connect();
$sql = 'SELECT * FROM players ORDER BY playerID ASC';
foreach ($pdo->query($sql) as $row) 
{
	?>

	<tr>
		<td><?php echo $row['playerID'] ?></td>
    	<td><?php echo $row['firstName'] ?></td>
    	<td><?php echo $row['lastName'] ?></td>
    	<td><?php echo $row['emailAddress'] ?></td>
    	<td><?php echo $row['phoneNumber'] ?></td>
    	<td>
    	<a href="read.php?playerID=<?php echo $row['playerID'] ?>"><span class="glyphicon glyphicon-book" aria-hidden="true"></span>  Read  </a>
    	<a href="update.php?playerID=<?php echo $row['playerID'] ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  Edit  </a>
    	<a href="delete.php?playerID=<?php echo $row['playerID'] ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>  Delete</a>
    	</td>
	</tr>

	<?php 
	Database::disconnect();
}
?>

</tbody>

</table>
</div>

<!-- Show the players what other functions this web application can perform --> 

<div class="table-responsive">
<table class="table display table table-borderless table-striped" cellspacing="0">
<tr><td class="text-center">
<a class = "btn btn-primary" href = "add.php" role = "button">Add a new player</a>
</td><td class="text-center">
<a class = "btn btn-primary" href = "scores.php" role = "button">View scores</a>
</td><td class="text-center">
<a class = "btn btn-primary" href = "available.php" role = "button">Games available</a>
</td><td class="text-center">
<a class = "btn btn-primary" href = "assigned.php" role = "button">Games assigned</a>
</td><td class="text-center">
<a class = "btn btn-primary" href = "schedule.php" role = "button">Upcoming events</a>
</td></tr>

</table>
</div>

<?php
include 'structure/footer.php';
?>