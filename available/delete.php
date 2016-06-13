<?php
include '../config/dbconnect.php';
include '../structure/header.php';

$playerID = 0;

// Get the playerID 
     
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
	$sql = "DELETE FROM gamesavailable WHERE boardGameID = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($boardGameID));
	Database::disconnect();
	header("Location: ../available.php");         
}

?>

<?php

// Get the playerID, return the user to the available page if it is null

$boardGameID = null;
if ( !empty($_GET['boardGameID'])) 
{
	$boardGameID = $_REQUEST['boardGameID'];
}
     
if ( null==$boardGameID ) 
{
	header("Location: ../available.php");
} 
else 
{
	// Connect to the database, select all gamesavailable where the playerID = ?
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM gamesavailable JOIN players USING(playerID) WHERE boardGameID = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($boardGameID));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
}

?>
 
<!-- Present the user with player information, confirm they would like to delete it --> 

<h1>Confirm Deletion?</h1>
<form action="available/delete.php" method="post">
<input type="hidden" name="boardGameID" value="<?php echo $boardGameID;?>"/>
<p>Are you sure you would like to delete the game <b><?php echo $data['boardGameAvailable'] ?></b> from <b><?php echo $data['firstName'] ?> <?php echo $data['lastName'] ?></b>?</p>
<button type="submit" class="btn btn-danger">Yes</button>
<a href="assigned.php" class="btn btn-success btn-md"> No</a>
</form>

<?php
include '..structure/footer.php';
?>