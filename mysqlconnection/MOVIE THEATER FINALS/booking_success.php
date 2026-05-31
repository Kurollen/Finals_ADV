<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Confirmed | Appdev Movie Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark text-white d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index1.php">
                <img src="" alt="logo" width="45" class="me-2">
                Appdev Movie Booking System
            </a>
        </div>
    </nav>

    <div class="flex-grow-1 d-flex align-items-center justify-content-center py-5">
        <div class="text-center" style="max-width: 460px;">

            <div class="mb-4" style="font-size: 4rem;">🎬</div>

            <h1 class="fw-bold text-warning mb-3">Booking Confirmed!</h1>
            <p class="text-secondary mb-4">
                Your seats have been successfully reserved. Enjoy the movie!
            </p>

            <div class="bg-secondary bg-opacity-25 border border-secondary rounded-3 p-4 mb-4 text-start">
                <p class="mb-1 small text-secondary text-uppercase fw-bold">What's next?</p>
                <ul class="mb-0 ps-3 text-light small">
                    <li class="mb-1">Show your booking confirmation at the cinema entrance</li>
                    <li class="mb-1">Arrive at least 15 minutes before the show</li>
                    <li>Enjoy your movie experience!</li>
                </ul>
            </div>

            <a href="index1.php" class="btn btn-warning fw-bold px-5 py-2 shadow">
                Back to Home
            </a>

        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 border-top border-secondary">
        <p class="mb-0">© Finals Movie Booking System</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>