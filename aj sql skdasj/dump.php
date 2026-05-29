<?php
if (isset($_POST["reg"])) {
    $fullname = $_POST[''];
    $email = $_POST[''];
    $username = $_POST[''];
    $password = md5($_POST['']);

    $otp = rand(000000,999999);

    //insert query
    $insertsql = "INSERT INTO user (full_name, roles, email, username, pass) 
    VALUES ('$fullname', 'customer', '$email', '$username', '$password')";
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
        window.location.href = "otpverification.php"; //pls edit this
        });
    </script>
    <?php
    } else {
        echo $conn -> error;
    }
}
?>