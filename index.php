<?php
session_start();
require_once 'C:\Users\admin\vendor\autoload.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_sharing";

// Twig Setup
$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');
$twig = new \Twig\Environment($loader);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Render the template
echo $twig->render('index.twig', [
    'session' => $_SESSION,
    
]);
?>


