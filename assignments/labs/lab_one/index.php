<?php 
require "header.php"; 
echo "<p> Follow the instructions outlined in instructions.txt to complete this lab. Good luck & have fun!😀 </p>";
require "footer.php"; 
require "car.php"; //ensures car.php is available for index.php to function
require "connect.php"; //for connecting to the database
/*
I found most of the programming parts of this lab easy, because they were very similar to the examples. 
I found what took the most time was finding the places in the config files where I needed to add the 
new port number because I changed which port my XAMPP and MySQL use.
*/
$car1 = new Car("Nissan", "Pathfinder", 2011); //new instance of a car object
echo $car1->describe(); //echo car information

?>