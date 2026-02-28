<?php
//require database connection script
require "includes/connect.php"; 
require "includes/header.php";

$whereCondition = " WHERE ";

if (empty($_POST)) {
    //build query 
    $sql = "SELECT * FROM tasks ORDER BY task_status, task_due_date, task_priority, task_category";

    //prepare the query
    $stmt = $pdo->prepare($sql);

    //execute the query
    $stmt -> execute();

    //fetch query results
    $tasks = $stmt->fetchALL();

} else {
    $filteredCategory = trim(filter_input(INPUT_POST,'filter_category',FILTER_SANITIZE_SPECIAL_CHARS));
    $filteredStatus = trim(filter_input(INPUT_POST,'filter_status',FILTER_SANITIZE_SPECIAL_CHARS));

    if(!empty($filteredCategory)){
        $whereCondition .= "task_category = '".$filteredCategory."' ";
    } 

    if(!empty($filteredCategory) && ($filteredStatus === "0" || $filteredStatus === "1")){
        $whereCondition .= "and ";
    }

    if($filteredStatus === "0" || $filteredStatus === "1"){
        $whereCondition .= "task_status = '".$filteredStatus."' ";
    }
    //build query 
    $sql = "SELECT * FROM tasks ".$whereCondition." ORDER BY task_status, task_due_date, task_priority, task_category";
    
    //prepare the query
    $stmt = $pdo->prepare($sql);

    
    //echo "[".$sql."]";
    //execute the query
    $stmt -> execute();

    //fetch query results
    $tasks = $stmt->fetchALL();

}






//build query specifically pulling unique task_category values to choose from
$sql = "SELECT DISTINCT task_category FROM tasks";

//prepare the query
$stmt = $pdo->prepare($sql);

//execute the query
$stmt->execute();

//fetch query results as a single array with the unique categories
$categories = $stmt->fetchAll(PDO::FETCH_COLUMN);


//close connection
$_pdo = null;

?>
<!-- display in html -->
 
<main>
    <div class = "container-sm">
        <br>
        <h2>Tasks</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <fieldset>
                <div class = "row">
                    <div class = "col">
                        <legend>Filter by:</legend>
                    </div>
                    <div class = "col">
                        <label>Status
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="filter_status_incomplete" name="filter_status" value="0" />
                                <label class="form-check-label" for="filter_status_incomplete">Incomplete</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="filter_status_complete" name="filter_status" value="1" />
                                <label class="form-check-label" for="filter_status_complete">Complete</label>
                            </div>
                        </label>
                    </div>
                    <div class = "col">
                        <label for="filter_category" class="form-label">Category</label>
                        <select id="filter_category" name="filter_category" class="form-control">
                            <option value="">All</option>
                            <?php foreach ($categories as $category): 
                                // for through all tasks creating a selectable option for each ?>
                                <option value="<?= htmlspecialchars($category); ?>"><?= htmlspecialchars($category); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class = "col align-self-end">
                        <p>
                            <button class="btn btn-secondary" type="submit">Confirm</button>
                        </p>
                    </div>
    
                
                </div>
            </fieldset>

        </form>



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
                            <?php if ($task['task_status'] === 1 ): //saved as SQL boolean 0=false, 1=true ?>
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