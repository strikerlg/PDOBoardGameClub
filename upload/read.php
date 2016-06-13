<?php
include 'config/dbconnect.php';
include 'structure/header.php';

//If the playerID is null then redirect the user to the index page 

$playerID = null;
if ( !empty($_GET['playerID'])) {
$playerID = $_REQUEST['playerID'];
}
     
if ( null==$playerID ) {
header("Location: index.php");
} 
// Connect to the database and select all from the players database 
else 
{
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

<!-- Print out player information from the database --> 

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

<a class = "btn btn-primary" href = "index.php" role = "button">List Players</a>

<?php
include 'structure/footer.php';
?>