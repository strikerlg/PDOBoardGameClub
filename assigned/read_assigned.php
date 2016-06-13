<?php
include '../config/dbconnect.php';
include '../structure/header.php';

// Get the playerID

$playerID = null;
if ( !empty($_GET['playerID'])) 
{
    $playerID = $_REQUEST['playerID'];
}

// If the playerID is null, redirect the player to the assigned page 
     
if ( null==$playerID ) 
{
    header("Location: ../assigned.php");
} 
else 
{
    // Connect to the database, select player information 
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM players where playerID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($playerID));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}

?>
 
<h1>Player Information:</h1>

<div class="table-responsive">
<table class="table display table table-bordered table-striped" cellspacing="0">

<thead>
<tr>
<th>Player ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email Address</th>
<th>Phone Number</th>
</tr>
</thead>

<!-- Print out player information --> 

<tbody>
<tr>
<td><?php echo $data['playerID'];?></td>
<td><?php echo $data['firstName'];?></td>
<td><?php echo $data['lastName'];?></td>
<td><?php echo $data['emailAddress'];?></td>
<td><?php echo $data['phoneNumber'];?></td>
</tr>
</tbody>

</table>
</div>

<h3>Board Games Assigned:</h3>

<div class="table-responsive">
<table class="table display table table-bordered table-striped" cellspacing="0">
<thead>
<tr>
<!-- <th>Board Game ID</th> -->
<th>Board Game</th>
<th>Options</th>
</tr>
</thead>

<tbody>

<?php
// Connect to the database and select what games are assigned to a player using their playerID
$pdo = Database::connect();
$sql = "SELECT * FROM gamesassigned JOIN players USING(playerID) WHERE playerID = ?";
$q = $pdo->prepare($sql);
 

$q->execute(array($playerID));
$rows = $q->fetchAll(PDO::FETCH_ASSOC);
 
foreach($rows as $row)
{
    ?>

    <tr>
        <!-- <td><?php echo $row['boardGameID'] ?></td> -->

        <!-- Print this player information out and allow users to select it --> 

        <td><?php echo $row['boardGame'] ?></td>
        <td>
        <a href="assigned/update_assigned.php?boardGameID=<?php echo $row['boardGameID'] ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  Edit  </a>
        <a href="assigned/delete_assigned.php?boardGameID=<?php echo $row['boardGameID'] ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>  Delete</a>
        </td>
    </tr>

    <?php 
    Database::disconnect();
}
?>

</tbody>

</table>
</div>

<a class = "btn btn-primary" href = "assigned.php" role = "button">Back</a>
<a class = "btn btn-danger" href = "assigned/add_assigned.php?playerID=<?php echo $data['playerID'] ?>" role = "button">Add Board Game</a>

<?php
include '../structure/footer.php';
?>