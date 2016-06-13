<?php
include '../config/dbconnect.php';
include '../scores/validate_update.php';
include '../structure/header.php';
?>

<h1>Update Score</h1>

<!-- Update information in the 'scores' table --> 

<div class="table-responsive">
<form method = "post" action="scores/update.php?playerID=<?php echo $playerID?>">
<table class="table display table table-bordered table-striped" cellspacing="0">

<tr><td>
<input type="number" name="wins" placeholder="Wins" maxlength="30" required value="<?php echo $wins;?>"></input>
<span class="error">* <?php echo $winsError;?></span>
</td></tr>

<tr><td>
<input type="number" name="losses" placeholder="Losses" maxlength="30" required value="<?php echo $losses;?>"></input>
<span class="error">* <?php echo $lossesError;?></span>
</td></tr>

<tr><td>
<button type="submit" class="btn btn-danger">Save</button>
</td></tr>

</table>
</form>
</div>

<a class = "btn btn-primary" href = "scores.php" role = "button">List scores</a>

<?php
include '../structure/footer.php';
?>