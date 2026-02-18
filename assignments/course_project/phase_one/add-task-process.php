<?php
//require database connection script
require "includes/connect.php"; 

//check if post
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request');
}

//get + sanitise values
$task_name      = trim(filter_input(INPUT_POST,'',FILTER_SANITIZE_SPECIAL_CHARS));
$task_category  = trim(filter_input(INPUT_POST,'',FILTER_SANITIZE_SPECIAL_CHARS));
$task_priority  = trim(filter_input(INPUT_POST,'',FILTER_SANITIZE_SPECIAL_CHARS));
$task_due_date  = trim(filter_input(INPUT_POST,'',FILTER_SANITIZE_SPECIAL_CHARS));
$task_time      = trim(filter_input(INPUT_POST,'',FILTER_SANITIZE_SPECIAL_CHARS));
$task_status    = trim(filter_input(INPUT_POST,'',FILTER_SANITIZE_SPECIAL_CHARS));


//validation

$errors = [];

if($task_name === null || $task_name === ''){
    $errors[]= "task_name is required.";
}

if($task_category === null || $task_category === ''){
    $errors[]= "task_category is required";
}

if($task_priority !== "Low" && $task_priority !== "Medium" && $task_priority !== "High"){
    $errors[]= "task_priority must be 'Low', 'Medium', or 'High";
}
//left off here feb 17
if($task_due_date === null || $task_due_date === ''){
    $errors[]= "task_due_date is required.";
} else if(!filter_var($task_due_date, FILTER_VALIDATE_REGEXP, ['options'=> ['regexp' => '']] )){

}

if($task_time){
    $errors[]= "";
}

if($task_status){
    $errors[]= "";
}

//if errors stop before inserting into the database

//build query with named placeholder 
$sql = "INSERT INTO task (task_name, task_category, task_priority, task_due_date, task_time, task_status";

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