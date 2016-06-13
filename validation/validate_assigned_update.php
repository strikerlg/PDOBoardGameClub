<?php

$boardGameError = "";
$boardGame = "";

$boardGameID = null;
if (!empty($_GET['boardGameID'])) 
{
  $boardGameID = $_REQUEST['boardGameID'];
}
    
if ( null==$boardGameID ) 
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

  // The database will only be connected to if PHP deems that the input is valid 
      
  // update data
  if ($valid) 
  {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE gamesassigned set boardGame = ? WHERE boardGameID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($boardGame,$boardGameID));
    Database::disconnect();
    header("Location: ../assigned.php");
  } 
}
// Return user submitted data to the form, present errors 
else 
{
  $pdo = Database::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM gamesassigned where boardGameID = ?";
  $q = $pdo->prepare($sql);
  $q->execute(array($boardGameID));
  $data = $q->fetch(PDO::FETCH_ASSOC);
  $boardGame = $data['boardGame'];
  Database::disconnect();
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