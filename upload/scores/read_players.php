<?php
include '../config/dbconnect.php';
include '../structure/header.php';
?>

<h1>Player List</h1>
<h3>Select a player to add a highscore</h3>

<div class="table-responsive">
<table class="table display table table-bordered table-striped" cellspacing="0">
<thead>
<tr>
<th>Player ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email Address</th>
<th>Phone Number</th>
<th>Select</th>
</tr>
</thead>

<tbody>


<?php
// Connect to the database and select all from the 'players' table 
$pdo = Database::connect();
$sql = 'SELECT * FROM players ORDER BY playerID ASC';
foreach ($pdo->query($sql) as $row) 
{
    ?>

    <tr>
        <!-- Print the player information --> 
        <td><?php echo $row['playerID'] ?></td>
        <td><?php echo $row['firstName'] ?></td>
        <td><?php echo $row['lastName'] ?></td>
        <td><?php echo $row['emailAddress'] ?></td>
        <td><?php echo $row['phoneNumber'] ?></td>
        <td class="text-center">
        <a class = "btn btn-success" href = "scores/add_score.php?playerID=<?php echo $row['playerID'] ?>" role = "button">Select</a>
        </td>
    </tr>

    <?php 
    Database::disconnect();
}
?>

</tbody>
</table>
</div>

<a class = "btn btn-primary" href = "scores.php" role = "button">List scores</a>

<?php
include '../structure/footer.php';
?>