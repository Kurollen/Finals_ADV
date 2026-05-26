<?php
require_once "arr.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | Appdev Movie Booking System </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <!-- header/navbar -->
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

                    <li class="nav-item">
                        <a class="nav-link text-light" href="cinemas.php">Cinemas</a>
                    </li>

                    <li class="nav-item text">
                        <a class="nav-link text-light" href="booknow.php">Book Now</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="nowshowing.php">Now Showing</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="register.php">Register/Login</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <!-- date bar kasi gaya gaya ako -->
    <div class="bg-secondary text-white py-2 shadow-lg">
        <div class="container">
            <span id="date"></span>
        </div>
    </div>

    <script>
        function updateDate() {
            const today = new Date();

            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            document.getElementById("date").innerHTML =
                today.toLocaleDateString('en-US', options);
        }

        updateDate();

    </script>

    <!-- welcome -->
    <section class="bg-warning text-center p-3 shadow-lg">
        
        <div class="container py-4">
            <h1 class="display-4 fw-bold">
                Welcome to the best Movie Booking System ever
            </h1>

            <p class="fw-semibold mt-3">
                Appdev Finals
            </p>
        </div>
        
    </section>

    <!-- now showing movies -->
     <section class="py-3 bg-white">

        <div class="container text-center">

            <h2 class="fw-bold mb-2">Now showing</h2>
            <h5 class="border border-dark rounded d-inline-block p-2 mb-4"> CLICK POSTER TO BOOK YOUR MOVIE</h5>

            <div class="row g-3 justify-content-center">

                <!-- movie 1 -->
                 <div class="col-md-3 mx-4">
                    <a href="bookingdetails.php?movie=lalaland">
                    <div class="card h-100 shadow">
                        <img class="card-img-top rounded" src="La_La_Land_(film).png" alt="cardmovie">
                    </div>
                    </a>
                 </div>
                 
                <!-- movie 2 -->
                 <div class="col-md-3 mx-4">
                    <a href="bookingdetails.php?movie=msperegrines">
                    <div class="card h-100 shadow">
                        <img class="card-img-top rounded" src="msperegrines.jpg" alt="cardmovie">
                    </div>
                    </a>
                 </div>

                <!-- movie 3 -->
                 <div class="col-md-3 mx-4">
                    <a href="bookingdetails.php">
                    <div class="card h-100 shadow">
                        <img class="card-img-top rounded" src="La_La_Land_(film).png" alt="cardmovie">
                    </div>
                    </a>
                 </div>

            </div>

                

        </div>

     </section>

     <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">
            © Finals Movie Booking System
        </p>
     </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>