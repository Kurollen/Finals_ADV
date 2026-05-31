<?php
session_start();
require_once "dbconnection.php";

$movie_id = intval($_GET['movie_id'] ?? 0);
if ($movie_id === 0) {
    header("Location: adminview.php");
    exit;
}

$movie_stmt = $conn->query("SELECT title FROM movie WHERE movie_id = $movie_id");
$movie_details = $movie_stmt->fetch_assoc();
$movie_title = $movie_details['title'] ?? 'Unknown Movie';

$displaysql = "SELECT b.booking_id, u.full_name, s.show_date, s.show_time, b.num_tickets, b.seat_id, b.booking_date
               FROM booking b
               JOIN user u ON b.user_id = u.user_id
               JOIN showtime s ON b.showtime_id = s.showtime_id
               WHERE s.movie_id = $movie_id";

if (isset($_POST['btnsearch'])) {
    $searchinput = trim($_POST["searchinput"]);

    if (!empty($searchinput)) {
        $searchinput = $conn->real_escape_string($searchinput);
        $displaysql .= " AND (u.full_name LIKE '%$searchinput%' 
                        OR s.show_date LIKE '%$searchinput%' 
                        OR b.booking_id LIKE '%$searchinput%')";

        if (isset($_SESSION["user_id"])) {
            $logssql = "INSERT INTO logs (user_id, action, datetime) 
                        VALUES ('".$_SESSION["user_id"]."', 'Searched movie ($movie_id) bookings for: $searchinput', NOW())";
            $conn->query($logssql);
        }
    }
}

$result = $conn->query($displaysql);

$ticket_price = 350.00;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Movie Bookings | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

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
                    <li class="nav-item"><a class="nav-link text-light" href="cinemas.php">Cinemas</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="booknow.php">Book Now</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="index1.php">Now Showing</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="register.php">Register/Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="bg-secondary text-white py-2 shadow-lg">
        <div class="container d-flex justify-content-between">
            <span id="date"></span>
            <span class="badge bg-danger">Admin Panel</span>
        </div>
    </div>

    <section class="bg-warning text-center p-3 shadow-lg">
        <div class="container py-3">
            <h1 class="display-5 fw-bold">Movie Bookings Overview</h1>
            <p class="fw-semibold mt-2 mb-0">Currently viewing bookings for: <span class="text-dark border-bottom border-dark"><?= htmlspecialchars($movie_title) ?></span></p>
        </div>
    </section>

    <section class="py-4 bg-white flex-grow-1">
        <div class="container">

            <div class="mb-3">
                <a href="adminview.php" class="text-dark fw-semibold text-decoration-none">← Back to Management Dashboard</a>
            </div>

            <div class="container shadow bg-dark p-4 rounded-4 text-white mb-4">
                <form action="viewbookings.php?movie_id=<?= $movie_id ?>" method="post" class="m-0">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-9">
                            <input type="search" name="searchinput" value="<?= htmlspecialchars($_POST['searchinput'] ?? '') ?>" placeholder="Search by customer name, date, or booking ID..." class="form-control">
                        </div>
                        <div class="col-md-3">
                            <input type="submit" name="btnsearch" value="Search Bookings" class="btn btn-warning fw-bold w-100">
                        </div>
                    </div>
                </form>
            </div>

            <?php if ($result && $result->num_rows > 0): ?>
                <div class="card shadow-lg border-0 rounded-4 w-100">
                    <div class="table-responsive">                    
                        <div class="card-body p-0">
                        <table class="table table-dark table-striped table-hover m-0 align-middle">
                            <thead class="table-secondary text-uppercase fs-7">
                                <tr>
                                    <th class="ps-4 py-3">Booking ID</th>
                                    <th class="py-3">Customer Name</th>
                                    <th class="py-3">Booking Date</th>
                                    <th class="py-3">Show Date</th>
                                    <th class="py-3">Show Time</th>
                                    <th class="py-3">Seats</th>
                                    <th class="py-3">Tickets</th>
                                    <th class="pe-4 py-3 text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $row): 
                                    $total = $row['num_tickets'] * $ticket_price;
                                ?>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-warning">#<?= $row['booking_id'] ?></td>
                                        <td><?= htmlspecialchars($row['full_name']) ?></td>
                                        <td><?= date("M d, Y", strtotime($row['booking_date'])) ?></td>
                                        <td><?= date("M d, Y", strtotime($row['show_date'])) ?></td>
                                        <td><?= date("g:i A", strtotime($row['show_time'])) ?></td>
                                        <td><span class="badge bg-warning text-dark"><?= htmlspecialchars($row['seat_id']) ?></span></td>
                                        <td><span class="badge bg-secondary"><?= $row['num_tickets'] ?> Ticket(s)</span></td>
                                        <td class="pe-4 text-end text-success fw-bold">PHP <?= number_format($total, 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <div class="p-5 text-center bg-dark text-muted rounded-4">
                    <p class="fs-4 mb-0">No booking records found for this movie.</p>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">© Finals Movie Booking System — Admin Panel</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateDate() {
            const today = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById("date").innerHTML = today.toLocaleDateString('en-US', options);
        }
        updateDate();
    </script>
</body>
</html>