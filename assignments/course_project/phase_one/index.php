<?php 






?>

<?php 
require 'includes/header.php';
?>

<main>
    <h1>Time Tracker</h1>
    <form action="add-task-process.php">
        <fieldset>
            <legend>Add Task</legend>

            <label for="task_name">Task Name</label>
            <input type="text" id="task_name" name="task_name" require/>

            <label for="task_category">Category</label>
            <input type="text" id="task_category" name="task_category" require/>

            <label for="task_priority">Priority</label>
            <select id="task_priority" name="task_priority" require>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>
            
            <label for="task_due_date">Due Date</label>
            <input type="date" id="task_due_date" name="task_due_date" require/>

            <label for="task_time">Time in Hours Spent</label>
            <input type="number" id="task_time" name="task_time" step="0.5" min="0.0" max="12.0" placeholder="Hour(s)"/>
            
            <!-- <label for="task_status">Completed</label> -->
            <label for="task_status">Task Status</label>
            <div class="form-check form-check">
                <input class="form-check-input" type="radio" role="switch" id="task_status_incomplete" name="task_status" value="0" require/>
                <label class="form-check-label" for="task_status_default">Incomplete</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" role="switch" id="task_status_complete" name="task_status" value="1" require/>
                <label class="form-check-label" for="task_status_checked">Complete</label>
            </div>
        </fieldset>
        <p>
        <button type="submit">Add Task</button>
        </p>
    </form>
</main>

<?php require 'includes/footer.php'; ?>




