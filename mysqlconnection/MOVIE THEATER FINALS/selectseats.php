<?php
require_once "dbconnection.php";
session_start();

$movie_id = intval($_GET['movie_id'] ?? 0);
$showtime_id = intval($_GET['showtime_id'] ?? 0);

if ($movie_id === 0 || $showtime_id === 0) {
    header("Location: index1.php");
    exit;
}

$meta_query = "SELECT m.title, m.genre, s.show_date, s.show_time, t.theater_id, t.theater_name 
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

$theater_id = intval($details['theater_id']);
$seats_query = "SELECT seat_id, seat_number, seat_status FROM seat 
                WHERE theater_id = $theater_id 
                ORDER BY 
                    SUBSTRING(seat_number, 1, 1) ASC, 
                    CAST(SUBSTRING(seat_number, 2) AS UNSIGNED) ASC";
$seats_result = $conn->query($seats_query);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Select Seats | Appdev Movie Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* CSS Overrides */
        .cinema-screen {
            background: #e0e0e0;
            height: 8px;
            width: 70%;
            margin: 0 auto 30px auto;
            border-radius: 50%;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        
        .seat-grid {
            display: grid;
            grid-template-columns: repeat(5, 40px) 30px repeat(5, 40px);
            gap: 10px;
            justify-content: center;
            margin: 20px auto 0 auto;
            perspective: 400px;
            width: max-content; 
        }
        
        .card.bg-light {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-width: fit-content;
        }

        .seat-box {
            position: relative;
        }
        .seat-box input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0; width: 0;
        }
        .seat-label {
            display: block;
            background-color: #198754;
            color: #fff;
            text-align: center;
            font-size: 0.75rem;
            font-weight: bold;
            padding: 8px 0;
            border-radius: 6px;
            cursor: pointer;
            user-select: none;
            transition: all 0.2s ease;
        }
        .seat-label:hover {
            transform: scale(1.1);
            background-color: #157347;
        }
        
        .seat-box input[type="checkbox"]:checked + .seat-label {
            background-color: #ffc107 !important; 
            color: #000;
        }

        .seat-box.booked .seat-label {
            background-color: #dc3545 !important;
            cursor: not-allowed;
            opacity: 0.6;
            transform: none;
        }
    </style>
</head>
<body>

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
                    <li class="nav-item"><a class="nav-link text-light" href="index1.php">Now Showing</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="register.php">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="bg-secondary text-white py-2 shadow-lg">
        <div class="container">
            <span id="date"></span>
        </div>
    </div>

    <section class="bg-warning text-center p-3 shadow-lg">
        <div class="container py-3">
            <h1 class="display-5 fw-bold">Choose Your Seats</h1>
            <p class="fw-semibold mt-2 mb-0">
                <?= htmlspecialchars($details['title']) ?> &bull; 
                <?= date("F d, Y", strtotime($details['show_date'])) ?> at 
                <?= date("g:i A", strtotime($details['show_time'])) ?> — 
                <?= htmlspecialchars($details['theater_name']) ?>
            </p>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            
            <div class="mb-4">
                <a href="javascript:history.back()" class="text-dark fw-semibold text-decoration-none">← Change Schedule</a>
            </div>

            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="card shadow-sm p-4 bg-light border rounded-4 text-center">
                        
                        <p class="text-muted small text-uppercase fw-bold mb-1">Cinema Screen Direction</p>
                        <div class="cinema-screen"></div>

                        <form id="seatForm" action="process_booking.php" method="POST"> 
                            <input type="hidden" name="showtime_id" value="<?= $showtime_id ?>">
                            <input type="hidden" name="movie_id" value="<?= $movie_id ?>">

                            <div class="seat-grid mb-4">
                                <?php if ($seats_result && $seats_result->num_rows > 0): ?>
                                    <?php 
                                    $seat_counter = 0; 
                                    while ($seat = $seats_result->fetch_assoc()): 
                                        $is_booked = (strtolower($seat['seat_status']) === 'booked');
                                        
                                        if ($seat_counter > 0 && $seat_counter % 5 === 0 && $seat_counter % 10 !== 0) {
                                            echo '<div></div>';
                                        }
                                        $seat_counter++;
                                    ?>
                                        <div class="seat-box <?= $is_booked ? 'booked' : '' ?>">
                                            <input type="checkbox" name="selected_seats[]" value="<?= $seat['seat_id'] ?>" id="seat_<?= $seat['seat_id'] ?>"
                                                <?= $is_booked ? 'disabled' : '' ?>
                                                onchange="calculateTickets()">
                                            <label for="seat_<?= $seat['seat_id'] ?>" class="seat-label">
                                                <?= htmlspecialchars($seat['seat_number']) ?>
                                            </label>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    </div> 
                                    <div class="alert alert-dark p-4 my-3 text-center w-100" role="alert">
                                        <span class="fs-5 d-block mb-2">🎞️ No Layout Found</span>
                                        No seats have been populated for this theater layout yet.
                                    </div>
                                    <div class="d-none"> 
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow p-4 bg-dark text-white rounded-4 border-0 sticky-lg-top" style="top: 100px;">
                        <h4 class="fw-bold mb-3 text-warning">Booking Overview</h4>
                        <hr class="border-secondary">

                        <div class="d-flex justify-content-between small mb-4 text-center">
                            <div>
                                <span class="d-block px-3 py-1 rounded bg-success fw-bold text-white mb-1">Available</span>
                            </div>
                            <div>
                                <span class="d-block px-3 py-1 rounded bg-warning fw-bold text-dark mb-1">Selected</span>
                            </div>
                            <div>
                                <span class="d-block px-3 py-1 rounded bg-danger fw-bold text-white mb-1" style="opacity: 0.6;">Filled</span>
                            </div>
                        </div>

                        <div class="mb-3 d-flex justify-content-between">
                            <span>Selected Tickets:</span>
                            <span id="ticket_count" class="fw-bold text-warning">0</span>
                        </div>
                        
                        <div class="mb-4 d-flex justify-content-between">
                            <span>Estimated Base Total:</span>
                            <span class="fw-bold text-success">PHP <span id="total_price">0.00</span></span>
                        </div>

                        <button type="submit" form="seatForm" id="bookBtn" class="btn btn-warning w-100 fw-bold py-2 shadow" disabled>
                            Confirm & Create Booking
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">© Finals Movie Booking System</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("date").textContent = new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });

        const TICKET_PRICE = 350.00; 

        function calculateTickets() {
            const checkedBoxes = document.querySelectorAll('input[name="selected_seats[]"]:checked');
            const ticketCount = checkedBoxes.length;
            
            document.getElementById("ticket_count").textContent = ticketCount;
            document.getElementById("total_price").textContent = (ticketCount * TICKET_PRICE).toFixed(2);
            
            document.getElementById("bookBtn").disabled = (ticketCount === 0);
        }
    </script>
</body>
</html>