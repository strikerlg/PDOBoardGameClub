<?php

$firstNameError = $lastNameError = $emailAddressError = $phoneNumberError = "";
$firstName = $lastName = $emailAddress = $phoneNumber = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$valid = true;

	if (empty($_POST["firstName"])) 
	{
    	$firstNameError = "First name is required";
    	$valid = false;
  	} 
  	else 
  	{
    	$firstName = validate_input($_POST["firstName"]);
    	// Check if first name only contains letters and whitespace 
    	if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) 
    	{
      		$firstNameError = "Only letters and white space allowed"; 
      		$valid = false;
    	}
  	}

	if (empty($_POST["lastName"])) 
	{
    	$lastNameError = "Last name is required";
    	$valid = false;
  	} 
  	else 
  	{
    	$lastName = validate_input($_POST["lastName"]);
    	// Check if last name only contains letters and whitespace 
    	if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) 
    	{
      		$lastNameError = "Only letters and white space allowed"; 
      		$valid = false;
    	}
  	}
  
  	if (empty($_POST["emailAddress"])) 
  	{
    	$emailAddressError = "Email is required";
    	$valid = false;
  	} 
  	else 
  	{
    	$emailAddress = validate_input($_POST["emailAddress"]);
    	// Check email address formatting
    	if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) 
    	{
      		$emailAddressError = "Invalid email format"; 
      		$valid = false;
    	}
  	}

	if (empty($_POST["phoneNumber"])) 
	{
    	$phoneNumberError = "Phone number is required";
    	$valid = false;
  	} 
  	else 
  	{
    	$phoneNumber = validate_input($_POST["phoneNumber"]);
    	// Check if phone number only contains numbers 
    	if (!preg_match("/^[0-9 ]*$/",$phoneNumber)) 
    	{
      		$phoneNumberError = "Only numbers allowed"; 
      		$valid = false;
    	}
  	}

  // The database will only be connected to if PHP deems that the input is valid 

	// Connect to DB and add player details 

	if ($valid) 
	{
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO players (firstName, lastName, emailAddress, phoneNumber) values(?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($firstName, $lastName, $emailAddress, $phoneNumber));
		Database::disconnect();
		header("Location: index.php");
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