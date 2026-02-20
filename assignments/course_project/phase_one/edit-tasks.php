<?php






?>

<?php
require "includes/connect.php";
require 'includes/header.php';

//build query with named placeholder 
$sql = "SELECT DISTINCT task_category FROM tasks ORDER BY task_status, task_due_date, task_priority, task_category";

//prepare the query
$stmt = $pdo->prepare($sql);

//execute the query
$stmt -> execute();

//fetch query results
$categories = $stmt->fetchAll(PDO::FETCH_COLUMN);


?>

<main>
    <div class = "container-sm">
        <form action="add-task-process.php" method="post">
            <fieldset>
                <br>
                <legend>Edit Task</legend>
                <!-- Have to add line breaks because even though main.css (after bootstrap in header.php should outrank reboot.scss, bootstrap won't let me change anything-->
                <br>
                <br>
                <!-- Find Task  -->
                <label for="task_category" class="form-label">Category</label>
                <select id="task_category" name="task_category" class="form-control" required>
                    <option value="">Select</option>
                    <?php foreach ($categories as $category): ?>
                        <option value ="<?=$category ?>"><?= $category; ?></option>
                <?php endforeach; ?>
                    
                </select>
                
                <br>
                <!-- Submit Button  -->
                <p>
                    <button type="submit">Confirm</button>
                </p>
            </fieldset>
            <fieldset>
                
            </fieldset>
            <br>
            
            <br>
            <br>
            <br>
        </form>
    </div>
</main>

<?php require 'includes/footer.php'; ?>