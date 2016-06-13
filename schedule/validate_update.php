<?php

// Clear variables

$locationError = $dayPlayingError = "";
$location = $dayPlaying = "";

// get the scheduleID, if null then redirect the user to the schedule page

$scheduleID = null;
if (!empty($_GET['scheduleID'])) {
$scheduleID = $_REQUEST['scheduleID'];
}
    
if ( null==$scheduleID ) {
header("Location: schedule.php");
}


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $valid = true;

  if (empty($_POST["location"])) 
  {
    $locationError = "Location is required";
    $valid = false;
  } 
  else 
  {
    $location = validate_input($_POST["location"]);
    // Check if location only contains letters and whitespace 
    if (!preg_match("/^[a-zA-Z ]*$/",$location)) 
    {
        $locationError = "Only letters and white space allowed"; 
        $valid = false;
    }
  }

  if (empty($_POST["dayPlaying"])) 
  {
    $dayPlayingError = "Date and time is required";
    $valid = false;
  } 
  else 
  {
    $dayPlaying = validate_input($_POST["dayPlaying"]);

    $date = ($_POST["dayPlaying"]);

    list($d, $m, $y) = explode('/', $date);

    if(checkdate($m, $d, $y))
    {
      //OK! Date is valid
    }
    else 
    {
       $dayPlayingError = "Invalid date format. Use DD/MM/YYYY";
       $valid = false;
    }
  }
  

  // The database will only be connected to if PHP deems that the input is valid 
        
  // update data
  if ($valid) 
  {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE schedule  set location = ?, dayPlaying = ? WHERE scheduleID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($location,$dayPlaying,$scheduleID));
    Database::disconnect();
    header("Location: ../schedule.php");
  } 
}
// If not valid, return user to form with their input, display errors
else 
{
  $pdo = Database::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM schedule where scheduleID = ?";
  $q = $pdo->prepare($sql);
  $q->execute(array($scheduleID));
  $data = $q->fetch(PDO::FETCH_ASSOC);
  $location = $data['location'];
  $dayPlaying = $data['dayPlaying'];
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