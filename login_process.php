<?php
//Database connection
include 'connection.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Admin Login
    // Checking if the user is an admin
    $sql = "SELECT admin_id, password FROM admins WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        //Verify password
        $row = $stmt->fetch();
        if (password_verify($password, $row['password'])) {
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $row['admin_id'];
            $_SESSION["username"] = $username;
            $_SESSION["is_admin"] = true;

            header("Location: admin.php");
            exit();
        } else {
            //Wrong password
            echo "The password you entered was not valid for an admin account.";
        }
    } else {
        // Check if user exists
        $sql = "SELECT user_id, password FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            if ($row = $stmt->fetch()) {
                $hashed_password = $row['password'];
                if (password_verify($password, $hashed_password)) {
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $row['user_id'];
                    $_SESSION["username"] = $username;
                    $_SESSION["is_admin"] = false;
                    header("Location: index.php");
                    exit();
                } else {
                    //Wrong password
                    echo "The password you entered was not valid.";
                }
            }
        } else {
            //Wrong Username
            echo "No account found with that username.";
        }
    }
}
?>
