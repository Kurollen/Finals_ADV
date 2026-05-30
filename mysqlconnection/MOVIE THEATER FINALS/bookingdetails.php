<?php
require_once "dbconnection.php";

$movie_id = intval($_GET['movie_id'] ?? 0);

$result = $conn->query("SELECT * FROM movie WHERE movie_id = $movie_id");
$movie = $result->fetch_assoc();

if (!$movie) {
    header("Location: index1.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($movie['title']) ?> | Appdev Movie Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index1.php">
                <img src="https://upload.wikimedia.org/wikipedia/en/0/0c/University_of_Santo_Tomas_seal.svg" alt="logo" width="45" class="me-2">
                Appdev Movie Booking System
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="cinemas.php">Cinemas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="booknow.php">Book Now</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="nowshowing.php">Now Showing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="register.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Date bar -->
    <div class="bg-secondary text-white py-2 shadow-lg">
        <div class="container">
            <span id="date"></span>
        </div>
    </div>

    <script>
        function updateDate() {
            const today = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById("date").innerHTML = today.toLocaleDateString('en-US', options);
        }
        updateDate();
    </script>

    <!-- Page header -->
    <section class="bg-warning text-center p-3 shadow-lg">
        <div class="container py-4">
            <h1 class="display-4 fw-bold">
                Welcome to the best Movie Booking System ever
            </h1>
            <p class="fw-semibold mt-3">
                Appdev Finals
            </p>
        </div>
    </section>

    <!-- Booking Details -->
    <section class="py-3 bg-white">
        <div class="container">

            <h2 class="fw-bold mb-2">Booking Details</h2>
            <hr>
            <div class="row g-3 justify-content-left">

                <div class="col-md-3 mx-4">
                    <div class="card h-100 shadow">
                        <?php if (!empty($movie['movie_poster'])): ?>
                            <img class="rounded" src="<?= htmlspecialchars($movie['movie_poster']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
                        <?php else: ?>
                            <div class="poster-placeholder">🎬</div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col">
                    <h1 class="mb-4"><?= htmlspecialchars($movie['title']) ?></h1>
                    <h4 class="mb-3">Genre: <?= htmlspecialchars($movie['genre']) ?></h4>
                    <h5 class="mb-3">Duration: <?= htmlspecialchars($movie['duration']) ?> min</h5>
                    <h5 class="mb-3">Release Date: <?= htmlspecialchars($movie['release_date']) ?></h5>
                    <p><?= htmlspecialchars($movie['description']) ?></p>
                </div>

                <div class="col">
                    <label class="fw-bold mb-2">Showing Date</label>
                    <input type="date" class="form-control">
                </div>

            </div>

        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">© Finals Movie Booking System</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>