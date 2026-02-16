<?php
require "includes/header.php";
//  TODO: connect to the database 
require "includes/connect.php";

//   TODO: Grab form data (no validation or sanitization for this lab)
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];


/*
  1. Write an INSERT statement with named placeholders
*/
//sql query with placeholders for adding the data
$sql = "INSERT INTO subscribers (first_name, last_name, email) VALUES (:first_name, :last_name, :email)";
/*
  2. Prepare the statement
*/
$stmt = $pdo->prepare($sql);

//map placeholder values
$stmt->bindparam(":first_name", $firstName);
$stmt->bindparam(":last_name", $lastName);
$stmt->bindparam(":email", $email);
  
/*
  3. Execute the statement with an array of values

*/
$stmt->execute();
//close connection by setting $pdo to null 
$pdo = null;

?>
<? require "includes/header.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <main class="container mt-4">
        <h2>Thank You for Subscribing</h2>

        <!-- TODO: Display a confirmation message -->
        <!-- Example: "Thanks, Name! You have been added to our mailing list." -->
        <p>
            Thanks <?php echo $firstName?>! You have been added to our mailing list. At any point if you wish to unsubscribe, unfortunately that feature is not available yet. We won't hesitate to email you at least 30 times per day for the foreseable future. 
        </p>

        <p class="mt-3">
            <a href="subscribers.php">View Subscribers</a>
        </p>
    </main>
</body>

</html>
<?php require "includes/footer.php"; ?>