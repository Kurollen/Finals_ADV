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
    <style>
        .custom-notice-card {
            background: #212529 !important;
            border: 1px solid #343a40 !important;
            border-radius: 12px !important;
        }
        .yellow-accent-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #ffffff;
            font-weight: 800;
            margin-bottom: 0.75rem;
            border-bottom: 2px solid #ffc107;
            padding-bottom: 4px;
            width: fit-content;
        }
    </style>
</head>
<body class="bg-white text-dark d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index1.php">
                Appdev Movie Booking System
            </a>
        </div>
    </nav>

    <div class="bg-secondary text-white py-2 shadow-lg">
        <div class="container d-flex justify-content-between">
            <span id="date"></span>
        </div>
    </div>

    <div class="flex-grow-1 d-flex align-items-center justify-content-center py-5 bg-white">
        <div class="text-center px-3" style="max-width: 480px;">

            <div class="mb-4" style="font-size: 4.5rem;">🎉</div>

            <h1 class="fw-bold text-dark display-6 mb-2">Booking Confirmed!</h1>
            <p class="text-muted mb-4 fw-semibold">
                Your seats have been successfully reserved and tracked. Enjoy the movie experience!
            </p>

            <div class="custom-notice-card shadow p-4 mb-4 text-start rounded-4 text-white">
                <p class="yellow-accent-title">What's next?</p>
                <ul class="mb-0 ps-3 text-light small lh-lg">
                    <li class="mb-1">Show your booking confirmation details at the cinema entrance counter.</li>
                    <li class="mb-1">Please arrive at least 15 minutes before the showtime schedule.</li>
                    <li>Proceed inside and enjoy your movie experience!</li>
                </ul>
            </div>

            <a href="index1.php" class="btn btn-warning fw-bold px-5 py-2.5 shadow text-dark">
                Back to Home Dashboard
            </a>

        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">© Finals Movie Booking System</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("date").textContent = new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
    </script>
</body>
</html>