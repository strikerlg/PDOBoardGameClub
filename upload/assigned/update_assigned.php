<?php
include '../config/dbconnect.php';
include '../validation/validate_assigned_update.php';
include '../structure/header.php';
?>

<h1>Update Board Game Information</h1>

<!-- This page allows users to update games which are assigned to players --> 

<div class="table-responsive">
<form method = "post" action="assigned/update_assigned.php?boardGameID=<?php echo $boardGameID?>">
<table class="table display table table-bordered table-stripe" cellspacing="0">

<tr><td>
<input type="text" name="boardGame" placeholder="Board Game" required pattern="[a-zA-Z0-9 ]+" value="<?php echo $boardGame; ?>"></input>
<span class="error">* <?php echo $boardGameError;?></span>
</td></tr>

<tr><td>
<button type="submit" class="btn btn-danger">Update</button>
</td></tr>

</table>
</form>
</div>

<a class = "btn btn-primary" href = "index.php" role = "button">List Players</a>

<?php
include '../structure/footer.php';
?>