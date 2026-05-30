<?php
require_once "dbconnection.php";

// Fetch movies and theaters for dropdowns before HTML renders
$movies_result = $conn->query("SELECT movie_id, title FROM movie ORDER BY title ASC");
$theaters_result = $conn->query("SELECT theater_id, theater_name, capacity FROM theater ORDER BY theater_name ASC");

// Process form submission
if (isset($_POST['btn_add_showtime'])) {
    $movie_id = intval($_POST['movie_id']);
    $theater_id = intval($_POST['theater_id']);
    $show_date = $_POST['show_date'];
    $show_time = $_POST['show_time'];

    // Dynamically grab capacity from chosen theater to set default available seats
    $capacity_query = $conn->query("SELECT capacity FROM theater WHERE theater_id = $theater_id");
    $theater_data = $capacity_query->fetch_assoc();
    $available_seats = $theater_data['capacity'] ?? 0;

    // Insert ONLY into the showtime table (Prevents movie duplication)
    $insertsql = "INSERT INTO showtime (movie_id, theater_id, show_date, show_time, available_seats)
                  VALUES ('$movie_id', '$theater_id', '$show_date', '$show_time', '$available_seats')";

    $result = $conn->query($insertsql);
    $success_status = $result ? "true" : "false";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Showtime | Admin/Employee — Movie Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

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

    <div class="bg-secondary text-white py-2 shadow-lg">
        <div class="container d-flex justify-content-between">
            <span id="date"></span>
            <span class="badge bg-info">Admin/Employee Panel</span>
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

    <section class="bg-warning text-center p-3 shadow-lg">
        <div class="container py-3">
            <h1 class="display-5 fw-bold">Add New Showtime</h1>
            <p class="fw-semibold mt-2 mb-0">Assign a new date, time, and theater room to an existing movie title.</p>
        </div>
    </section>

    <section class="py-4 bg-white flex-grow-1">
        <div class="container">

            <div class="mb-3">
                <a href="adminview.php" class="text-dark fw-semibold text-decoration-none">← Back to Movies</a>
            </div>

            <div class="container shadow-lg bg-dark p-5 w-75 rounded-5 mt-3 text-white">
                <form action="" method="post">

                    <div class="row mb-3">
                        <h1 class="text-center">Configure Schedule</h1>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Target Movie Title</label>
                            <select name="movie_id" class="form-select form-control" required>
                                <option disabled selected value="">-- Select Movie --</option>
                                <?php if ($movies_result && $movies_result->num_rows > 0): ?>
                                    <?php while ($row = $movies_result->fetch_assoc()): ?>
                                        <option value="<?= $row['movie_id'] ?>"><?= htmlspecialchars($row['title']) ?></option>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <option disabled>No movies found in database</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Assign Theater Room</label>
                            <select name="theater_id" class="form-select form-control" required>
                                <option disabled selected value="">-- Select Theater Room --</option>
                                <?php if ($theaters_result && $theaters_result->num_rows > 0): ?>
                                    <?php while ($row = $theaters_result->fetch_assoc()): ?>
                                        <option value="<?= $row['theater_id'] ?>">
                                            <?= htmlspecialchars($row['theater_name']) ?> (Capacity: <?= $row['capacity'] ?> seats)
                                        </option>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <option disabled>No theaters found in database</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Show Screening Date</label>
                            <input type="date" name="show_date" class="form-control" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Show Start Time</label>
                            <input type="time" name="show_time" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col text-center">
                            <input type="submit" name="btn_add_showtime" value="Add Showtime Slot" class="btn btn-warning fw-bold w-75">
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">© Finals Movie Booking System — Admin/Employee Panel</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (isset($success_status) && $success_status === "true"): ?>
    <script>
        Swal.fire({
            title: "Showtime Added!",
            text: "The new screening time has been assigned successfully.",
            icon: "success",
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = "adminview.php";
        });
    </script>
    <?php elseif (isset($success_status) && $success_status === "false"): ?>
    <script>
        Swal.fire({
            title: "Error!",
            text: "Something went wrong adding the showtime setup: <?= addslashes($conn->error) ?>",
            icon: "error"
        });
    </script>
    <?php endif; ?>
</body>
</html>