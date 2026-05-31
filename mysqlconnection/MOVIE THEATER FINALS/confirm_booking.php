<?php
require_once "dbconnection.php";
session_start();

// Redirect if no booking in session
if (empty($_SESSION['booking'])) {
    header("Location: index1.php");
    exit;
}

$booking        = $_SESSION['booking'];
$showtime_id    = intval($booking['showtime_id']);
$movie_id       = intval($booking['movie_id']);
$selected_seats = $booking['selected_seats']; // array of seat_ids
$num_tickets    = count($selected_seats);
$ticket_price   = 350.00;
$total_price    = $num_tickets * $ticket_price;

// Fetch movie + showtime + theater details
$meta_query = "SELECT m.title, m.genre, m.duration, s.show_date, s.show_time, t.theater_name
               FROM showtime s
               JOIN movie m ON s.movie_id = m.movie_id
               JOIN theater t ON s.theater_id = t.theater_id
               WHERE s.showtime_id = $showtime_id AND m.movie_id = $movie_id";
$meta_result = $conn->query($meta_query);
$details = $meta_result->fetch_assoc();

if (!$details) {
    header("Location: index1.php");
    exit;
}

// Fetch seat numbers for selected seat IDs
$seat_ids_escaped = implode(',', array_map('intval', $selected_seats));
$seats_query      = "SELECT seat_number FROM seat WHERE seat_id IN ($seat_ids_escaped) ORDER BY seat_number ASC";
$seats_result     = $conn->query($seats_query);
$seat_numbers     = [];
while ($row = $seats_result->fetch_assoc()) {
    $seat_numbers[] = $row['seat_number'];
}

$username = $_SESSION['full_name'] ?? $_SESSION['username'] ?? 'Guest';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm Booking | Appdev Movie Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 12px 0;
            border-bottom: 1px solid #dee2e6;
            font-size: 0.95rem;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            color: #6c757d;
            font-weight: 600;
            min-width: 140px;
        }
        .detail-value {
            text-align: right;
            font-weight: bold;
            color: #212529;
        }
        .seat-badge {
            display: inline-block;
            background: #ffc107;
            color: #000;
            font-weight: bold;
            font-size: 0.8rem;
            padding: 4px 10px;
            border-radius: 5px;
            margin: 2px;
        }
        .section-card {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }
        .section-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #495057;
            font-weight: 800;
            margin-bottom: 0.75rem;
            border-bottom: 2px solid #ffc107;
            padding-bottom: 4px;
            width: fit-content;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            margin-top: 4px;
            border-top: 2px solid #212529;
        }
        .notice-box {
            background: #fff3cd;
            border: 1px solid #ffe69c;
            border-radius: 10px;
            padding: 14px 16px;
            font-size: 0.85rem;
            color: #664d03;
            margin-bottom: 1.5rem;
            font-weight: 500;
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
                    <li class="nav-item"><a class="nav-link text-light" href="cinemas.php">Cinemas</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="nowshowing.php">Now Showing</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="register.php">Register/Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="bg-secondary text-white py-2 shadow-lg">
        <div class="container d-flex justify-content-between">
            <span id="date"></span>
            <span class="badge bg-warning text-dark fw-bold">Checkout Summary</span>
        </div>
    </div>

    <section class="bg-warning text-center p-3 shadow-lg">
        <div class="container py-3">
            <h1 class="display-5 fw-bold text-dark">Confirm Your Booking</h1>
            <p class="fw-semibold mt-2 mb-0 text-dark">Review your selection details before final processing execution triggers.</p>
        </div>
    </section>

    <section class="py-5 bg-white flex-grow-1">
        <div class="container" style="max-width: 680px;">

            <div class="mb-4">
                <a href="javascript:history.back()" class="text-dark fw-semibold text-decoration-none">← Go back and change seats</a>
            </div>

            <div class="section-card shadow-sm">
                <div class="section-title">Movie details</div>
                <div class="detail-row">
                    <span class="detail-label">Title</span>
                    <span class="detail-value text-uppercase"><?= htmlspecialchars($details['title']) ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Genre</span>
                    <span class="detail-value"><?= htmlspecialchars($details['genre']) ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Duration</span>
                    <span class="detail-value"><?= $details['duration'] ?> Minutes</span>
                </div>
            </div>

            <div class="section-card shadow-sm">
                <div class="section-title">Schedule & venue</div>
                <div class="detail-row">
                    <span class="detail-label">Theater</span>
                    <span class="detail-value"><?= htmlspecialchars($details['theater_name']) ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Date</span>
                    <span class="detail-value"><?= date("F d, Y", strtotime($details['show_date'])) ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Time</span>
                    <span class="detail-value"><?= date("g:i A", strtotime($details['show_time'])) ?></span>
                </div>
            </div>

            <div class="section-card shadow-sm">
                <div class="section-title">Selected seats</div>
                <div class="detail-row align-items-center">
                    <span class="detail-label">Seats (<?= $num_tickets ?>)</span>
                    <span class="detail-value">
                        <?php foreach ($seat_numbers as $sn): ?>
                            <span class="seat-badge shadow-sm"><?= htmlspecialchars($sn) ?></span>
                        <?php endforeach; ?>
                    </span>
                </div>
            </div>

            <div class="section-card shadow-sm">
                <div class="section-title">Account Assignment</div>
                <div class="detail-row">
                    <span class="detail-label">Profile User</span>
                    <span class="detail-value text-muted"><?= htmlspecialchars($username) ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Transaction Date</span>
                    <span class="detail-value"><?= date("F d, Y") ?></span>
                </div>
            </div>

            <div class="section-card shadow-sm border-warning">
                <div class="section-title">Payment summary</div>
                <div class="detail-row">
                    <span class="detail-label">Price per ticket</span>
                    <span class="detail-value text-muted">PHP <?= number_format($ticket_price, 2) ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Quantity</span>
                    <span class="detail-value"><?= $num_tickets ?> Ticket(s)</span>
                </div>
                <div class="total-row">
                    <span class="fw-bold fs-5 text-dark">Total Bill:</span>
                    <span class="fw-bold fs-4 text-success">PHP <?= number_format($total_price, 2) ?></span>
                </div>
            </div>

            <div class="notice-box shadow-sm d-flex align-items-center">
                <span class="me-2 fs-5">⚠️</span>
                <span>By confirming, your selected seats will be permanently reserved under your account context. This action cannot be undone.</span>
            </div>

            <form action="process_booking.php" method="POST" class="m-0">
                <input type="hidden" name="confirm" value="1">
                <div class="d-flex gap-3">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary w-50 fw-bold py-2">
                        ← Edit Seats
                    </a>
                    <button type="submit" class="btn btn-warning w-50 fw-bold py-2 shadow-sm text-dark">
                        Confirm Booking ✓
                    </button>
                </div>
            </form>

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