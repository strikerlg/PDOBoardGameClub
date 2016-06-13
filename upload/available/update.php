<?php
include '../config/dbconnect.php';
include '../available/validate_update_available.php';
include '../structure/header.php';
?>

<h1>Update Board Game Information</h1>

<!-- Update boardgames in the 'boardGamesAvailable' table -->

<div class="table-responsive">
<form method = "post" action="available/update.php?boardGameID=<?php echo $boardGameID?>">
<table class="table display table table-bordered table-stripe" cellspacing="0">

<tr><td>
<input type="text" name="boardGameAvailable" placeholder="Board Game" required pattern="[a-zA-Z0-9 ]+" value="<?php echo $boardGameAvailable; ?>"></input>
<span class="error">* <?php echo $boardGameError;?></span>
</td></tr>

<tr><td>
<button type="submit" class="btn btn-danger">Update</button>
</td></tr>

</table>
</form>
</div>

<a class = "btn btn-primary" href = "available.php" role = "button">List Games Available</a>

<?php
include '../structure/footer.php';
?>