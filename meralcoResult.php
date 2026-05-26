<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>


    <?php
    
    if(isset($_POST["sub"])){
        $TGlastName = $_POST["Lname"] ?? '';
        $TGfirstName = $_POST["Fname"] ?? '';
        $TGmiddleInitial = $_POST["Mname"] ?? '';

        $TGAddressOne = $_POST['add1'] ?? '';
        $TGAddressTwo = $_POST['add2'] ?? '';
        $TGAddressThree = $_POST['add3'] ?? '';
        $TGAddressFour = $_POST['add4'] ?? '';
        $TGAddressFive = $_POST['add5'] ?? '';
        

        $TGfullName = $TGlastName  . ", " . $TGfirstName . " " .$TGmiddleInitial.".";
        $TGfullAddress = $TGAddressOne . ", ".$TGAddressTwo .", ". $TGAddressThree . ", ".$TGAddressFour. ', ' . $TGAddressFive ?? '';

        $TGkilowatts = $_POST['volts'] ?? 0;
        $TGsubscription = $_POST['subscription'] ?? '';
        
        $TGotherChargeTotal = 0;
        $TGsubRate = 0;
        $TGenergyCharge = 0;
        $TGtotalBill = 0;
    }
    
    ?>

<div class="container shadow-lg p-5 mt-3 rounded-2">
    <div class="row">
      <div class="col-md-4 bg-warning d-flex justify-content-center align-items-center p-5">
        <p class="display-1 text-center p-5">Meralco Billing Receipt</p>
      </div>
      <div class="col p-5">
        <p class="fw-bold">Customer Billing Details</p>
        <div class="row border-bottom border-secondary-emphasis p-2">
            <div class="col">
                <span>Customer Name: </span>
            </div>
            <div class="col">
                <?php echo '<span class="fw-bold">'.$TGfullName.'</span>'; ?>
            </div>
        </div>
        <div class="row border-bottom border-secondary-emphasis bg-dark-subtle p-2">
            <div class="col">
                <span>Address: </span>
            </div>
            <div class="col">
                <?php echo '<span class="fw-bold">'.$TGfullAddress.'</span>'; ?>
            </div>
        </div>
        <div class="row border-bottom border-secondary-emphasis p-2">
            <div class="col">
                <span>No. of Kilowatts: </span>
            </div>
            <div class="col">
                <?php echo '<span class="fw-bold">'.$TGkilowatts.' kW</span>'; ?>
            </div>
        </div>
        <div class="row bg-dark-subtle p-2">
            <div class="col">
                <span>Subscription Type: </span>
            </div>
            <div class="col">
                <?php echo '<span class="fw-bold">'.$TGsubscription.'</span>'; ?>
            </div>
        </div>
        <div class="row border-bottom border-secondary-emphasis p-2">
            <div class="col">
                <span>Rate of Subscription: </span>
            </div>
            <div class="col">
                <?php 
                 
                switch($TGsubscription){
                    case "Residential":
                        $TGsubRate = 2.75;
                        break;
                    case "Industrial":
                        $TGsubRate = 3.75;
                        break;
                    case "Commercial":
                        $TGsubRate = 4.25;
                        break;
                }
                echo '<span class="fw-bold">'.$TGsubRate.'</span>'; ?>
            </div>
        </div>
        <div class="row border-bottom border-secondary-emphasis bg-dark-subtle p-2">
            <div class="col">
                <span>Energy Charge: </span>
            </div>
            <div class="col">
                <?php 
                 $TGenergyCharge = $TGsubRate * $TGkilowatts ?? 0;
                echo '<span class="fw-bold">'.$TGenergyCharge.' PHP</span>'; ?>
            </div>
        </div>
        <div class="row border-bottom border-secondary-emphasis p-2">
            <div class="col">
                <span>Other Charge/s: </span>
            </div>
            <div class="col">
                <?php 
                if(isset($_POST['disconnection'])){
                    $TGotherChargeTotal += 500.00;
                ?>

                <span>Disconnection (Php 500.00)</span><br>
                
                <?php }else{
                    $TGotherChargeTotal += 0;
                } ?>
                <?php 
                if(isset($_POST['reconnection'])){
                    $TGotherChargeTotal += 600.00;
                ?>

                <span>Reconnection (Php 600.00)</span><br>
                
                <?php }else{
                     $TGotherChargeTotal += 0;
                }  ?>
                <?php 
                if(isset($_POST['latePayment'])){
                    $TGthirtyOfEnergy = $TGenergyCharge * 0.30;
                    $TGotherChargeTotal += $TGthirtyOfEnergy;
                ?>

                <span>Late Payment 
                
                <?php echo "(Php".$TGthirtyOfEnergy.")</span><br>"; }
                else{
                     $TGotherChargeTotal += 0;
                } ?>
                
                <?php 
                if(isset($_POST['additionalElecMtr'])){
                    $TGotherChargeTotal += 750.00;
                ?>

                <span>Additional Electricity Meter (Php 750.00)</span><br>
                
                <?php } else{
                     $TGotherChargeTotal += 0;
                }  ?>

                <?php 
                if(isset($_POST['ElectMtrTrns'])){
                    $TGotherChargeTotal += 1500.00;
                ?>

                <span>Electricity Meter Transfer (Php 1,500.00)</span><br>
                
                <?php }else{
                    $TGotherChargeTotal += 0;
                }  ?>

            </div>
        </div>
        <div class="row border-bottom border-secondary-emphasis bg-dark-subtle p-2">
            <div class="col">
                <span>Total Other Charge/s Fee: </span>
            </div>
            <div class="col">
                <?php 
                echo '<span class="fw-bold">'.$TGotherChargeTotal.' PHP</span>'; ?>
            </div>
        </div>
        <div class="row border-bottom border-secondary-emphasis p-2">
            <div class="col">
                <span>TOTAL ELECTRIC BILL: </span>
            </div>
            <div class="col fw-bold">
                <?php 
                $TGtotalBill = $TGotherChargeTotal + $TGenergyCharge;
                echo '<span>'.$TGtotalBill.' PHP</span>'; ?>
            </div>
        </div>
        <div class="row">
            <a href="meralcoOne.php" class="btn btn-warning mt-2">Back to Form</a>
        </div>
      </div>
    </div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>