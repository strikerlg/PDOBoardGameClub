<?php
include '../config/dbconnect.php';
include '../structure/header.php';

// Get the playerID, if null redirect the page to the main available page 

$playerID = null;
if ( !empty($_GET['playerID'])) {
$playerID = $_REQUEST['playerID'];
}
     
if ( null==$playerID ) 
{
    header("Location: ../available.php");
} 
else 
{
    // Connect to the database and get player details where the playerID = ? 
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
<th>Board Game</th>
<th>Options</th>
</tr>
</thead>

<tbody>

<?php
// Connect to the database and show what games an individual player has available 
$pdo = Database::connect();
$sql = "SELECT * FROM gamesavailable JOIN players USING(playerID) WHERE playerID = ?";
$q = $pdo->prepare($sql);
$q->execute(array($playerID));
$rows = $q->fetchAll(PDO::FETCH_ASSOC);
 
foreach($rows as $row)
{
    ?>

    <tr>
        <td><?php echo $row['boardGameAvailable'] ?></td>
        <td>
        <a href="available/update.php?boardGameID=<?php echo $row['boardGameID'] ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  Edit  </a>
        <a href="available/delete.php?boardGameID=<?php echo $row['boardGameID'] ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>  Delete</a>
        </td>
    </tr>

    <?php 
    Database::disconnect();
}
?>

</tbody>

</table>
</div>

<a class = "btn btn-primary" href = "available.php" role = "button">Back</a>
<a class = "btn btn-danger" href = "available/add.php?playerID=<?php echo $data['playerID'] ?>" role = "button">Add Board Game</a>

<?php
include '../structure/footer.php';
?>