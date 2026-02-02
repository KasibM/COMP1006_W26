<?php require "includes/header.php" ?>

<?php 
$firstName = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_SPECIAL_CHARS); // filter special chars to remove unsafe inputs
$lastName = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS);// filter special chars to remove unsafe inputs
$emailAddress = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);//validate email format
$message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);// filter special chars to remove unsafe inputs
?>
<main>
    <?php
    mail( //mail message to bakery
        "info@bakery.com", //to
        "Contact Form Submission: ".$firstName." ".$lastName, //subject
        $message, //message
    );
    echo "<p> Message sent, thank you " . $firstName . ". </p>"; //confirmation


    ?>
</main>
<?php require "includes/footer.php" ?>