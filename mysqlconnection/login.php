<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5 w-25 border border-primary rounded p-5">
        <div class="row mb-4">
            <div class="col text-center fw-bold">
                <span class="display-2 text-primary">Log In</span>
            </div>
        </div>
        <form action="login.php" method="post">
        <div class="form-outline mb-4">
            <input type="text" name="username" id="form2Example1" class="form-control" />
            <label class="form-label" for="form2Example1">Username</label>
        </div>

        <div class="form-outline mb-4">
            <input type="password" name="pass" id="form2Example2" class="form-control" />
            <label class="form-label" for="form2Example2">Password</label>
        </div>
        <input type="submit" name="sub" value="Log In" class="btn btn-primary btn-block mb-4">
        </form>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </div>    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

<?php
require_once "dbaseconnection.php";

if (isset($_POST["sub"])) {

    $username = $_POST["username"];
    $pass = md5($_POST["pass"]);

    $loginsql = "SELECT * FROM tbl_userdetails_ajv WHERE username = '".$username."' AND password = '".$pass."' AND statusajv = 'Active'" ;

    $result = $conn->query($loginsql);

    if ($result->num_rows == 1) {

        $fieldname = $result -> fetch_assoc();
        $usertype = $fieldname["user_typeajv"];
        $firstname = $fieldname["fname"];
        $lastname = $fieldname["lname"];
        $image_path = $fieldname["img_pthajv"];
        $id = $fieldname["userid"];

        // session
        $_SESSION['user_typeajv'] = $usertype;
        $_SESSION['fullname'] = $firstname." ".$lastname;
        $_SESSION['fname'] = $firstname;
        $_SESSION["image"] = $image_path;
        $_SESSION["id"] = $id;

        $logssql = "insert into tbl_logsajv (user_id, action, datetime) 
        values ('".$_SESSION['id']."','Logged In',NOW()) ";
        $conn ->query($logssql);
        

        // transfer to dashboard based on usertype
        if ($usertype == "Admin") {
            header('location: admin.php');    

        } else if ($usertype == "Employee") {
            ?>
            <script>
                window.location.href = "employee.php";  
            </script>
            <?php
        }
        
    } else {
        // FIXED: Replaced standard error alert configuration with parameters from the first code block
        ?>
        <script>
        Swal.fire({
            position: "center",
            icon: "error",
            title: "Could not login",
            showConfirmButton: false,
            timer: 1500
        });
        </script>
        <?php
    }
}
?>