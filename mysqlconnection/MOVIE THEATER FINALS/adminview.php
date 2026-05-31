<?php
require_once "dbconnection.php";


if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $conn->query("DELETE FROM movie WHERE movie_id = $delete_id");
    header("Location: adminview.php?success=deleted");
    exit;
}

$success = $_GET['success'] ?? '';

$displaysql = "SELECT * FROM movie";
$result = $conn->query($displaysql);
$movies = $result->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | View Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <h1 class="display-5 fw-bold">Admin | Manage Movies</h1>
        <p class="fw-semibold mt-2 mb-0">Add, edit, remove, and view all movies in the system.</p>
    </div>
</section>

<section class="py-4 bg-white flex-grow-1">
    <div class="container">

        <div class="d-flex flex-wrap align-items-center justify-content-center mb-4">
            <a href="viewlogs.php" class="btn btn-warning fw-bold mx-3">View User Logs</a>
            <a href="viewuser.php" class="btn btn-warning fw-bold">View User Information</a>
            <a href="adminadd.php" class="btn btn-warning fw-bold mx-3">+ Add Movie</a>
        </div>

        <?php if (empty($movies)): ?>
        <div class="text-center py-5 text-muted">
            <div style="font-size:3rem;">🎞️</div>
            <h5 class="mt-3">No movies found.</h5>
            <a href="adminadd.php" class="btn btn-warning fw-bold mt-2">+ Add Movie</a>
        </div>
        <?php else: ?>
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <?php foreach ($movies as $movie): ?>
            <div class="card">
                <?php if (!empty($movie['movie_poster'])): ?>
                    <img class="rounded" src="<?= htmlspecialchars($movie['movie_poster']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
                <?php else: ?>
                    <div class="poster-placeholder">🎬</div>
                <?php endif; ?>

                <div class="card-info">
                    <div class="movie-title"><?= htmlspecialchars($movie['title']) ?></div>
                    <div class="movie-meta">
                        <?= htmlspecialchars($movie['genre']) ?> &bull; <?= $movie['duration'] ?> min
                    </div>
                </div>

                <div class="card-actions">
                    <a href="viewbookings.php?movie_id=<?= $movie['movie_id'] ?>" class="btn btn-outline-secondary btn-sm m-2">View Bookings</a>
                    <a href="addshowtime.php" class="btn btn-outline-warning btn-sm">Add a Showtime</a>
                    <button class="btn btn-outline-danger btn-sm m-2"
                            onclick="confirmDelete(<?= $movie['movie_id'] ?>, '<?= htmlspecialchars(addslashes($movie['title'])) ?>')">
                        Delete
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>
</section>

<footer class="bg-dark text-white text-center py-3">
    <p class="mb-0">© Finals Movie Booking System — Admin Panel</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById("date").textContent =
        new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });

    <?php if ($success === 'deleted'): ?>
    Swal.fire({ icon: 'success', title: 'Deleted!', text: 'Movie deleted successfully.', timer: 2500, showConfirmButton: false });
    <?php elseif ($success === 'added'): ?>
    Swal.fire({ icon: 'success', title: 'Added!', text: 'Movie added successfully.', timer: 2500, showConfirmButton: false });
    <?php elseif ($success === 'edited'): ?>
    Swal.fire({ icon: 'success', title: 'Updated!', text: 'Movie updated successfully.', timer: 2500, showConfirmButton: false });
    <?php endif; ?>

    function confirmDelete(id, title) {
        Swal.fire({
            title: 'Delete "' + title + '"?',
            text: 'This cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'adminview.php?delete=' + id;
            }
        }); 
    }
</script>
</body>
</html>