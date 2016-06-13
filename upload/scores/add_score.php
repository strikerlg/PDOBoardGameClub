<?php
include '../config/dbconnect.php';
include '../scores/check_existing_entry.php';
include '../structure/header.php';
?>

<h1>Add Score</h1>

<!-- Add player score information to the 'highscores' table -->

<div class="table-responsive">
<form method = "post" action="scores/add_score.php?playerID=<?php echo $playerID?>">
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