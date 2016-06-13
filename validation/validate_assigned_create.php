<?php

$boardGameError = "";
$boardGame = "";

// Get the playerID, if null redirect to the assigned page

$playerID = null;
if (!empty($_GET['playerID'])) 
{
  $playerID = $_REQUEST['playerID'];
}
    
if ( null==$playerID ) 
{
  header("Location: ../assigned.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$valid = true;

	if (empty($_POST["boardGame"])) 
	{
    $boardGameError = "Board game name is required";
    $valid = false;
  } 
  else 
  {
    $boardGame = validate_input($_POST["boardGame"]);
    // Check if first name only contains letters and whitespace 
    if (!preg_match("/^[a-zA-Z ]*$/",$boardGame)) 
    {
      	$boardGameError = "Only letters and white space allowed"; 
      	$valid = false;
    }
  }
}

// The database will only be connected to if PHP deems that the input is valid 

// Connect to DB and add player details 

if ($valid) 
{
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO gamesassigned (boardGame, playerID) values(?, ?)";
	$q = $pdo->prepare($sql);
	$q->execute(array($boardGame, $playerID));
	Database::disconnect();
	header("Location: ../assigned.php");
}


/* Validate and return input */ 

function validate_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
