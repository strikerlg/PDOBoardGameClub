<?php
include 'config/dbconnect.php';
include 'structure/header.php';

$playerID = 0;
     
if ( !empty($_GET['playerID'])) 
{
	// Get the playerID
	$playerID = $_REQUEST['playerID'];
}
     
if ( !empty($_POST)) 
{
	// Get the POST value 
	$playerID = $_POST['playerID'];
         
	// Delete the selected player using their playerID 
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM players  WHERE playerID = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($playerID));
	Database::disconnect();
	header("Location: index.php");         
}

?>

<?php

$playerID = null;
if ( !empty($_GET['playerID'])) 
{
	$playerID = $_REQUEST['playerID'];
}

// If nothing is posted, return the user to the index page     
if ( null==$playerID ) 
{
	header("Location: index.php");
} 
// Otherwise, delete the player via playerID that was posted 
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
 
<!-- Confirm with the user that they wish to delete player x --> 

<h1>Confirm Deletion?</h1>
<form action="delete.php" method="post">
<input type="hidden" name="playerID" value="<?php echo $playerID;?>"/>
<p>Are you sure you would like to delete <b><?php echo $data['firstName'] ?> <?php echo $data['lastName'] ?></b> from the players database?</p>
<button type="submit" class="btn btn-danger">Yes</button>
<a href="index.php" class="btn btn-success btn-md"> No</a>
</form>

<?php
include 'structure/footer.php';
?>