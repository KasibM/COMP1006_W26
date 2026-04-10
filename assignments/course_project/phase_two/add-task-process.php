<?php
//require database connection script
require "includes/connect.php"; 
require "includes/auth.php";
require "includes/header.php";


//check if post
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request');
}

//get + sanitise values
$taskName      = trim(filter_input(INPUT_POST,'task_name',FILTER_SANITIZE_SPECIAL_CHARS));
$taskCategory  = trim(filter_input(INPUT_POST,'task_category',FILTER_SANITIZE_SPECIAL_CHARS));
$taskPriority  = trim(filter_input(INPUT_POST,'task_priority',FILTER_SANITIZE_SPECIAL_CHARS));
$taskDueDate  = trim(filter_input(INPUT_POST,'task_due_date',FILTER_SANITIZE_SPECIAL_CHARS));
$taskTime      = trim(filter_input(INPUT_POST,'task_time',FILTER_SANITIZE_SPECIAL_CHARS));
$taskStatus    = trim(filter_input(INPUT_POST,'task_status',FILTER_SANITIZE_SPECIAL_CHARS));

//validation

$errors = [];

if($taskName === null || $taskName === ''){
    $errors[]= "task_name is required.";
}

if($taskCategory === null || $taskCategory === ''){
    $errors[]= "task_category is required";
}

if($taskPriority !== "Low" && $taskPriority !== "Medium" && $taskPriority !== "High"){
    $errors[]= "task_priority must be 'Low', 'Medium', or 'High";
}

if($taskDueDate === null || $taskDueDate === ''){
    $errors[]= "task_due_date is required.";
} else if(!filter_var($taskDueDate, FILTER_VALIDATE_REGEXP, ['options'=> ['regexp' => '/^\d{4}-\d{2}-\d{2}$/']] )){
    $errors[]= "task_due_date is not in required format expected: 'YYYY-MM-DD', received: '".$taskDueDate."'.";
} 

if($taskTime === null || $taskTime ===''){
    $taskTime= 0;
} else if(!filter_var($taskTime, FILTER_VALIDATE_FLOAT)){
    $errors[]= "task_time must be a float.";
}

if(!($taskStatus === '0' || $taskStatus === '1')){
    $errors[]= "task_status must be 0 or 1.";
}


//From Lesson 10
//check whether a file was uploaded
if (isset($_FILES['task_instructions']) && $_FILES['task_instructions']['error'] !== UPLOAD_ERR_NO_FILE) {
    //make sure upload completed successfully 
    if ($_FILES['task_instructions']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "There was a problem uploading your file!";
    } else {
        //only allow a few file types 
        $allowedTypes = ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        //detect the real MIME type of the file 
        $detectedType = mime_content_type($_FILES['task_instructions']['tmp_name']);
        if (!in_array($detectedType, $allowedTypes, true)) {
            $errors[] = "Only PDF or docx allowed";
        } else {
            //build the file name and move it to where we want it to go (uploads)
            //get the file extension 
            $extension = pathinfo($_FILES['task_instructions']['name'], PATHINFO_EXTENSION);
            //create a unique filename so uploaded files don't overwrite 
            $safeFilename = uniqid('product_', true) . '.' . strtolower($extension);
            //build the full server path where the file will be stored 
            $destination = __DIR__ . '/uploads/' . $safeFilename;
            if (move_uploaded_file($_FILES['task_instructions']['tmp_name'], $destination)) {
                //save the relative path to the database
                $filePath = 'uploads/' . $safeFilename; 
            } else {
                $errors[] = "Document uploaded failed!"; 
            }
        }
    }
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

//build query with named placeholder 
$sql = "INSERT INTO tasks (task_name, task_category, task_priority, task_due_date, task_time, task_status, user, task_instructions) 
        VALUES (:task_name, :task_category, :task_priority, :task_due_date, :task_time, :task_status, :username, :file_path)";

//prepare the query
$stmt = $pdo->prepare($sql);

//map named placeholder to data
//e.g. $stmt -> bindParam(":first_name", firstName);

$stmt -> bindParam(':task_name', $taskName);
$stmt -> bindParam(':task_category', $taskCategory);
$stmt -> bindParam(':task_priority', $taskPriority);
$stmt -> bindParam(':task_due_date', $taskDueDate);
$stmt -> bindParam(':task_time', $taskTime);
$stmt -> bindParam(':task_status', $taskStatus);
$stmt -> bindParam(':username', $_SESSION["username"]);
$stmt -> bindParam(':file_path', $filePath);

//execute the query
$stmt -> execute();
 
//close connection
$_pdo = null;


//translate $taskStatus variable for display
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
        <h2>Task Added</h2>
        <p><?php echo "Task: ".$taskName.", from ".$taskCategory." was added successfully.
        <br>Priority: ".$taskPriority.
        "<br>Due: ".$taskDueDate.
        "<br>Hours added: ".$taskTime.
        "<br>Complete: ".$taskStatusWord?>
        </p>
        <p>
            <a class="btn btn-secondary" href="add-task.php" >New Task</a>
        </p>
        
    </div>
</main>
<?php require "includes/footer.php"; ?>