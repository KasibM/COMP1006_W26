<?php require "includes/header.php" ?> 
<main>
    <h2> Contact us 🧁</h2>
<!-- Send to contact_process.php using post-->
    <form action="contact_process.php" method="post">

        <!-- Customer Information -->
        <fieldset>
        <legend>Customer Information</legend>
        <!-- first name input -->
            <label for="first_name">First name</label>
            <input type="text" id="first_name" name="first_name" required>
        <!-- last name input  -->
            <label for="last_name">Last name</label>
            <input type="text" id="last_name" name="last_name" required>
        <!-- email address input  -->
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>
        <!-- message input  -->
            <p>
                <label for="message">Message</label><br>
            <!-- maxlength 70 because php mail function maxlength = 70 char      -->
                <textarea id="message" name="message" rows="4"
                placeholder="Let us know" maxlength="70" required></textarea>
            </p>

        </fieldset>
        
        <!-- submission button  -->
        <p>
            <button type="submit">Submit</button>
        </p>
    </form>

</main>
<?php require "includes/footer.php" ?>