<?php

// Clear variables

$boardGameError = "";
$boardGameAvailable = "";

// Get the playerID, if null return user to the available page 

$playerID = null;
if (!empty($_GET['playerID'])) 
{
  $playerID = $_REQUEST['playerID'];
}
    
if ( null==$playerID ) 
{
  header("Location: ../available.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $valid = true;

  if (empty($_POST["boardGameAvailable"])) 
  {
    $boardGameError = "Board game name is required";
    $valid = false;
  } 
  else 
  {
    $boardGameAvailable = validate_input($_POST["boardGameAvailable"]);
    // Check if first name only contains letters and whitespace 
    if (!preg_match("/^[a-zA-Z ]*$/",$boardGameAvailable)) 
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
  $sql = "INSERT INTO gamesavailable (boardGameAvailable, playerID) values(?, ?)";
  $q = $pdo->prepare($sql);
  $q->execute(array($boardGameAvailable, $playerID));
  Database::disconnect();
  header("Location: ../available.php");
}

// Validate and return input  

function validate_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
