<?php






?>

<?php
require 'includes/header.php';
?>

<main>
    <div class = "container-sm">
        <form action="add-task-process.php" method="post">
            <fieldset>
                <br>
                <legend>Add Task</legend>
                <!-- Have to add line breaks because even though main.css (after bootstrap in header.php should outrank reboot.scss, bootstrap won't let me change anything, update: removed main.css -->
                <br>
                <br>
                <!-- Name  -->
                <label for="task_name" class="form-label">Task Name</label>
                <input type="text" id="task_name" name="task_name" class="form-control" required />
                <br>
                <!-- Category  -->
                <label for="task_category" class="form-label">Category</label>
                <input type="text" id="task_category" name="task_category" class="form-control" required />
                <br>
                <!-- Priority  -->
                <label for="task_priority" class="form-label">Priority</label>
                <select id="task_priority" name="task_priority" class="form-control" required>
                    <option value="">Select</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
                <br>
                <!-- Due Date  -->
                <label for="task_due_date" class="form-label">Due Date</label>
                <input type="date" id="task_due_date" name="task_due_date" class="form-control" required />
                <br>
                <!-- Task Time  -->
                <label for="task_time" class="form-label">Time in Hours Spent</label>
                <input type="number" id="task_time" name="task_time" step="0.5" min="0.0" max="12.0" placeholder="Hour(s)" class="form-control" />
            </fieldset>
            <br>
            <fieldset>
                <!-- Task Status  -->
                <legend>Task Status</legend>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="task_status_incomplete" name="task_status" value="0" required />
                    <label class="form-check-label" for="task_status_incomplete">Incomplete</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="task_status_complete" name="task_status" value="1" required />
                    <label class="form-check-label" for="task_status_complete">Complete</label>
                </div>
            </fieldset>
            <br>
            <!-- Submit Button  -->
            <p>
                <button type="submit">Add Task</button>
                
            </p>
            <br>
            <br>
            <br>
        </form>
    </div>
</main>

<?php require 'includes/footer.php'; ?>