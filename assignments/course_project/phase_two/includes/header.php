<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Time Tracker</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

        
    </head>
    <body>
        <header>
            <!-- https://getbootstrap.com/docs/5.3/components/navbar/ -->
            <nav class="navbar bg-body-tertiary">
                <div class="container-fluid  justify-content-start">
                    <span class="navbar-brand mb-0 h1">Time Tracker</span>
                    <!-- Nav Tabs  -->
                    <ul class="nav nav-tabs">
                        <!-- Index/View All Tasks -->
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">View All</a>
                        </li>
                        <!-- Add New Tasks  -->
                        <li class="nav-item">
                            <a class="nav-link active" href="add-task.php">Add</a>
                        </li>
                        <!-- Edit Tasks -->
                        <li class="nav-item">
                            <a class="nav-link active" href="select-task-edit.php">Edit</a>
                        </li>
                        <!-- Remove Tasks -->
                        <li class="nav-item">
                            <a class="nav-link active" href="select-task-remove.php">Remove</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>