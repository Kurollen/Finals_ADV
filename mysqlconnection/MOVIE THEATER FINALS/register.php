<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration | Appdev Movie Booking System</title>
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

    <!-- DATE BAR -->
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

    <!-- MAIN CONTAINER -->
    <section class="bg-warning text-center p-3 shadow-lg">
            <div class="display-4 fw-bold">
                Customer Details
            </div>

            <p class="fw-semibold mt-3">
                Appdev Finals
            </p>
        
    </section>
    <div class="container-fluid px-5">
        

        <div class="bg-light p-5">

            <!-- FORM -->
            <form action="" method="post">

                <h4 class="mb-4 fs-5 text-dark text-center">
                    Please fill in the Details of Customer
                </h4>

                <h4 class="mb-4 fs-6 text-secondary text-center">
                    These details are for the moviegoer (the person attending the movie).
                </h4>

                <!-- NAME -->
                <div class="row mt-5">

                    <label class="text-dark mb-1">
                        Full Name
                    </label>

                    <div class="col">
                        <input type="text" name="Fullname" id="Fullname"class="form-control" placeholder="Full Name (FN MI, LN )" required>
                    </div>

                </div>

                <!-- EMAIL -->
                <div class="row mt-3">

                    <label class="text-dark mb-1" for="Email">
                        Email Address
                    </label>

                    <div class="col">
                        <input type="email" name="Email" id="Email" class="form-control" placeholder="ex. juandelacruz@yahoo.com" required>
                    </div>

                </div>

                <!-- USERNAME -->
                <div class="row mt-3">

                    <label class="text-dark mb-1">Username</label>

                    <div class="col">
                        <input type="text" name="Username" id="Username" class="form-control" placeholder="ex. Juan DC" required>
                    </div>

                </div>

                <!-- PASSWORD -->
                <div class="row mt-3">

                    <label class="text-dark mb-1">Password</label>

                    <div class="col">
                        <input type="password" name="Password" id="Password" class="form-control" placeholder="1 Uppercase, 1 number, 1 special character" required>
                    </div>

                </div>

                <!-- TERMS -->
                <div class="row mt-5">
                    <h4 class="mb-4 fs-6 text-dark">
                        <b>CONFIRMATION</b>
                    </h4>
                </div>

                <!-- CHECKBOX -->
                <div class="row">

                    <div class="form-check">

                        <input type="checkbox"
                               class="form-check-input"
                               name="agree"
                               id="agree"
                               required>

                        <label for="agree" class="form-check-label">

                            <span class="text-secondary">I CONFIRM THAT ALL THE DETAILS ARE CORRECT</span>

                        </label>

                    </div>

                </div>

                <!-- BUTTONS -->
                <div class="row mt-4">

                    <div class="col text-center">

                        <div class="col text-center">
                            <input type="submit" name="reg" value="Register" class="btn btn-warning w-75">
                        </div>

                    </div>

                    <div class="col text-center">
                            <input type="button" onclick="window.location.href='login.php'" value="Already Have an Account (Log In)" class="btn btn-warning w-75">
                    </div>

                </div>

     

            </form>

        </div>

    </div>

    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">
            © Finals Movie Booking System
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>


    </script>

</body>
</html>

<?php
require_once "dbconnection.php";
require_once "otpsender.php";


if (isset($_POST["reg"])) {
    $fullname = $_POST['Fullname'];
    $email = $_POST['Email'];
    $username = $_POST['Username'];
    $password = md5($_POST['Password']);

    $otp = rand(000000,999999);

    //insert query
    $insertsql = "INSERT INTO user (full_name, roles, email, username, pass, otp, acc_status) 
    VALUES ('$fullname', 'customer', '$email', '$username', '$password', '$otp', 'Pending')";
    $result = $conn -> query($insertsql);

    if ($result == true){
        //function for verify
        send_verification($fullname, $email, $otp);
        ?>
        <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Check your email to activate your account.",
            showConfirmButton: false,
            timer: 3000
        }).then(()=>{
        window.location.href = "otpchecker.php"; //pls edit this
        });
    </script>
    <?php
    } else {
        echo $conn -> error;
    }

}
//pusher delte later
?>