<?php 

declare(strict_types=1);

$host = "localhost"; //hostname
$db = "test_connection"; //database name
$user = "root"; //username
$pass = ""; //password, "root" on windows, "" on mac

//points to the database
$dsn = "mysql:host=$host;dbname=$db";

//try to connect, if connected echo a yay!
try {
    $pdo = new PDO($dsn, $user, $pass); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "Connected to the database! Yay!"; 
}
//what happens if there is an error connection
catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}