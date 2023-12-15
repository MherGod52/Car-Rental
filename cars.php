<?php
//Database Connection
session_start();
include 'connection.php';

try {
    $sql = "SELECT * FROM cars";
    $stmt = $conn->query($sql);

    // Fetch car records
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$sql = "SELECT * FROM cars WHERE 1=1";
$params = [];

$sql = "SELECT * FROM cars WHERE 1=1";
$params = [];

// Filters
if (!empty($_GET['make'])) {
    $makeConditions = [];
    foreach ($_GET['make'] as $index => $make) {
        $makeParam = ":make" . $index;
        $makeConditions[] = "make = " . $makeParam;
        $params[$makeParam] = $make;
    }
    if (!empty($makeConditions)) {
        $sql .= " AND (" . implode(" OR ", $makeConditions) . ")";
    }
}


try {
    $stmt = $conn->prepare($sql);
    foreach ($params as $key => &$val) {
        $stmt->bindParam($key, $val);
    }
    $stmt->execute();
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if (!empty($_GET['year'])) {
    $sql .= " AND year = :year";
    $params[':year'] = $_GET['year'];
}

if (!empty($_GET['color'])) {
    $colorConditions = [];
    foreach ($_GET['color'] as $index => $color) {
        $colorParam = ":color" . $index;
        $colorConditions[] = "color = " . $colorParam;
        $params[$colorParam] = $color;
    }
    if (!empty($colorConditions)) {
        $sql .= " AND (" . implode(" OR ", $colorConditions) . ")";
    }
}

if (!empty($_GET['transmission'])) {
    $sql .= " AND transmission_type = :transmission";
    $params[':transmission'] = $_GET['transmission'];
}


if (!empty($_GET['minPrice'])) {
    $sql .= " AND price_per_day >= :minPrice";
    $params[':minPrice'] = $_GET['minPrice'];
}
if (!empty($_GET['maxPrice'])) {
    $sql .= " AND price_per_day <= :maxPrice";
    $params[':maxPrice'] = $_GET['maxPrice'];
}

try {
    $stmt = $conn->prepare($sql);
    foreach ($params as $key => &$val) {
        $stmt->bindParam($key, $val);
    }
    $stmt->execute();
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
    <title>Cars - Car Sharing Service</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body>
    <!--Navigation Bar  -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="index.php">ECR</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="cars.php">Cars</a></li>
                <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="signup.php">Signup</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

    

    <div class="container mt-4">
        <div class="row">
        <div class="col-md-3">
    <h3>Filters</h3>
    <form id="carFilterForm">
        <br>
         <!-- Make Filter -->
         <h5>Filter by Make</h5>
         <div class="form-check">
    <input class="form-check-input" type="checkbox" value="Toyota" id="makeToyota" name="make[]">
    <label class="form-check-label" for="brandToyota">Toyota</label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="Honda" id="makeHonda" name="make[]">
    <label class="form-check-label" for="makeHonda">Honda</label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="Ford" id="makeFord" name="make[]">
    <label class="form-check-label" for="makeFord">Ford</label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="BMW" id="makeBMW" name="make[]">
    <label class="form-check-label" for="makeBMW">BMW</label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="Audi" id="makeAudi" name="make[]">
    <label class="form-check-label" for="makeAudi">Audi</label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="Mercedes-Benz" id="makeMercedes-Benz" name="make[]">
    <label class="form-check-label" for="makeMercedes-Benz">Mercedes-Benz</label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="Chevrolet" id="makeChevrolet" name="make[]">
    <label class="form-check-label" for="makeChevrolet">Chevrolet</label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="Tesla" id="makeTesla" name="make[]">
    <label class="form-check-label" for="makeTesla">Tesla</label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="Nissan" id="makeNissan" name="make[]">
    <label class="form-check-label" for="makeNissan">Nissan</label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="Subaru" id="makeSubaru" name="make[]">
    <label class="form-check-label" for="makeSubaru">Subaru</label>
</div>
<br>
<!-- Year Filter -->
<h5>Year</h5>
<select class="form-select" name="year">
    <option value="">Select Year</option>
    <option value="2023">2023</option>
    <option value="2022">2022</option>
    <option value="2021">2021</option>
    <option value="2020">2020</option>
    <option value="2019">2019</option>
    <option value="2018">2018</option>
    <option value="2017">2017</option>
    <option value="2016">2016</option>
    <option value="2015">2015</option>
    <option value="2014">2014</option>
    <option value="2013">2013</option>
    <option value="2012">2012</option>
    <option value="2011">2011</option>
</select>

<br>
<br>

<!-- Color Filter -->
<h5>Color</h5>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="Black" id="colorBlack" name="color[]">
    <label class="form-check-label" for="colorBlack">Black</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" value="White" id="colorWhite" name="color[]">
    <label class="form-check-label" for="colorWhite">White</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" value="Red" id="colorRed" name="color[]">
    <label class="form-check-label" for="colorRed">Red</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" value="Blue" id="colorBlue" name="color[]">
    <label class="form-check-label" for="colorBlack">Blue</label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="Grey" id="colorGrey" name="color[]">
    <label class="form-check-label" for="colorGrey">Grey</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" value="Yellow" id="colorYellow" name="color[]">
    <label class="form-check-label" for="colorYellow">Yellow</label>
</div>

<br>

<!-- Price Filter -->
<h5>Price</h5>
<div class="form-group">
    <label for="minPrice">Minimum Price</label>
    <input type="number" class="form-control" name="minPrice" id="minPrice" placeholder="Min Price" min="0" step="5">
</div>
<div class="form-group">
    <label for="maxPrice">Maximum Price</label>
    <input type="number" class="form-control" name="maxPrice" id="maxPrice" placeholder="Max Price" min="0" step="5">
</div>

<br>
<!-- Transmission Type Filter -->
<div class="form-group">
    <h4>Transmission Type</h4>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="transmission" id="transmissionAutomatic" value="Automatic">
        <label class="form-check-label" for="transmissionAutomatic">Automatic</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="transmission" id="transmissionManual" value="Manual">
        <label class="form-check-label" for="transmissionManual">Manual</label>
    </div>
</div>
<button type="button" id="clearFilters" class="btn btn-secondary mt-3">Clear Filters</button>

        <button type="submit" id="filterButton" class="btn btn-primary mt-3">Apply Filters</button>
    </form>
</div>
<br>
            <!-- Search Bar -->
            <div class="col-md-9">
                <form class="form-inline mb-3">
                <div class="input-group flex-nowrap w-100">
                    <input type="text" class="form-control" id="searchBar" placeholder="Search cars..." aria-label="Search cars" aria-describedby="searchButton">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="searchButton">Search</button>
                    </div>
                </div>
            </form>
                
                <div class="cars-grid">
                <?php foreach ($cars as $car): ?>
                    <div class="car-item">
                    <img src="images/<?php echo htmlspecialchars($car['model']) . ' ' . htmlspecialchars($car['color']); ?>.png" alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model'] . ' - ' . $car['color']); ?>" class="car-image">
                        <h5><?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?></h5>
                        <p>Make Year: <?php echo htmlspecialchars($car['year']); ?></p>
                        <p>Transmission: <?php echo htmlspecialchars($car['transmission_type']); ?></p>
                        <p>Colors: <?php echo htmlspecialchars($car['color']); ?></p>
                        <p>Price: $<?php echo htmlspecialchars($car['price_per_day']); ?> per day</p>
                    </div>
                <?php endforeach; ?>
            </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-auto py-3">
    <div class="container text-center">
            <span class="text-muted">© 2023 Car Sharing Service</span>
        </div>
    </footer>

    <script>
    $(document).ready(function() {
    function performSearch() {
        var formData = $("#carFilterForm").serialize();
        var searchQuery = $("#searchBar").val(); // Get the value from the search bar

        $.ajax({
            type: "GET",
            url: "fetch_cars.php",
            data: formData + "&search=" + searchQuery, // Append the search query to the form data
            success: function(data) {
                $(".cars-grid").html(data);
            },
            error: function() {
                alert("Error fetching data.");
            }
        });
    }

    $("#filterButton").click(function(event) {
        event.preventDefault();
        performSearch();
    });

    $("#searchButton").click(function(event) {
        event.preventDefault();
        performSearch();
    });
    });

    </script>


<!-- Clear Filters -->
<script>
    document.getElementById('clearFilters').addEventListener('click', function() {
        document.getElementById('carFilterForm').reset();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    

</body>
</html>