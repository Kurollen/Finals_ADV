<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
 </head>
<body>
    <!-- Navbar for name -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                Company Name
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                       data-bs-toggle="dropdown">

                        <img src= "<?php echo $_SESSION["image"];?>"
                             class="rounded-circle me-2"
                             width="40"
                             height="40">

                        <strong><?php echo $_SESSION['fname'];?></strong>
                    </a>
                </div>

            </div>
        </div>
    </nav>


    <div class="container mt-5">
        <h1>Welcome back, <?php echo $_SESSION['user_typeajv']." ".$_SESSION["fullname"];?></h1>
        <?php ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
