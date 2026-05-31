<?php
session_start();
require_once "dbconnection.php";

// Fetch all cinemas/theaters from the database
$displaysql = "SELECT * FROM theater ORDER BY theater_name ASC";
$result = $conn->query($displaysql);
$theaters = [];

if ($result && $result->num_rows > 0) {
    $theaters = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cinemas | Appdev Movie Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .cinema-card {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 14px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .cinema-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
            border-color: #ffc107;
        }
        .accent-bar {
            width: 40px;
            height: 4px;
            background-color: #ffc107;
            border-radius: 2px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body class="bg-white text-dark d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index1.php">
                Appdev Movie Booking System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active fw-bold text-warning" href="cinemas.php">Cinemas</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="index1.php">Now Showing</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="register.php">Register/Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="bg-secondary text-white py-2 shadow-lg">
        <div class="container d-flex justify-content-between">
            <span id="date"></span>
        </div>
    </div>

    <section class="bg-warning text-center p-3 shadow-lg">
        <div class="container py-3">
            <h1 class="display-5 fw-bold text-dark">Our Cinemas</h1>
            <p class="fw-semibold mt-2 mb-0 text-dark">Experience world-class movie theaters and premium seats.</p>
        </div>
    </section>

    <section class="py-5 bg-white flex-grow-1">
        <div class="container">
            
            <?php if (empty($theaters)): ?>
                <div class="p-5 text-center bg-light border text-muted rounded-4 my-5" style="max-width: 500px; margin: 0 auto;">
                    <span style="font-size: 3rem;">🏢</span>
                    <p class="fs-5 fw-semibold mt-3 mb-0">No cinemas found standardly tracked.</p>
                </div>
            <?php else: ?>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
                    <?php foreach ($theaters as $theater): ?>
                        <div class="col">
                            <div class="card h-100 cinema-card shadow-sm p-4">
                                <div class="card-body p-0 d-flex flex-column">
                                    
                                    <div class="accent-bar"></div>
                                    
                                    <h4 class="card-title fw-bold text-dark mb-2 text-uppercase">
                                        <?= htmlspecialchars($theater['theater_name']) ?>
                                    </h4>
                                    
                                    <div class="mt-2 text-muted small flex-grow-1">
                                        <div class="d-flex justify-content-between border-bottom py-2">
                                            <span>Location:</span>
                                            <span class="fw-bold text-dark"><?= htmlspecialchars($theater['location'] ?? 'Not Specified') ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between py-2">
                                            <span>Theater ID Tag:</span>
                                            <span class="badge bg-dark text-warning">#<?= $theater['theater_id'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">© Finals Movie Booking System</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("date").textContent = new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
    </script>
</body>
</html>