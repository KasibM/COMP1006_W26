<?php
//require database connection script
require "includes/connect.php"; 
require "includes/header.php";

//build query with named placeholder 
$sql = "SELECT * FROM tasks ORDER BY task_status, task_due_date, task_priority, task_category";

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

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Priority</th>
                    <th>Due Date</th>
                    <th>Time Spent (h)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars($task['id']);?>
                        </td>
                        <td>
                            <?= htmlspecialchars($task['task_name']);?>
                        </td>
                        <td>
                            <?= htmlspecialchars($task['task_category']);?>
                        </td>
                        <td>
                            <?= htmlspecialchars($task['task_priority']);?>
                        </td>
                        <td>
                            <!-- converts YYYY-MM-DD to Month (short) day, year -->
                            <?= htmlspecialchars(date("M d, Y", strtotime($task['task_due_date'])));?>
                        </td>
                        <td>
                            <?= htmlspecialchars($task['task_time']);?>
                        </td>
                        <td>
                            <?php if ($task['task_status'] === 1 ): ?>
                                Complete
                            <?php else: ?>
                                Incomplete
                            <?php endif;?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        
        
    </div>
</main>
<?php require "includes/footer.php"; ?>