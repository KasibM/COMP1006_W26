<?php
declare(strict_types=1);
//1. Code Commenting jb
require "connect.php";
//inline code 

/* 

multi-line code 

*/

//2. Variables, Data Types, Concatenation, Conditional Statements & Echo


$firstName = "Jessica"; //string
$lastName = "Gilfillan"; //string 
$age = 40; //integer
$isInstructor = true; //boolean


echo "<p> Hello there, my name is " . $firstname . " " . $lastName . "</p>";


if ($is_student === true) {
    echo "<p> I am your teacher! </p>";
} else {
    echo "<p> Uh oh, teach didn't show! </p>";
}

//3. PHP is loosely typed 

// $num1 = 7; //integer
// $num2 = "9"; //string

// function add(int $num1,int $num2){
//     return $num1, $num2;
// }

// echo "<p>" . add($num1,$num2) . "</p>"
