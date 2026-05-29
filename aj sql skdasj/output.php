<?php

    include "functions.php";
    if (isset($_POST['sub'])) {
    $AJVfname = formatText($_POST['fname']);
    $AJVlname = formatText($_POST['lname']);
    $AJVemail = $_POST['email'];
    $AJVnum = $_POST['number'];
    $AJVaddy = formatText($_POST['addy']);
    $AJVdate = date_create($_POST['date']);
    $AJVadultguest = $_POST['adult'];
    $AJVchildguest = $_POST['child'];
    $AJVaddguest = $_POST['addguest'];
    $AJVnumdays = $_POST['numdays'];

    $AJVroom = $_POST['room'];
    $AJVroomType = $_POST['room'];
    $AJVroomPrice = getRoomPrice($AJVroom);


    $AJVtotalguests = getTotalGuests($AJVadultguest, $AJVchildguest, $AJVaddguest);
    $AJVtotalRoomPrice = getTotalRoomPrice($AJVroomPrice, $AJVnumdays);
    $AJVaddFee = getAdditionalFee($AJVaddguest);
    $AJVtotalAmount = getTotalAmount($AJVtotalRoomPrice, $AJVaddFee);

    $AJVspecialreq = $_POST['special'];

    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Reservation Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body class = "bg-light">
    <div class='container shadow-lg bg-dark p-5 w-75 my-3 text-white'>
        <div class='col mb-3 p-5 bg-info align-items-center text-center text-white'>
            <h1>Hotel Reservation Details</h1>
        </div>
        <h4 class='text-info'>Guest Details</h4> <hr>
        <div class="row">
            <div class="col">Guest Name: </div>
            <div class="col"><?php echo $AJVfname, " ",$AJVlname?></div>
        </div>
        <hr>
        <div class="row">
            <div class="col">Email: </div>
            <div class="col"><?php echo $AJVemail?></div>
        </div>
        <hr>
        <div class="row">
            <div class="col">Number:</div>
            <div class="col"><?php echo $AJVnum?></div>
        </div>
        <hr>
        <div class="row">
            <div class="col">Address:</div>
            <div class="col"><?php echo $AJVaddy?></div>
        </div>
        <br>
        <h4 class='text-info'>Room Reservation Details</h4> <hr>
        <div class="row">
            <div class="col">Check-in Date:</div>
            <div class="col"><?php echo date_format(object: $AJVdate, format: "l, F j, Y g:i:A")?></div>
        </div>
        <hr>
        <div class="row">
            <div class="col">No. of Guest:</div>
            <div class="col">
                <div class="col"><b><?php echo $AJVtotalguests?></b></div>
                <div class="col"><?php echo "Adults: ", $AJVadultguest?></div>
                <div class="col"><?php echo "Children: ", $AJVchildguest?></div>
                <div class="col"><?php echo "Additional guest: ", $AJVaddguest?></div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col"><b>Special Request:</b></div>
            <div class="col"><?php echo $AJVspecialreq?></div>
        </div>
        <hr>

        <div class="row">
            <div class="col"><b>Room Type:</b></div>
            <div class="col"><?php echo $AJVroomType?></div>
        </div>
        <hr>
        <div class="row">
            <div class="col"><b>Room Price:</b></div>
            <div class="col"><?php echo "P", number_format($AJVroomPrice,2)?></div>
        </div>
        <hr>
        <div class="row">
            <div class="col"><b>No. of Days:</b></div>
            <div class="col"><?php echo $AJVnumdays," day/s"?></div>
        </div>
        <hr>
        <div class="row">
            <div class="col"><b>Total Room Price:</b></div>
            <div class="col"><?php echo "P",number_format($AJVtotalRoomPrice,2)?></div>
        </div>
        <hr>
        <div class="row">
            <div class="col"><b>Additional Guest Fee:</b></div>
            <div class="col"><?php echo "P",number_format($AJVaddFee,2)?></div>
        </div>
        <hr>
        <div class="row">
            <div class="col"><b>Total Amount:</b></div>
            <div class="col text-success"><?php echo "P",number_format($AJVtotalAmount,2)?></div>
        </div>
        <hr>
    </div>
    
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>