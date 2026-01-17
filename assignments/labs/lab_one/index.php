<?php 
require "header.php"; 
echo "<p> Follow the instructions outlined in instructions.txt to complete this lab. Good luck & have fun!😀 </p>";
require "footer.php"; 
require "car.php"; //ensures car.php is available for index.php to function

$car1 = new Car("Nissan", "Pathfinder", 2011); //new instance of a car object
echo $car1->describe(); //echo car information

?>