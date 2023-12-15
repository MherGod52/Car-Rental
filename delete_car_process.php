<?php
//Delete Cars
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_id = $_POST['car_id'];

    try {
        $sql = "DELETE FROM cars WHERE car_id = :car_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':car_id', $car_id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: admin.php"); 
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
