<?php
include 'config/dbconnect.php';
include 'structure/header.php';
?>

<h1>Board Games Available</h1>
<h3>Select a board game to view the owner</h3>

<div class="table-responsive">
<table class="table display table table-bordered table-striped" cellspacing="0">
<thead>
<tr>
<th>Owner Player ID</th>
<th>Board Game</th>
<th>Select</th>
</tr>
</thead>

<!-- Display players to view what board games they have available --> 

<tbody>
<?php
$pdo = Database::connect();
$sql = 'SELECT * FROM gamesavailable ORDER BY playerID ASC';
foreach ($pdo->query($sql) as $row) 
{
    ?>

    <tr>
        <td><?php echo $row['playerID'] ?></td>
        <td><?php echo $row['boardGameAvailable'] ?></td>
        <td class="text-center">
        <a class = "btn btn-success" href = "available/read.php?playerID=<?php echo $row['playerID'] ?>" role = "button">Select</a>
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
<a class = "btn btn-danger" href = "available/read_players.php" role = "button">Add Board Game</a>

<?php
include 'structure/footer.php';
?>