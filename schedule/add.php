<?php
include '../config/dbconnect.php';
include '../schedule/validate_add.php';
include '../structure/header.php';
?>

<h1>Add Match</h1>

<!-- Add matches to the 'schedule' table --> 

<div class="table-responsive">
<!-- Testing out better validation --> 
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<table class="table display table table-bordered table-striped" cellspacing="0">

<tr><td>
<input type="text" name="location" placeholder="Location" maxlength="60" required pattern="[a-zA-Z0-9 ]+" value="<?php echo $location;?>"></input>
<span class="error">* <?php echo $locationError;?></span>
</td></tr>

<tr><td>
<input type="text" name="dayPlaying" placeholder="Match Date" maxlength="60" required pattern="\d{1,2}/\d{1,2}/\d{4}" value="<?php echo $dayPlaying;?>"></input>
<span class="error">* <?php echo $dayPlayingError;?></span>
</td></tr>

<tr><td>
<button type="submit" class="btn btn-danger">Save</button>
</td></tr>

</table>
</form>
</div>

<a class = "btn btn-primary" href = "schedule.php" role = "button">List Matches</a>

<?php
include '../structure/footer.php';
?>