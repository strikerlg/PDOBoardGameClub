<?php
include 'config/dbconnect.php';
include 'structure/header.php';
?>

<h1>Board Games Assigned</h1>
<h3>Select a player to view their assigned board games</h3>

<!-- Creates a responsive table using Bootstrap --> 

<div class="table-responsive">
<table class="table display table table-bordered table-striped" cellspacing="0">
<thead>
<tr>
<th>Player ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email Address</th>
<th>Phone Number</th>
<th>Select</th>
</tr>
</thead>

<!-- List players and order them by playerID. Allow them to be selected -->

<tbody>
<?php
$pdo = Database::connect();
$sql = 'SELECT * FROM players ORDER BY playerID ASC';
foreach ($pdo->query($sql) as $row) 
{
    ?>

    <tr>
        <td><?php echo $row['playerID'] ?></td>
        <td><?php echo $row['firstName'] ?></td>
        <td><?php echo $row['lastName'] ?></td>
        <td><?php echo $row['emailAddress'] ?></td>
        <td><?php echo $row['phoneNumber'] ?></td>
        <td class="text-center">
        <a class = "btn btn-success" href = "assigned/read_assigned.php?playerID=<?php echo $row['playerID'] ?>" role = "button">Select</a>
        </td>
    </tr>
<!-- Disconnect the database to conserve resources --> 
    <?php 
    Database::disconnect();
}
?>

</tbody>

</table>
</div>

<a class = "btn btn-primary" href = "index.php" role = "button">Home</a>

<?php
include 'structure/footer.php';
?>