<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 w-25 border border-primary rounded p-5">
        <div class="row mb-5">
            <div class="col text-center fw-bold">
                <span class="display-4 text-primary">OTP Verification</span>
            </div>
        </div>
        <div class="row my-3">
            <div class="col text-center fw-bold">
                <span class="text-primary h6">One time password (OTP) was sent to your email</span>
            </div>
        </div>

        <form action="" method="post">
            <div class="form-outline mb-4">
                <label class="form-label" for="otp_input">Enter the OTP Number to verify</label>
                <input type="text" name="otp" id="otp_input" class="form-control" required />
            </div>
            <!-- FIXED: Kept name="ver" here, which matches the POST check below -->
            <input type="submit" name="ver" value="Verify" class="btn btn-primary btn-block w-100 mb-4">
        </form>
    </div>    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

<?php
require_once "dbaseconnection.php";

if (isset($_POST['ver'])) {
    // user input
    $userotp = $_POST['otp'];

    $otpsql = "Select * from tbl_userdetails_ajv where otpajv = '".$userotp."'";
    $result = $conn -> query($otpsql);

    if ($result -> num_rows == 1) {
        // FIXED: Added missing WHERE clause and cleaned up messy string quotes
        $updatesql = "UPDATE tbl_userdetails_ajv SET otpajv = NULL, statusajv = 'Active' WHERE otpajv = '".$userotp."'";
        $conn -> query($updatesql);
        ?>
        <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Account Activated!",
            showConfirmButton: false,
            timer: 1500
        }).then(()=>{
            window.location.href = "login.php";
        });
        </script>
        <?php
    }
}
?>