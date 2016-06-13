<?php
include '../config/dbconnect.php';
include '../validation/validate_assigned_create.php';
include '../structure/header.php';

// Get the playerID

$playerID = null;
if ( !empty($_GET['playerID'])) 
{
	$playerID = $_REQUEST['playerID'];
}

?>

<h1>Add Board Game</h1>

<!-- This page allows users to assign boardgames to players using their playerID -->

<div class="table-responsive">
<form method="post" action="assigned/add_assigned.php?playerID=<?php echo $playerID?>">
<table class="table display table table-bordered table-striped" cellspacing="0">

<tr><td>
<input type="text" name="boardGame" placeholder="Board Game Name" required pattern="[a-zA-Z0-9 ]+" value="<?php echo $boardGame;?>"></input>
<span class="error">* <?php echo $boardGameError;?></span>
</td></tr>

<tr><td>
<button type="submit" class="btn btn-danger">Save</button>
</td></tr>

</table>
</form>
</div>

<a class = "btn btn-primary" href = "assigned/read_assigned.php?playerID=<?php echo $playerID;?>" role = "button">Back</a>

<?php
include '../structure/footer.php';
?>
