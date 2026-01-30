<?php
require "includes/header.php";
?>

<main>
    <?php 

    $firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $lastName = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $phone = $_POST["phone"];
    $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_EMAIL);
    $items = $_POST["items"] ?? []; //empty array if no value available



    $errors = [];
    //require first name
    if ($firstName === null || $firstName === ''){
        $errors[] = "First Name is Required.";
    }

    //require last name
    if ($lastName === null || $firstName === ''){
        $errors[] = "First Name is Required.";
    }

    //require and validate email
    if ($email === null || $email === ""){
        $errors[] = "Email is Required.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors[] = "Email must be a valid email";
    }

    //require address
    if ($address === null || $address === ""){
        $errors[] = "Address is Required.";
    }

    //check that the order quantity is a number
    foreach($items as $item => $quantity){
        if(filter_var($quantity, FILTER_VALIDATE_INT) !== false && $quantity > 0){
            $itemsOrdered[$item] = $quantity;
        }
    }
    if(!empty($errors)){
        foreach($errors as $error):
            echo "<li>".$error."</li>";
        endforeach;
        //end program, stop code after from running
        exit;
    }
    

    echo "<p>Thanks for placing your order " . $firstName . ".</p>"; 
        

    ?>

</main>


<?php require "includes/header.php"; ?>