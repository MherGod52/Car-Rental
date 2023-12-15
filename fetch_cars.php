<?php
//Database connection
include 'connection.php'; 

$sql = "SELECT * FROM cars WHERE 1=1";
$params = [];

if (!empty($_GET['search'])) {
    $sql .= " AND (model LIKE :search OR make LIKE :search)";
    $params[':search'] = '%' . $_GET['search'] . '%';
}

// Filter by Make
if (!empty($_GET['make']) && is_array($_GET['make'])) {
    $makeConditions = [];
    foreach ($_GET['make'] as $index => $make) {
        $param = ":make" . $index;
        $makeConditions[] = "make = $param";
        $params[$param] = $make;
    }
    $sql .= " AND (" . implode(" OR ", $makeConditions) . ")";
}

// Filter by Year
if (!empty($_GET['year'])) {
    $sql .= " AND year = :year";
    $params[':year'] = $_GET['year'];
}

// Filter by Color
if (!empty($_GET['color']) && is_array($_GET['color'])) {
    $colorConditions = [];
    foreach ($_GET['color'] as $index => $color) {
        $param = ":color" . $index;
        $colorConditions[] = "color = $param";
        $params[$param] = $color;
    }
    $sql .= " AND (" . implode(" OR ", $colorConditions) . ")";
}

// Filter by Min and Max Price
if (!empty($_GET['minPrice'])) {
    $sql .= " AND price_per_day >= :minPrice";
    $params[':minPrice'] = $_GET['minPrice'];
}
if (!empty($_GET['maxPrice'])) {
    $sql .= " AND price_per_day <= :maxPrice";
    $params[':maxPrice'] = $_GET['maxPrice'];
}

// Filter by Transmission Type
if (!empty($_GET['transmission'])) {
    $sql .= " AND transmission_type = :transmission";
    $params[':transmission'] = $_GET['transmission'];
}

$stmt = $conn->prepare($sql);
foreach ($params as $key => &$val) {
    $stmt->bindParam($key, $val);
}
$stmt->execute();

// Check if any cars are found
if ($stmt->rowCount() > 0) {
    while ($car = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $imageFilename = htmlspecialchars($car['model']) . ' ' . htmlspecialchars($car['color']) . ".png";
        echo "<div class='car-item'>";
        echo "<img src='images/" . $imageFilename . "' alt='" . htmlspecialchars($car['make'] . ' ' . $car['model'] . ' - ' . $car['color']) . "' class='car-image'>";
        echo "<h5>" . htmlspecialchars($car['make'] . ' ' . $car['model']) . "</h5>";
        echo "<p>Make Year: " . htmlspecialchars($car['year']) . "</p>";
        echo "<p>Transmission: " . htmlspecialchars($car['transmission_type']) . "</p>";
        echo "<p>Colors: " . htmlspecialchars($car['color']) . "</p>";
        echo "<p>Price: $" . htmlspecialchars($car['price_per_day']) . " per day</p>";
        echo "</div>";
    }
} else {
    // If no cars are found
    echo "<div class='alert alert-warning'>No cars found based on your search and filter criteria.</div>";

}
?>
