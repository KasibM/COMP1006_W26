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
        <form action="edit-task-process.php" method="post">
            <fieldset>
                <br>
                <legend>Edit Task</legend>
                <p>ID: <?= htmlspecialchars($task['id']); ?> - Name: <?= htmlspecialchars($task['task_name']); ?></p>
                <!-- Have to add line breaks because even though main.css (after bootstrap in header.php should outrank reboot.scss, bootstrap won't let me change anything, update: removed main.css -->
                <br>
                <!-- Name  -->
                <p>Is this the correct task?</p>
                <input class="form-check-input" type="checkbox" id="task_id" name="task_id" value="<?= htmlspecialchars($selectedTask); ?>" required />
                <label for="task_id" class="form-label">Yes</label>
                <br>
                <br>
                <!-- Name  -->
                <label for="task_name" class="form-label">Task Name</label>
                <input type="text" id="task_name" name="task_name" class="form-control" placeholder="<?= htmlspecialchars($task['task_name']); ?>"/>
                <br>
                <!-- Category  -->
                <label for="task_category" class="form-label">Category</label>
                <input type="text" id="task_category" name="task_category" class="form-control" placeholder="<?= htmlspecialchars($task['task_category']); ?>"/>
                <br>
                <!-- Priority  -->
                <label for="task_priority" class="form-label">Priority</label>
                <select id="task_priority" name="task_priority" class="form-control" >
                    <option value=""><?= htmlspecialchars($task['task_priority']); ?></option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
                <br>
                <!-- Due Date  -->
                <label for="task_due_date" class="form-label">Due Date - Currently: <?= htmlspecialchars(date("M d, Y", strtotime($task['task_due_date']))); ?></label>
                <input type="date" id="task_due_date" name="task_due_date" class="form-control" />
                <br>
                <!-- Task Time  -->
                <label for="task_time" class="form-label">Time in Hours Spent</label>
                <input type="number" id="task_time" name="task_time" step="0.5" min="0.0" max="12.0" class="form-control" placeholder="<?= htmlspecialchars($task['task_time']); ?>"/>
            </fieldset>
            <br>
            <fieldset>
                <!-- Task Status  -->
                <legend>Task Status</legend>
                <p>Currently: <?= htmlspecialchars($task['task_status']); ?></p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="task_status_incomplete" name="task_status" value="0" />
                    <label class="form-check-label" for="task_status_incomplete">Incomplete</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="task_status_complete" name="task_status" value="1" />
                    <label class="form-check-label" for="task_status_complete">Complete</label>
                </div>
            </fieldset>
            <br>
            <!-- Submit Button  -->
            <p>
                <button class="btn btn-secondary" type="submit" >Save Changes</button>
                
            </p>
            <br>
            <br>
            <br>
        </form>
    </div>
</main>

<?php require 'includes/footer.php'; ?>