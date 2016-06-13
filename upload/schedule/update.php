<?php
include '../config/dbconnect.php';
include '../schedule/validate_update.php';
include '../structure/header.php';
?>

<h1>Update Match</h1>

<div class="table-responsive">
<form method = "post" action="schedule/update.php?scheduleID=<?php echo $scheduleID?>">
<table class="table display table table-bordered table-striped" cellspacing="0">

<tr><td>
<input type="text" name="location" placeholder="Location" required pattern="[a-zA-Z0-9 ]+" value="<?php echo $location;?>"></input>
<span class="error">* <?php echo $locationError;?></span>
</td></tr>

<tr><td>
<input type="datetime" name="dayPlaying" placeholder="Match Date" maxlength="60" required value="<?php echo $dayPlaying;?>"></input>
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