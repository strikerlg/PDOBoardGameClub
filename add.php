<?php
include 'config/dbconnect.php';
include 'validation/validate_create.php';
include 'structure/header.php';
?>

<!-- The above <?php ?> code loads the universal header and footer files, and provides a connection to the database --> 

<h1>Add Player</h1>

<!-- Twitter's Bootstrap CSS framework is being used to make this web application very mobile friendly --> 

<div class="table-responsive">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table class="table display table table-bordered table-striped" cellspacing="0">

<!-- Input user information. Even if HTMl5 validation fails the data will be validated via the php validation script --> 

<tr><td>
<input type="text" name="firstName" placeholder="First Name" required pattern="[a-zA-Z0-9 ]+" value="<?php echo $firstName;?>"></input>
<span class="error">* <?php echo $firstNameError;?></span>
</td></tr>

<!-- Name validation allows numbers too, as some names contain numbers apparently... Php script needs updating too.  

http://www.nzherald.co.nz/nz/news/article.cfm?c_id=1&objectid=10523288

--> 
<tr><td>
<input type="text" name="lastName" placeholder="Last Name" maxlength="60" required pattern="[a-zA-Z0-9 ]+" value="<?php echo $lastName;?>"></input>
<span class="error">* <?php echo $lastNameError;?></span>
</td></tr>

<tr><td>
<input type="email" name="emailAddress" placeholder="Email Address" required value="<?php echo $emailAddress;?>"</input>
<span class="error">* <?php echo $emailAddressError;?></span>
</td></tr>

<!-- Telephone numbers vary between countries, allowing numbers but no set pattern (max length of 16) -->

<tr><td>
<input type="tel" name="phoneNumber" placeholder="Phone Number" required pattern="[0-9]" maxlength="16" value="<?php echo $phoneNumber;?>"></input>
<span class="error">* <?php echo $phoneNumberError;?></span>
</td></tr>

<!-- Submit data for php validation and submission --> 

<tr><td>
<button type="submit" class="btn btn-danger">Save</button>
</td></tr>

</table>
</form>
</div>

<a class = "btn btn-primary" href = "index.php" role = "button">List Players</a>

<?php
include 'structure/footer.php';
?>