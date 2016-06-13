<?php
include '../config/dbconnect.php';
include '../available/validate_add_available.php';
include '../structure/header.php';

// Check if a playerID has been posted, if null redirect the player to the available page 

$playerID = null;
if ( !empty($_GET['playerID'])) {
$playerID = $_REQUEST['playerID'];
}

?>

<h1>Add An Available Board Game</h1>

<div class="table-responsive">
<form method="post" action="available/add.php?playerID=<?php echo $playerID?>">
<table class="table display table table-bordered table-striped" cellspacing="0">

<tr><td>
<input type="text" name="boardGameAvailable" placeholder="Board Game Name" required pattern="[a-zA-Z0-9 ]+" value="<?php echo $boardGameAvailable;?>"></input>
<span class="error">* <?php echo $boardGameError;?></span>
</td></tr>

<tr><td>
<button type="submit" class="btn btn-danger">Save</button>
</td></tr>

</table>
</form>
</div>

<a class = "btn btn-primary" href = "available/read?playerID=<?php echo $playerID;?>" role = "button">Back</a>

<?php
include '../structure/footer.php';
?>
