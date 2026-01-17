<?php 
declare(strict_types=1); //variable types must be declared

$host = "localhost:50000"; //hostname
$db = "test_connection"; //name of database
$user = "root"; //username
$pass = ""; //password

//points to the database
$dsn = "mysql:host=$host;dbname=$db"; 
//try to connect
try{
    $pdo = new PDO($dsn, $user, $pass); //new php data object 
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //attempt connect
    echo "Connected to " . $db . "<br /><br />"; //confirm connection
}
//error catch
catch(PDOException $e){ //if setAttribute returns FALSE
    die("Failed to connect to $db " . $e->getMessage()); //confirm failed connected, get exception message
}


?>