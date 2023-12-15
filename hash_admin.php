<?php
//Database connection
include 'connection.php';

//New password
$newPassword = "Administrator_123"; 

// Hashing the new password
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

try {
    $sql = "UPDATE admins SET password = :password WHERE username = :username";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':username', $username);

    // Username of the admin account
    $username = "administrator123";

    $stmt->execute();

    echo "Password updated successfully.";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
