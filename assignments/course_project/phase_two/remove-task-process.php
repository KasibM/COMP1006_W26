<?php
//require database connection script
require "includes/connect.php";

//check if post
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    die('Invalid request');
}

//get + sanitise values
$taskID = trim(filter_input(INPUT_GET,'id',FILTER_SANITIZE_SPECIAL_CHARS));


//validation

$errors = [];

if($taskID === null || $taskID === ''){
    $errors[] = " task_id is required.";
}

//if errors stop before inserting into the database
if (!empty($errors)) { ?>
    <?php echo "Failed to remove data due to the following errors:\n";
    foreach ($errors as $error) : ?>
        <li><?php echo $error; ?> </li>
    <?php endforeach;
    //stop the script from executing  
    exit;
}


//build query with named placeholder 
$sql = "DELETE from tasks WHERE id = :task_id";

//prepare the query
$stmt = $pdo->prepare($sql);

//map named placeholder to data
//e.g. $stmt -> bindParam(":first_name", firstName);

$stmt -> bindParam(':task_id', $taskID);


//execute the query
$stmt -> execute();

//close connection
$_pdo = null;

//send back to index
header("Location: index.php");
exit;
?>

 
