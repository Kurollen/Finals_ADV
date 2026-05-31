<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | Appdev Movie Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">

    <!-- NAVBAR -->
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

                    <li class="nav-item">
                        <a class="nav-link text-light" href="cinemas.php">Cinemas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="index1.php">Now Showing</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="register.php">Register/Login</a>
                    </li>

                </ul>

            </div>

        </div>

    </nav>

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

    <!-- HEADER -->
    <section class="bg-warning text-center p-3 shadow-lg">

        <div class="display-4 fw-bold">
            Log In to your account
        </div>

        <p class="fw-semibold mt-3">
            Appdev Finals
        </p>

    </section>

    <div class="container-fluid px-5">

        <div class="bg-light p-5">

            <div class="container w-50 border border-dark rounded shadow-lg p-5 bg-white">

                <h4 class="mb-4 fs-3 text-dark text-center fw-bold">
                    Log In
                </h4>

                <form action="login.php" method="post">

                    <div class="row mt-4">

                        <label class="text-dark mb-1">
                            Username
                        </label>

                        <div class="col">
                            <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                        </div>

                    </div>

                    <div class="row mt-4">

                        <label class="text-dark mb-1">
                            Password
                        </label>

                        <div class="col">
                            <input type="password" name="pass" class="form-control" placeholder="Enter Password" required>
                        </div>

                    </div>

                    <div class="row mt-5">

                        <div class="col text-center">

                            <input type="submit" name="sub" value="Log In" class="btn btn-warning w-75 fw-bold">

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">

        <p class="mb-0">
            © Finals Movie Booking System
        </p>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>

<?php
require_once "dbconnection.php";

if (isset($_POST['sub'])){
    $username = $_POST['username'];
    $pass = md5($_POST['pass']);

    $loginsql = "SELECT * FROM user WHERE username = '".$username."' and pass = '".$pass."' and acc_status = 'Active'";
    $result = $conn -> query($loginsql);

    //check if there's a match record
    if ($result->num_rows  == 1) {
        
    $fieldname = $result -> fetch_assoc();

    $roles = $fieldname["roles"];
    $fullname = $fieldname["full_name"];
    $id = $fieldname["user_id"];
    $_SESSION["username"] = $fieldname["username"];
    $_SESSION["full_name"] = $fullname;
    // //session variable
    // $_SESSION["user_type"] = $usertype;
    // $_SESSION["fullname"] = $firstname." ".$lastname;
    // $_SESSION["first"] = $firstname;
    // $_SESSION["image"] = $imagepath;
    $_SESSION["user_id"] = $id;

    //logs
    $logssql = "Insert INTO logs (user_id, action, datetime) values('".$_SESSION["user_id"]."','Logged In', NOW())";
    $conn ->query($logssql);

    //transfer to dashboard based on usertype
    if ($roles   == "admin") {
        ?>
            <script>
                window.location.href = "adminview.php";
            </script>
        <?php
    } elseif ($roles == "employee") {
        ?>
            <script>
                window.location.href = "employee.php"; 
            </script>
        <?php
    } elseif ($roles == "customer"){
        ?>
             <script>
                window.location.href = "index1.php";
            </script>
        <?php
    }
    } else {    
?>
         <script>
        Swal.fire({
            position: "center",
            icon: "error",
            title: "enghkkkkk invalid sis",
            showConfirmButton: false,
            timer: 1500
        });
        </script>
<?php
    }   
}
//pusher delte later
?>