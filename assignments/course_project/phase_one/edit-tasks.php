<?php






?>

<?php
require "includes/connect.php";
require 'includes/header.php';

//build query specifically pulling unique task_category values to choose from
$sql = "SELECT DISTINCT task_category FROM tasks";

//prepare the query
$stmt = $pdo->prepare($sql);

//execute the query
$stmt->execute();

//fetch query results as a single array with the unique categories
$categories = $stmt->fetchAll(PDO::FETCH_COLUMN);


?>
<main>
    <div class="container-sm">

        <?php if (!empty($_POST)): //if category has been chosen
            //build query selecting only tasks within the chosen category, .implode() turns the array of category names (only one name in this case) into a string
            $sql = "SELECT task_name FROM tasks WHERE task_category = \":selected_category\"";

            $selectedCategory = implode($_POST);

            $stmt -> bindParam(':selected_category', $selectedCategory);

            //prepare the query
            $stmt = $pdo->prepare($sql);

            //execute the query
            $stmt->execute();

            //fetch task names of tasks in the selected category
            $tasks = $stmt->fetchAll(PDO::FETCH_COLUMN);    
        ?>
            <form action="" method="post"> 
                <fieldset>
                    <br>
                    <legend>Edit Task</legend>
                    <!-- Have to add line breaks because even though main.css (after bootstrap in header.php should outrank reboot.scss, bootstrap won't let me change anything-->
                    <br>
                    <br>
                    <!-- Find Task  -->
                    <p>Category: <?= implode($_POST) ?></p>
                    <label for="task_category" class="form-label">Choose Task to Edit</label>
                    <select id="task_category" name="task_category" class="form-control" required>
                        <option value="">Select</option>
                        <?php foreach ($tasks as $task): 
                            // for through all tasks creating a selectable option for each ?>
                            <option value="<?= $task ?>"><?= $task; ?></option>
                        <?php endforeach; ?>

                    </select>

                    <br>
                    <!-- Submit Button  https://getbootstrap.com/docs/4.0/components/button-group/-->
                    <div class="btn-group" role="group">
                        <!-- reset $_post by re-entering the page  -->
                        <a class ="btn btn-secondary" href="edit-tasks.php">Reset</a>
                        <button type="submit" id="task-selected" class="btn btn-secondary">Confirm</button>
                        </div>
                </fieldset>
            </form>

        <?php else: 
            //echo back to the same page to run through second form with a selected category ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <fieldset>
                    <br>
                    <legend>Edit Task</legend>
                    <!-- Have to add line breaks because even though main.css (after bootstrap in header.php should outrank reboot.scss, bootstrap won't let me change anything, update: removed main.css -->
                    <br>
                    <br>
                    <!-- Find Task  -->
                    <label for="task_category" class="form-label">Select Category</label>
                    <select id="task_category" name="task_category" class="form-control" required>
                        <option value="">Select</option>
                        <?php foreach ($categories as $category): 
                            // for through all tasks creating a selectable option for each ?>
                            <option value="<?= $category ?>"><?= $category; ?></option>
                        <?php endforeach; ?>

                    </select>

                    <br>
                    <!-- Submit Button  -->
                    <p>
                        <button class="btn btn-secondary" type="submit">Confirm</button>
                    </p>
                </fieldset>
            </form>
    </div>

<?php endif; ?>

</main>
<?php require 'includes/footer.php'; ?>