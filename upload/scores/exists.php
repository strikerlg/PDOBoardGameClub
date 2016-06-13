<?php
include '../structure/header.php';
?>

<!-- JS will redirect players here if they already have a score in the database --> 

<h1>Highscore Already Exists</h1>

<p>Players can only have highscore table assigned to them. Please update this players information instead.</p>

<a class = "btn btn-primary" href = "scores.php" role = "button">Back</a>

<?php
include '../structure/footer.php';
?>