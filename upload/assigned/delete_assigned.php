<?php
include '../config/dbconnect.php';
include '../structure/header.php';

$playerID = 0;

// Get the boardGameID
     
if ( !empty($_GET['boardGameID'])) 
{
	$boardGameID = $_REQUEST['boardGameID'];
}
     
if ( !empty($_POST)) 
{
	// Get the POST value 
	$boardGameID = $_POST['boardGameID'];
         
	// Delete the selected player using their playerID 
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM gamesassigned WHERE boardGameID = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($boardGameID));
	Database::disconnect();
	header("Location: ../assigned.php");         
}

?>

<?php

// Get the boardGameID, if null return the user to the assigned page 

$boardGameID = null;
if ( !empty($_GET['boardGameID'])) {
$boardGameID = $_REQUEST['boardGameID'];
}
     
if ( null==$boardGameID ) 
{
	header("Location: ../assigned.php");
} 
else 
{
	// Connect to the database, get player and boardgame information from the tables 'players' and 'gamesassigned'
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM gamesassigned JOIN players USING(playerID) WHERE boardGameID = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($boardGameID));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
}

?>

<!-- Confirm with the user what they are deleting --> 
 
<h1>Confirm Deletion?</h1>
<form action="assigned/delete_assigned.php" method="post">
<input type="hidden" name="boardGameID" value="<?php echo $boardGameID;?>"/>
<p>Are you sure you would like to delete the game <b><?php echo $data['boardGame'] ?></b> from <b><?php echo $data['firstName'] ?> <?php echo $data['lastName'] ?></b>?</p>
<button type="submit" class="btn btn-danger">Yes</button>
<a href="assigned.php" class="btn btn-success btn-md"> No</a>
</form>

<?php
include 'structure/footer.php';
?>