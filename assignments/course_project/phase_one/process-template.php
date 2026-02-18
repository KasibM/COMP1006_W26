<?php
//require database connection script
require "includes/connect.php"; 

//check if post
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request');
}

//get + sanitise values



//validation

$errors = [];

//if errors stop before inserting into the database

//build query with named placeholder 
$sql = "";

//prepare the query
$stmt = $pdo->prepare($sql);

//map named placeholder to data
//e.g. $stmt -> bindParam(":first_name", firstName);

//execute the query
$stmt->execute();

//close connection
$_pdo = null;

?>
<!-- display in html -->
<? require "includes/header.php"; ?> 
<main>


</main>
<?php require "includes/footer.php"; ?>