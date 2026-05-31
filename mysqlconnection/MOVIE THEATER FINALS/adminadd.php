<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Movie | Admin/Employee — Movie Booking System</title>
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
                    <li class="nav-item"><a class="nav-link text-light" href="index1.php">Now Showing</a></li>
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
            <h1 class="display-5 fw-bold">Add New Movie & Showtime</h1>
            <p class="fw-semibold mt-2 mb-0">Fill in the details below to add a movie and its setup times to the system.</p>
        </div>
    </section>

    <section class="py-4 bg-white flex-grow-1">
        <div class="container">

            <div class="mb-3">
                <a href="adminview.php" class="text-dark fw-semibold text-decoration-none">← Back to Movies</a>
            </div>

            <div class="container shadow-lg bg-dark p-5 w-75 rounded-5 mt-3 text-white">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="row mb-3">
                        <h1 class="text-center">Add Movie & Showtime</h1>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Movie Title</label>
                            <input type="text" name="movie_title" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Genre</label>
                            <select name="movie_genre" class="form-control" required>
                                <option disabled selected>Select Genre</option>
                                <option value="Action">Action</option>
                                <option value="Adventure">Adventure</option>
                                <option value="Animation">Animation</option>
                                <option value="Comedy">Comedy</option>
                                <option value="Crime">Crime</option>
                                <option value="Documentary">Documentary</option>
                                <option value="Drama">Drama</option>
                                <option value="Fantasy">Fantasy</option>
                                <option value="Horror">Horror</option>
                                <option value="Musical">Musical</option>
                                <option value="Mystery">Mystery</option>
                                <option value="Romance">Romance</option>
                                <option value="Sci-Fi">Sci-Fi</option>
                                <option value="Thriller">Thriller</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Duration (minutes)</label>
                            <input type="number" name="movie_duration" class="form-control" min="1" max="600" required>
                        </div>
                        <div class="col">
                            <label>Release Date</label>
                            <input type="date" name="movie_release_date" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Description</label>
                            <textarea name="movie_description" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <h5 class="text-warning">Showtime Settings</h5>
                        <div class="col-md-4">
                            <label>Show Date</label>
                            <input type="date" name="show_date" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Show Time</label>
                            <input type="time" name="show_time" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Theater ID</label>
                            <input type="number" name="theater_id" class="form-control" placeholder="e.g., 1" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col text-center">
                            <img src="" alt="" id="preview" width="200" height="280" class="img-thumbnail">
                            <input type="file" name="movie_poster" class="form-control mt-2" accept="image/jpeg,image/png,image/webp" onchange="previewimg(event)">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col text-center">
                            <input type="submit" name="btn_add" value="Add Movie & Showtime" class="btn btn-warning fw-bold w-75">
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
    <script>
        function previewimg(event) {
            var displayimg = document.getElementById("preview");
            displayimg.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</body>
</html>

<?php
require_once "dbconnection.php";

if (isset($_POST['btn_add'])) {
    $title = $_POST['movie_title'];
    $genre = $_POST['movie_genre'];
    $duration = $_POST['movie_duration'];
    $release_date = $_POST['movie_release_date'];
    $description = $_POST['movie_description'];
    
    
    $show_date = $_POST['show_date'];
    $show_time = $_POST['show_time'];
    $theater_id = $_POST['theater_id'];

    $poster_path = "";

    if (!empty($_FILES['movie_poster']['name'])) {
        if (!is_dir("posters")) {
            mkdir("posters", 0777, true);
        }
        $poster_path = "posters/" . basename($_FILES['movie_poster']['name']);
        move_uploaded_file($_FILES['movie_poster']['tmp_name'], $poster_path);
    }

   
    $insertsql = "INSERT INTO movie (title, genre, duration, release_date, description, movie_poster)
                  VALUES ('$title', '$genre', '$duration', '$release_date', '$description', '$poster_path')";

    if ($conn->query($insertsql)) {
        
        $new_movie_id = $conn->insert_id;


        $showtimesql = "INSERT INTO showtime (movie_id, theater_id, show_date, show_time)
                        VALUES ('$new_movie_id', '$theater_id', '$show_date', '$show_time')";
        
        $showtime_result = $conn->query($showtimesql);

        if ($showtime_result) {
            ?>
            <script>
                Swal.fire({
                    title: "Success!",
                    text: "Movie and Showtime have been configured successfully.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = "adminadd.php?success=added";
                });
            </script>
            <?php
        } else {
            echo "Movie added, but Showtime setup failed: " . $conn->error;
        }
    } else {
        echo "Database Error: " . $conn->error;
    }
}
?>