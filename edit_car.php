<?php
include 'connection.php';

if(isset($_GET['car_id'])) {
    $carId = $_GET['car_id'];

    // Fetch car records
    $stmt = $conn->prepare("SELECT * FROM cars WHERE car_id = :car_id");
    $stmt->execute(['car_id' => $carId]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$car) {
        echo "Car not found!";
        exit;
    }
} else {
    header("Location: admin.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $color = $_POST['color'];
    $price_per_day = $_POST['price_per_day'];
    $transmission_type = $_POST['transmission_type'];

    // Update the car in the database
    $stmt = $conn->prepare("UPDATE cars SET make = :make, model = :model, year = :year, color = :color, price_per_day = :price_per_day, transmission_type = :transmission_type WHERE car_id = :car_id");
    $stmt->execute([
        'make' => $make,
        'model' => $model,
        'year' => $year,
        'color' => $color,
        'price_per_day' => $price_per_day,
        'transmission_type' => $transmission_type,
        'car_id' => $carId
    ]);

    header("Location: admin.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Car</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <!-- Car Edit Form  -->
    <div class="container">
        <h2 class="mt-5">Edit Car</h2>
        <form action="edit_car.php?car_id=<?php echo $carId; ?>" method="post" class="mt-3">
            <div class="form-group">
                <label for="make">Make:</label>
                <input type="text" class="form-control" name="make" id="make" value="<?php echo htmlspecialchars($car['make']); ?>" required>
            </div>
            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" class="form-control" name="model" id="model" value="<?php echo htmlspecialchars($car['model']); ?>" required>
            </div>
            <div class="form-group">
                <label for="year">Year:</label>
                <input type="number" class="form-control" name="year" id="year" value="<?php echo htmlspecialchars($car['year']); ?>" required>
            </div>
            <div class="form-group">
                <label for="color">Color:</label>
                <input type="text" class="form-control" name="color" id="color" value="<?php echo htmlspecialchars($car['color']); ?>" required>
            </div>
            <div class="form-group">
                <label for="price_per_day">Price Per Day:</label>
                <input type="number" class="form-control" name="price_per_day" id="price_per_day" value="<?php echo htmlspecialchars($car['price_per_day']); ?>" required>
            </div>
            <div class="form-group">
    <label for="transmission_type">Transmission Type:</label>
    <select class="form-control" name="transmission_type" id="transmission_type" required>
        <option value="Automatic" <?php echo ($car['transmission_type'] == 'Automatic') ? 'selected' : ''; ?>>Automatic</option>
        <option value="Manual" <?php echo ($car['transmission_type'] == 'Manual') ? 'selected' : ''; ?>>Manual</option>
    </select>
</div>
            <button type="submit" class="btn btn-primary">Update Car</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

