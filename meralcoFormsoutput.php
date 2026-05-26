<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Output</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    
    <?php
    
    if(isset($_POST["sub"])){
        $ajvlastName = $_POST["lname"];
        $ajvfirstName = $_POST["fname"];
        $ajvmiddleInitial = $_POST["midint"];

        $ajvAddressOne = $_POST['buildingetc'];
        $ajvAddressTwo = $_POST['city'];
        $ajvAddressThree = $_POST['province'];
        $ajvAddressFour = $_POST['country'];
        $ajvAddressFive = $_POST['zip'];
        

        $ajvfullName = $ajvlastName  . ", " . $ajvfirstName . " " .$ajvmiddleInitial.".";
        $ajvfullAddress = $ajvAddressOne . ", ".$ajvAddressTwo .", ". $ajvAddressThree . ", ".$ajvAddressFour. ', ' . $ajvAddressFive;

        $ajvkilowatts = $_POST['kilowatts'];
        $ajvsubscription = $_POST['subscription'];
        
        $ajvotherChargeTotal = 0;
        $ajvsubRate = 0;
        $ajvenergyCharge = 0;
        $ajvtotalBill = 0;
    }
    
    ?>

<div class="container p-5 mt-3 rounded-2">
    <div class="row">
      <div class="col-md-4 bg-warning d-flex justify-content-center align-items-center text-white">
        <h1 class="text-center">Meralco Billing Receipt</h1>
      </div>
      <div class="col p-5 bg-light">
        <p class="fw-bold">Customer Billing Details</p>
        <div class="row border-bottom border-secondary-emphasis p-2">
            <div class="col">
                <span>Customer Name: </span>
            </div>
            <div class="col">
                <?php echo '<span class="fw-bold">'.$ajvfullName.'</span>'; ?>
            </div>
        </div>
        <div class="row border-bottom border-secondary-emphasis bg-dark-subtle p-2">
            <div class="col">
                <span>Address: </span>
            </div>
            <div class="col">
                <?php echo '<span class="fw-bold">'.$ajvfullAddress.'</span>'; ?>
            </div>
        </div>
        <div class="row border-bottom border-secondary-emphasis p-2">
            <div class="col">
                <span>No. of Kilowatts: </span>
            </div>
            <div class="col">
                <?php echo '<span class="fw-bold">'.$ajvkilowatts.' kW</span>'; ?>
            </div>
        </div>
        <div class="row bg-dark-subtle p-2">
            <div class="col">
                <span>Subscription Type: </span>
            </div>
            <div class="col">
                <?php echo '<span class="fw-bold">'.$ajvsubscription.'</span>'; ?>
            </div>
        </div>
        <div class="row border-bottom border-secondary-emphasis p-2">
            <div class="col">
                <span>Rate of Subscription: </span>
            </div>
            <div class="col">
                <?php 
                 
                switch($ajvsubscription){
                    case "Residential":
                        $ajvsubRate = 2.75;
                        break;
                    case "Industrial":
                        $ajvsubRate = 3.75;
                        break;
                    case "Commercial":
                        $ajvsubRate = 4.25;
                        break;
                }
                echo '<span class="fw-bold">'.$ajvsubRate.'</span>'; ?>
            </div>
        </div>
        <div class="row border-bottom border-secondary-emphasis bg-dark-subtle p-2">
            <div class="col">
                <span>Energy Charge: </span>
            </div>
            <div class="col">
                <?php 
                 $ajvenergyCharge = $ajvsubRate * $ajvkilowatts;
                echo '<span class="fw-bold">'.$ajvenergyCharge.' PHP</span>'; ?>
            </div>
        </div>
        <div class="row border-bottom border-secondary-emphasis p-2">
            <div class="col">
                <span>Other Charge/s: </span>
            </div>
            <div class="col">
                <?php 
                if(isset($_POST['disconnection'])){
                    $ajvotherChargeTotal += 500.00;
                ?>

                <span>Disconnection (Php 500.00)</span><br>
                
                <?php }else{
                    $ajvotherChargeTotal += 0;
                } ?>
                <?php 
                if(isset($_POST['reconnection'])){
                    $ajvotherChargeTotal += 600.00;
                ?>

                <span>Reconnection (Php 600.00)</span><br>
                
                <?php }else{
                     $ajvotherChargeTotal += 0;
                }  ?>
                <?php 
                if(isset($_POST['latecharge'])){
                    $ajvthirtyOfEnergy = $ajvenergyCharge * 0.30;
                    $ajvotherChargeTotal += $ajvthirtyOfEnergy;
                ?>

                <span>Late Payment 
                
                <?php echo "(Php ".$ajvthirtyOfEnergy.")</span><br>"; }
                else{
                     $ajvotherChargeTotal += 0;
                } ?>
                
                <?php 
                if(isset($_POST['additional'])){
                    $ajvotherChargeTotal += 750.00;
                ?>

                <span>Additional Electricity Meter (Php 750.00)</span><br>
                
                <?php } else{
                     $ajvotherChargeTotal += 0;
                }  ?>

                <?php 
                if(isset($_POST['transfer'])){
                    $ajvotherChargeTotal += 1500.00;
                ?>

                <span>Electricity Meter Transfer (Php 1,500.00)</span><br>
                
                <?php }else{
                    $ajvotherChargeTotal += 0;
                }  ?>

            </div>
        </div>
        <div class="row border-bottom border-secondary-emphasis bg-dark-subtle p-2">
            <div class="col">
                <span>Total Other Charge/s Fee: </span>
            </div>
            <div class="col">
                <?php 
                echo '<span class="fw-bold">'.$ajvotherChargeTotal.' PHP</span>'; ?>
            </div>
        </div>
        <div class="row border-bottom border-secondary-emphasis p-2">
            <div class="col">
                <span>TOTAL ELECTRIC BILL: </span>
            </div>
            <div class="col fw-bold">
                <?php 
                $ajvtotalBill = $ajvotherChargeTotal + $ajvenergyCharge;
                echo '<span>'.$ajvtotalBill.' PHP</span>'; ?>
            </div>
        </div>
      </div>
    </div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>