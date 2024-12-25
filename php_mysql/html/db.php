<?php
$host = 'localhost'; // Hostname
$db = 'restaurant_db'; // Database name
$user = 'your_username'; // Your MySQL username
$pass = 'your_password'; // Your MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $db :" . $e->getMessage());
}
?>