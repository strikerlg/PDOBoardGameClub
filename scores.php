<?php
include 'config/dbconnect.php';
include 'structure/header.php';
?>

<h1>Player Scores</h1>

<div class="table-responsive">
<table class="table display table table-bordered table-striped" cellspacing="0">
<thead>
<tr>
<th>Player ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Wins</th>
<th>Losses</th>
<th>Options</th>
</tr>
</thead>

<tbody>
<?php
// Connect to the database and print out how many wins/losses each player with a score assigned has 
$pdo = Database::connect();
$sql = 'SELECT * FROM players JOIN highscores ON highscores.playerID=players.playerID ORDER BY wins DESC';
foreach ($pdo->query($sql) as $row) 
{
	?>

	<tr>
		<td><?php echo $row['playerID'] ?></td>
    	<td><?php echo $row['firstName'] ?></td>
    	<td><?php echo $row['lastName'] ?></td>
    	<td><?php echo $row['wins'] ?></td>
        <td><?php echo $row['losses'] ?></td>
    	<td>
    	<a href="scores/update.php?playerID=<?php echo $row['playerID'] ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  Edit  </a>
    	<a href="scores/delete.php?playerID=<?php echo $row['playerID'] ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>  Delete</a>
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
<a class = "btn btn-danger" href = "scores/read_players.php" role = "button">Add High Score</a>

<?php
include 'structure/footer.php';
?>