<?php
//require database connection script
require "includes/connect.php"; 
require "includes/header.php";

//build query with named placeholder 
$sql = "SELECT * FROM tasks";

//prepare the query
$stmt = $pdo->prepare($sql);

//execute the query
$stmt -> execute();

//fetch query results
$tasks = $stmt->fetchALL();

//close connection
$_pdo = null;

?>
<!-- display in html -->
 
<main>
    <div class = "container-sm">
        <br>
        <h2>Tasks</h2>
        
        
        
    </div>
</main>
<?php require "includes/footer.php"; ?>