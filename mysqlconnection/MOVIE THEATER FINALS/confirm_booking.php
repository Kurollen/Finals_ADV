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
            padding: 10px 0;
            border-bottom: 1px solid #2c2c2c;
            font-size: 0.95rem;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            color: #adb5bd;
            min-width: 140px;
        }
        .detail-value {
            text-align: right;
            font-weight: 500;
            color: #f8f9fa;
        }
        .seat-badge {
            display: inline-block;
            background: #ffc107;
            color: #000;
            font-weight: bold;
            font-size: 0.8rem;
            padding: 3px 10px;
            border-radius: 5px;
            margin: 2px;
        }
        .section-card {
            background: #1c1c1c;
            border: 1px solid #2c2c2c;
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1rem;
        }
        .section-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6c757d;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            margin-top: 4px;
            border-top: 1px solid #2c2c2c;
        }
        .notice-box {
            background: #0d1b2a;
            border: 1px solid #1a3a5c;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 0.85rem;
            color: #90c4f9;
            margin-bottom: 1.5rem;
        }
        .btn-back-link {
            color: #adb5bd;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .btn-back-link:hover {
            color: #fff;
        }
    </style>
</head>
<body class="bg-dark text-white">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index1.php">
                <img src="" alt="logo" width="45" class="me-2">
                Appdev Movie Booking System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-light" href="cinemas.php">Cinemas</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="booknow.php">Book Now</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="nowshowing.php">Now Showing</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="register.php">Register/Login</a></li>
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

    <!-- Header -->
    <section class="bg-warning text-center p-3 shadow-lg">
        <div class="container py-3">
            <h1 class="display-5 fw-bold text-dark">Confirm Your Booking</h1>
            <p class="fw-semibold mt-2 mb-0 text-dark">Review your details before finalizing</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container" style="max-width: 680px;">

            <div class="mb-4">
                <a href="javascript:history.back()" class="btn-back-link">← Go back and change seats</a>
            </div>

            <!-- Movie Details -->
            <div class="section-card">
                <div class="section-title">Movie details</div>
                <div class="detail-row">
                    <span class="detail-label">Title</span>
                    <span class="detail-value"><?= htmlspecialchars($details['title']) ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Genre</span>
                    <span class="detail-value"><?= htmlspecialchars($details['genre']) ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Duration</span>
                    <span class="detail-value"><?= $details['duration'] ?></span>
                </div>
            </div>

            <!-- Showtime & Theater -->
            <div class="section-card">
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

            <!-- Seat Selection -->
            <div class="section-card">
                <div class="section-title">Selected seats</div>
                <div class="detail-row">
                    <span class="detail-label">Seats (<?= $num_tickets ?>)</span>
                    <span class="detail-value">
                        <?php foreach ($seat_numbers as $sn): ?>
                            <span class="seat-badge"><?= htmlspecialchars($sn) ?></span>
                        <?php endforeach; ?>
                    </span>
                </div>
            </div>

            <!-- Guest -->
            <div class="section-card">
                <div class="section-title">Guest</div>
                <div class="detail-row">
                    <span class="detail-label">Name</span>
                    <span class="detail-value"><?= htmlspecialchars($username) ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Booking date</span>
                    <span class="detail-value"><?= date("F d, Y") ?></span>
                </div>
            </div>

            <!-- Payment Summary -->
            <div class="section-card">
                <div class="section-title">Payment summary</div>
                <div class="detail-row">
                    <span class="detail-label">Price per ticket</span>
                    <span class="detail-value">PHP <?= number_format($ticket_price, 2) ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Number of tickets</span>
                    <span class="detail-value"><?= $num_tickets ?></span>
                </div>
                <div class="total-row">
                    <span class="fw-bold fs-5">Total</span>
                    <span class="fw-bold fs-5 text-warning">PHP <?= number_format($total_price, 2) ?></span>
                </div>
            </div>

            <!-- Notice -->
            <div class="notice-box">
                ℹ️ By confirming, your selected seats will be reserved and marked as booked. This action cannot be undone.
            </div>

            <!-- Actions -->
            <form action="process_booking.php" method="POST">
                <input type="hidden" name="confirm" value="1">
                <div class="d-flex gap-3">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary w-50 fw-bold py-2">
                        ← Edit Seats
                    </a>
                    <button type="submit" class="btn btn-warning w-50 fw-bold py-2 shadow">
                        Confirm Booking ✓
                    </button>
                </div>
            </form>

        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3 mt-5 border-top border-secondary">
        <p class="mb-0">© Finals Movie Booking System</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("date").textContent = new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
    </script>
</body>
</html>