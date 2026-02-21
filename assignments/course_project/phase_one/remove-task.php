<?php
require "includes/connect.php";
require 'includes/header.php';


//check if post
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request');
}

$selectedTask = trim(filter_input(INPUT_POST,'task_id',FILTER_SANITIZE_SPECIAL_CHARS));

//build query with named placeholder 
$sql = "SELECT * FROM tasks WHERE id = :selected_task";

//prepare the query
$stmt = $pdo->prepare($sql);

//bind param to placeholder
$stmt -> bindParam(':selected_task', $selectedTask);

//execute the query
$stmt -> execute();

//fetch query results
$task = $stmt->fetch();

//close connection
$_pdo = null;

if ($task['task_status'] === 1 ): //saved as SQL boolean 0=false, 1=true 
    $task['task_status'] = "Complete";
else: 
    $task['task_status'] = "Incomplete";
endif;

?>

<main>
    <div class = "container-sm">
        <form action="remove-task-process.php" method="post">
            <fieldset>
                <br>
                <legend>Remove Task</legend>
                <p>ID: <?= htmlspecialchars($task['id']); ?> - Name: <?= htmlspecialchars($task['task_name']); ?></p>
                <p>Category: <?= htmlspecialchars($task['task_category']); ?></p>
                <p>Priority: <?= htmlspecialchars($task['task_category']); ?></p>
                <p>Due Date: <?= htmlspecialchars(date("M d, Y", strtotime($task['task_due_date']))); ?></p>
                <p>Time Spent (h): <?= htmlspecialchars($task['task_category']); ?></p>
                <p>Status: <?= htmlspecialchars($task['task_category']); ?></p>
                <!-- Have to add line breaks because even though main.css (after bootstrap in header.php should outrank reboot.scss, bootstrap won't let me change anything, update: removed main.css -->
                <br>
                <!-- Name  -->
                <p>Is this the correct task?</p>
                <input class="form-check-input" type="checkbox" id="task_id" name="task_id" value="<?= htmlspecialchars($selectedTask); ?>" required />
                <label for="task_id" class="form-label">Yes</label>
                <br>
                <br>
            </fieldset>
            <br>
            <!-- Submit Button  -->
            <p>
                <button class="btn btn-secondary" type="submit" >Remove</button>
            </p>
            <br>
            <br>
            <br>
        </form>
    </div>
</main>

<?php require 'includes/footer.php'; ?>