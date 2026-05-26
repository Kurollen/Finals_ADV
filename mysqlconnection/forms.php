<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container shadow-lg bg-dark p-5 w-75 rounded-5 mt-3 text-white">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <h1 class="text-center">Student Registration</h1>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="">Firstname</label>
                    <input type="text" name="ajvfname" class="form-control" required>
                </div>
                <div class="col">
                    <label for="">Lastname</label>
                    <input type="text" name="ajvlname" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="">Student Number</label>
                    <input type="text" name="ajvstudNo" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="">Username</label>
                    <input type="text" name="ajvusername" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
              <div class="col">
                <label for="">User Type</label>
                <!-- FIXED: Changed type from email to text so it accepts standard strings -->
                <input type="text" name="ajvusertype" class="form-control" required>
              </div>
            </div>
            
            <div class="row mb-3">
                <div class="col">
                    <label for="">Password</label>
                    <input type="password" name="ajvpassword" class="form-control" required>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col">
                    <label for="">Batch</label>
                    <input type="text" name="ajvbatch" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <label for="">Gender</label>
                <div class="col mx-5">
                    <div class="form-check-inline">
                        <input type="radio" name="ajvgender" value="Male" class="form-check-input" checked>
                        <label for="">Male</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check-inline">
                        <input type="radio" name="ajvgender" value="Female" class="form-check-input">
                        <label for="">Female</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check-inline">
                        <input type="radio" name="ajvgender" value="Others" class="form-check-input">
                        <label for="">Others</label>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="">Birthday</label>
                    <input type="date" name="ajvbday" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="">Course</label>
                    <select name="ajvcourse" class="form-control">
                        <option disabled selected>Select Course</option>
                        <option value="BSIT">BS in Information Technology</option>
                        <option value="BSCS">BS in Computer Science</option>
                        <option value="BSIS">BS in Information Systems</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
              <div class="col">
                <label for="">Year Level</label>
                <select name="ajvyearlevel" class="form-control">
                  <option disabled selected>Select Year Level</option>
                  <option value="1st">1st Year</option>
                  <option value="2nd">2nd Year</option>
                  <option value="3rd">3rd Year</option>
                  <option value="4th">4th Year</option>
                  <option value="irreg">Irregular</option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col">
                <label for="">Email Address</label>
                <input type="email" name="ajvemail" class="form-control" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col">
                <label for="">Contact Number</label>
                <input type="text" name="ajvcontact" class="form-control">
              </div>
            </div>

            <div class="row mb-3">
                <label for="">Additional Information</label>
                <div class="col">
                    <textarea name="ajvaddinfo" class="form-control"></textarea>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col text-center">
                    <img src="" alt="" id="preview" width=200 height=200 class="img-thumbnail">
                    <input type="file" name="upload_img" class="form-control mt-2" onchange="previewimg(event)">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col text-center">
                    <input type="submit" name="sub" value="Register" class="btn btn-success w-75">
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
require_once "dbaseconnection.php";
require_once "verifyotpemail.php";

if (isset($_POST['sub'])) {
    $AJVfName = $_POST['ajvfname'];
    $AJVlName = $_POST['ajvlname'];
    $AJVstudNo = $_POST['ajvstudNo'];
    $AJVusername = $_POST['ajvusername'];
    $AJVpassword = md5($_POST['ajvpassword']); 
    $AJVbatch = $_POST['ajvbatch'];
    $AJVgender = $_POST['ajvgender'];
    $AJVbirthday = $_POST['ajvbday'];
    $AJVcourse = $_POST['ajvcourse'];
    $AJVyearLevel = $_POST['ajvyearlevel'];
    $AJVemail = $_POST['ajvemail'];
    $AJVcontact = $_POST['ajvcontact'];
    $AJVaddInf= $_POST['ajvaddinfo'];
    $AJVusertype = $_POST['ajvusertype'];
    $AJVfullname= $AJVfName." ".$AJVlName;

    $AJVimagepath = "imagesajv/".$_FILES["upload_img"]["name"];
    $AJVotp = rand(000000, 999999);
    
    if(!is_dir('imagesajv')){
        mkdir('imagesajv', 0777, true);
    }
    copy($_FILES["upload_img"]["tmp_name"], $AJVimagepath);

    $insertsql = "INSERT INTO tbl_userdetails_ajv (fname, lname, studNo, username, password, batch, gender, bday, course, yearlevel, email, contact, addinfo, img_pthajv, user_typeajv, otpajv, statusajv)
                  VALUES ('$AJVfName', '$AJVlName','$AJVstudNo','$AJVusername','$AJVpassword','$AJVbatch','$AJVgender','$AJVbirthday','$AJVcourse','$AJVyearLevel','$AJVemail','$AJVcontact','$AJVaddInf', '$AJVimagepath','$AJVusertype', '$AJVotp', 'Pending')";
    
    $result = $conn->query($insertsql);
    
    if ($result == TRUE) {
        send_verification($AJVfullname, $AJVemail, $AJVotp);
    ?>
    <script>
        // FIXED: Replaced invalid trailing semicolons with proper commas inside object properties
        Swal.fire({
            title: "Registered!",
            text: "Please verify your email",
            icon: "success",
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = "otpverification.php";
        });
    </script>    
    <?php    
    } else {
        echo "Database Error: " . $conn->error;
    }
}
?>
