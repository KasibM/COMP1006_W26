<?php
//require database connection script
require "includes/connect.php"; 
require "includes/header.php";

//check if post
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request');
}

//get + sanitise values
$taskID      = trim(filter_input(INPUT_POST,'task_id',FILTER_SANITIZE_SPECIAL_CHARS));
$taskName      = trim(filter_input(INPUT_POST,'task_name',FILTER_SANITIZE_SPECIAL_CHARS));
$taskCategory  = trim(filter_input(INPUT_POST,'task_category',FILTER_SANITIZE_SPECIAL_CHARS));
$taskPriority  = trim(filter_input(INPUT_POST,'task_priority',FILTER_SANITIZE_SPECIAL_CHARS));
$taskDueDate  = trim(filter_input(INPUT_POST,'task_due_date',FILTER_SANITIZE_SPECIAL_CHARS));
$taskTime      = trim(filter_input(INPUT_POST,'task_time',FILTER_SANITIZE_SPECIAL_CHARS));
$taskStatus    = trim(filter_input(INPUT_POST,'task_status',FILTER_SANITIZE_SPECIAL_CHARS));


//validation

$errors = [];

if($taskID === null || $taskID === ''){
    $errors[] = " task_id is required.";
}

if ($taskDueDate === null || $taskCategory === ''){

} else if (!filter_var($taskDueDate, FILTER_VALIDATE_REGEXP, ['options'=> ['regexp' => '/^\d{4}-\d{2}-\d{2}$/']] )){
    $errors[] = "task_due_date is not in required format expected: 'YYYY-MM-DD', received: '".$taskDueDate."'.";
}

if($taskTime === null || $taskTime === ''){
    
} else if (!filter_var($taskTime, FILTER_VALIDATE_FLOAT)){
    $errors[] = "task_time must be a float.";
} 

//if errors stop before inserting into the database
if (!empty($errors)) { ?>
    <?php echo "Failed to insert data due to the following errors:\n";
    foreach ($errors as $error) : ?>
        <li><?php echo $error; ?> </li>
<?php endforeach;
    //stop the script from executing  
    exit;
}

//since editing has optional field, must retrieve old data to resubmit if it is not changed, or else PDO has a fit


//build query with named placeholder 
$sql = "SELECT * FROM tasks WHERE id = :selected_task";

//prepare the query
$stmt = $pdo->prepare($sql);

//bind param to placeholder
$stmt -> bindParam(':selected_task', $taskID);

//execute the query
$stmt -> execute();

//fetch query results
$task = $stmt->fetch();


//replace empty with original values
if($taskName === null || $taskName === ''){
    $taskName = $task['task_name'];
}
if($taskCategory === null || $taskCategory === ''){
    $taskCategory = $task['task_category'];
}
if($taskPriority === null || $taskPriority === ''){
    $taskPriority = $task['task_priority'];
}
if($taskDueDate === null || $taskDueDate === ''){
    $taskDueDate = $task['task_due_date'];
}
if($taskTime === null || $taskTime === ''){
    $taskTime= $task['task_time'];
}
if($taskStatus === null || $taskStatus === ''){
    $taskStatus = $task['task_status'];
}

//build query with named placeholder 
$sql = "UPDATE tasks 
        SET task_name = :task_name,
            task_category = :task_category,
            task_priority = :task_priority,
            task_due_date = :task_due_date,
            task_time = :task_time,
            task_status = :task_status
        WHERE id = :task_id";

//prepare the query
$stmt = $pdo->prepare($sql);

//map named placeholder to data
//e.g. $stmt -> bindParam(":first_name", firstName);

$stmt -> bindParam(':task_id', $taskID);
$stmt -> bindParam(':task_name', $taskName);
$stmt -> bindParam(':task_category', $taskCategory);
$stmt -> bindParam(':task_priority', $taskPriority);
$stmt -> bindParam(':task_due_date', $taskDueDate);
$stmt -> bindParam(':task_time', $taskTime);
$stmt -> bindParam(':task_status', $taskStatus);


//execute the query
$stmt -> execute();

//close connection
$_pdo = null;


$taskStatusWord;
if ($taskStatus === "1") {
    $taskStatusWord = "Yes";
} else {
    $taskStatusWord = "No";
}
?>
<!-- display in html -->
 
<main>
    <div class = "container-sm">
        <br>
        <h2>Task Updated</h2>
        <p><?php echo "Task: ".$taskName.", from ".$taskCategory." was added successfully.
        <br>Priority: ".$taskPriority.
        "<br>Due: ".date("M d, Y", strtotime($taskDueDate)).
        "<br>Hours added: ".$taskTime.
        "<br>Complete: ".$taskStatusWord?>
        </p>
        <p>
            <a href="select-task-edit.php" class ="btn btn-secondary">Edit New Task</a>
        </p>
        
    </div>
</main>
<?php require "includes/footer.php"; ?>