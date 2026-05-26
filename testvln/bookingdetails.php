<?php

require "array.php";

function formatText($text){
    return ucwords(strtolower(trim($text)));
}

function getAdditionalFee($participants){
    if($participants > 10){
        return ($participants - 10) * 50;
    }
    else{
        return 0;
    }
}

function getTotalAmount($tourPrice, $extraFee){
    return $tourPrice + $extraFee;
}

if(isset($_POST['sub'])){

    $AJVfullname = formatText($_POST['fullname']);
    $AJVaddress = formatText($_POST['address']);
    $AJVemail = $_POST['email'];
    $AJVcontact = $_POST['contact'];

    $AJVtourIndex = $_POST['tour'];

    $AJVtourName = $AJVtourNames[$AJVtourIndex];
    $AJVduration = $AJVtourDuration[$AJVtourIndex];
    $AJVdescription = $AJVtourDescription[$AJVtourIndex];
    $AJVprice = $AJVtourPrice[$AJVtourIndex];

    $AJVdate = date_create($_POST['date']);
    $AJVparticipants = $_POST['participants'];
    $AJVspecial = $_POST['special'];

    $AJVextraFee = getAdditionalFee($AJVparticipants);
    $AJVtotalAmount = getTotalAmount($AJVprice, $AJVextraFee);
}

?>

<!doctype html>
<html lang="en">
<head>
    <title>Booking Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container bg-primary text-white p-5 mt-4">

    <h2 class="text-center">Booking Confirmation</h2>

    <div class="row mt-4">

        <!-- Basic Information -->
        <div class="col-md-6 bg-white text-dark p-3">
            <h4>Basic Information</h4>

            <p><b>Full Name:</b> <?php echo $AJVfullname ?></p>
            <p><b>Address:</b> <?php echo $AJVaddress ?></p>
            <p><b>Contact Number:</b> <?php echo $AJVcontact ?></p>
            <p><b>Email:</b> <?php echo $AJVemail ?></p>
        </div>

        <!-- Tour Details -->
        <div class="col-md-6 bg-white text-dark p-3">
            <h4>Tour Details</h4>

            <p><b>Tour:</b> <?php echo $AJVtourName ?></p>
            <p><b>Duration:</b> <?php echo $AJVduration ?></p>
            <p><b>Description:</b> <?php echo $AJVdescription ?></p>
            <p><b>Date:</b> <?php echo date_format($AJVdate,"F d, Y - l") ?></p>
            <p><b>Number of Participants:</b> <?php echo $AJVparticipants ?></p>
            <p><b>Special Request:</b> <?php echo $AJVspecial ?></p>
            <p><b>Tour Price:</b> ₱<?php echo number_format($AJVprice,2) ?></p>
            <p><b>Extra Fee:</b> ₱<?php echo number_format($AJVextraFee,2) ?></p>

            <h4 class="text-primary">
                Total Price: ₱<?php echo number_format($AJVtotalAmount,2) ?>
            </h4>
        </div>

    </div>

</div>

</body>
</html>
