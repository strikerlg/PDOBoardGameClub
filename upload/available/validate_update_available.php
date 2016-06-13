<?php

// Clear variables 

$boardGameError = "";
$boardGameAvailable = "";

// Get the boardGameID, if it is null then redirect the user to the available page 

$boardGameID = null;
if (!empty($_GET['boardGameID'])) {
$boardGameID = $_REQUEST['boardGameID'];
}
    
if ( null==$boardGameID ) {
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

    // The database will only be connected to if PHP deems that the input is valid 
        
    // update data

  if ($valid) 
  {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE gamesavailable set boardGameAvailable = ? WHERE boardGameID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($boardGameAvailable,$boardGameID));
    Database::disconnect();
    header("Location: ../available.php");
  } 
}
else 
{
  $pdo = Database::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM gamesavailable where boardGameID = ?";
  $q = $pdo->prepare($sql);
  $q->execute(array($boardGameID));
  $data = $q->fetch(PDO::FETCH_ASSOC);
  $boardGameAvailable = $data['boardGameAvailable'];
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