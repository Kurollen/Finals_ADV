<?php
include "array.php";
?>

<!doctype html>
<html lang="en">
<head>
    <title>Tour Booking Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-4">

    <div class="row">

        <!-- Booking Form -->
        <div class="col-md-6 bg-primary text-white p-4">
            <h3 class="text-center">Booking Info</h3>

            <form action="bookingdetails.php" method="POST">

                <label>Full Name</label>
                <input type="text" name="fullname" class="form-control mb-2">

                <label>Address</label>
                <input type="text" name="address" class="form-control mb-2">

                <label>Email</label>
                <input type="email" name="email" class="form-control mb-2">

                <label>Contact Number</label>
                <input type="text" name="contact" class="form-control mb-2">

                <label>Select Tour</label>
                <select name="tour" class="form-control mb-2">
                    <option selected>Select your tour</option>
                    <?php
                    foreach($AJVtourNames as $index => $tour){
                    ?>
                        <option value="<?php echo $index ?>">
                            <?php echo $tour ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>

                <label>Date</label>
                <input type="date" name="date" class="form-control mb-2">

                <label>Number of Participants</label>
                <input type="number" name="participants" class="form-control mb-2">

                <label>Special Request</label>
                <input type="text" name="special" class="form-control mb-2">

                <button type="submit" name="sub" class="btn btn-light w-100">
                    Book Now
                </button>

            </form>
        </div>

        <!-- Tour Details -->
        <div class="col-md-6 bg-dark text-white p-4">
            <h3 class="text-center">Tour Details</h3>

            <?php
            foreach($AJVtourNames as $index => $tour){
            ?>
                <h5><?php echo $tour ?></h5>
                <p>Duration: <?php echo $AJVtourDuration[$index] ?></p>
                <p>Description: <?php echo $AJVtourDescription[$index] ?></p>
                <p>Price: ₱<?php echo number_format($AJVtourPrice[$index],2) ?></p>
                <hr>
            <?php
            }
            ?>
        </div>

    </div>

</div>

</body>
</html>
