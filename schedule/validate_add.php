<?php

// Clear variables 

$locationError = $dayPlayingError = "";
$location = $dayPlaying = "";

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
      //OK!
    }
    else 
    {
       $dayPlayingError = "Invalid date format. Use DD/MM/YYYY";
       $valid = false;
    }
  }
  
  	
  // The database will only be connected to if PHP deems that the input is valid 

	// Connect to DB and add player details  

	if ($valid) 
	{
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO schedule (location, dayPlaying) values(?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($location, $dayPlaying));
		Database::disconnect();
		header("Location: ../schedule.php");
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

?>