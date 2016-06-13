<?php

// Saves checking the Apache error log....

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Clear variables 

$winsError = $lossesError = "";
$wins = $losses = "";

// Get the playerID

$playerID = null;
if ( !empty($_GET['playerID'])) {
$playerID = $_REQUEST['playerID'];
}
     
if ( null==$playerID ) {
header("Location: ../scores.php");
} 
else 
{
  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
  	$valid = true;

  	if (is_null($_POST["wins"]) == true) 
  	{
      	$winsError = "Number of wins is required";
      	$valid = false;
    } 
  	else 
  	{
    	$wins = validate_input($_POST["wins"]);
    	// Check if wins number only contains numbers 
    	if (!preg_match("/^[0-9 ]*$/",$wins)) 
    	{
      		$winsError = "Only numbers allowed"; 
      		$valid = false;
    	}
  	}

  	if (is_null($_POST["losses"]) == true) 
    {
    	$lossesError = "Number of losses is required";
    	$valid = false;
  	} 
  	else 
  	{
    	$losses = validate_input($_POST["losses"]);
    	// Check if number of losses only contains numbers 
    	if (!preg_match("/^[0-9 ]*$/",$losses)) 
    	{
      		$lossesError = "Only numbers allowed"; 
      		$valid = false;
    	}
  	}

  	if ($valid)
  	{

  		$pdo = Database::connect();
  		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  		$sql = "SELECT COUNT(*) FROM highscores WHERE playerID = ?";
  		$q = $pdo->prepare($sql);
  		$q->execute(array($playerID));

  		$number_of_rows = $q->fetchColumn();

  		if ($number_of_rows > 0)

  		{
  			// Using JS to redirect because I broke php
  			echo '<script type="text/javascript">
      		window.location = "../scores/exists.php"
      		</script>';	die();
  		}
  		else 
  		{
  			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  			$sql = "INSERT INTO highscores (wins, losses, playerID) values(?, ?, ?)";
  			$q = $pdo->prepare($sql);
  			$q->execute(array($wins, $losses, $playerID));
  			Database::disconnect();
  			header("Location: ../scores.php");
  		}
  		Database::disconnect();
  	}
  }
}

// Validate and return input 

function validate_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

include '../structure/footer.php';

?>
