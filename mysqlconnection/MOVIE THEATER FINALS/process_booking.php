<?php
require_once "dbconnection.php";
session_start();

// If final confirmation POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    // Pull from session
    $showtime_id = intval($_SESSION['booking']['showtime_id'] ?? 0);
    $movie_id    = intval($_SESSION['booking']['movie_id'] ?? 0);
    $seat_ids    = $_SESSION['booking']['selected_seats'] ?? [];
    $user_id     = intval($_SESSION['user_id'] ?? 0);

    if (!$showtime_id || !$movie_id || empty($seat_ids)) {
        header("Location: index1.php");
        exit;
    }

    $booking_date    = date('Y-m-d');
    $num_tickets     = count($seat_ids);
    $seat_ids_clean  = array_map(fn($id) => $conn->real_escape_string($id), $seat_ids);
    $seat_ids_csv    = implode(',', $seat_ids_clean);

    // Insert single booking row
    $insert_sql = "INSERT INTO booking (showtime_id, user_id, booking_date, num_tickets, movie_id, seat_id)
                   VALUES ($showtime_id, $user_id, '$booking_date', $num_tickets, $movie_id, '$seat_ids_csv')";

    if ($conn->query($insert_sql)) {
        // Mark each seat as booked
        foreach ($seat_ids_clean as $seat_id) {
            $conn->query("UPDATE seat SET seat_status = 'booked' WHERE seat_id = '$seat_id'");
        }
        unset($_SESSION['booking']);
        header("Location: booking_success.php");
        exit;
    } else {
        header("Location: bookingdetails.php?movie_id=$movie_id&showtime_id=$showtime_id&error=1");
        exit;
    }
}

// Initial POST from seat selection
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_seats'])) {
    $showtime_id    = intval($_POST['showtime_id'] ?? 0);
    $movie_id       = intval($_POST['movie_id'] ?? 0);
    $selected_seats = $_POST['selected_seats'] ?? [];

    if (!$showtime_id || !$movie_id || empty($selected_seats)) {
        header("Location: index1.php");
        exit;
    }

    // Store in session
    $_SESSION['booking'] = [
        'showtime_id'    => $showtime_id,
        'movie_id'       => $movie_id,
        'selected_seats' => $selected_seats,
    ];

    header("Location: confirm_booking.php");
    exit;
}

// Fallback
header("Location: index1.php");
exit;