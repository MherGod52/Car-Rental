<?php
//Database connection
session_start();
include 'connection.php';

//POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_car'])) {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $color = $_POST['color'];
    $price_per_day = $_POST['price_per_day'];
    $transmission_type = $_POST['transmission_type'];

    try {
        $sql = "INSERT INTO cars (make, model, year, color, price_per_day, transmission_type) VALUES (:make, :model, :year, :color, :price_per_day, :transmission_type)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':make', $make);
        $stmt->bindParam(':model', $model);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':price_per_day', $price_per_day);
        $stmt->bindParam(':transmission_type', $transmission_type);
        $stmt->execute();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Fetch car records
try {
    $sql = "SELECT * FROM cars";
    $stmt = $conn->query($sql);
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
               
            
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </div>
    </nav>


<div class="container mt-4">
        <h2>Add Car</h2>
        <!-- Add Car Form -->
        <form action="admin.php" method="post" class="form-inline">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <input type="text" class="form-control mb-2" id="make" name="make" placeholder="Make" required>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control mb-2" id="model" name="model" placeholder="Model" required>
                </div>
                <div class="col-auto">
                    <input type="number" class="form-control mb-2" id="year" name="year" placeholder="Year" required>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control mb-2" id="color" name="color" placeholder="Color" required>
                </div>
                <div class="col-auto">
                    <input type="number" class="form-control mb-2" id="price_per_day" name="price_per_day" placeholder="Price Per Day" required>
                </div>
                <div class="col-auto">
                    <select class="form-control mb-2" id="transmission_type" name="transmission_type" required>
                        <option value="Automatic">Automatic</option>
                        <option value="Manual">Manual</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-2" name="add_car">Add Car</button>
                </div>
            </div>
        </form>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Color</th>
                    <th>Price Per Day</th>
                    <th>Transmission Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
<tbody>
    <!-- Data -->
    <?php foreach ($cars as $car): ?>
        <tr>
            <td><?php echo htmlspecialchars($car['make']); ?></td>
            <td><?php echo htmlspecialchars($car['model']); ?></td>
            <td><?php echo htmlspecialchars($car['year']); ?></td>
            <td><?php echo htmlspecialchars($car['color']); ?></td>
            <td><?php echo htmlspecialchars($car['price_per_day']); ?></td>
            <td><?php echo htmlspecialchars($car['transmission_type']); ?></td>
            <td>
                <!-- Edit and Delete Buttons -->
                <div class="btn-group" role="group" aria-label="Car Actions">
                    <a href='edit_car.php?car_id=<?php echo $car["car_id"]; ?>' class='btn btn-primary'>Edit</a>
                    <form action="delete_car_process.php" method="post" style="display: inline-block;">
                        <input type="hidden" name="car_id" value="<?php echo $car['car_id']; ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
        </table>
    </div>
    
<!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
