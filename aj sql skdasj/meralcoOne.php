<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container shadow-lg p-5 my-5 rounded-2">
    <div class="row">
      <div class="col-md-4 bg-warning d-flex justify-content-center align-items-center p-5">
        <p class="display-1 text-center p-5">Meralco Form</p>
      </div>
      <div class="col">
        <form action="meralcoResult.php" method="POST">
            <div class="row p-3">
                <p class="">Customer Name</p>
                <div class="col">
                    <input type="text" name="Lname" class="form-control" />
                    <span for="" class="form-text">Last Name</label>
                </div>
                <div class="col">
                    <input type="text" name="Fname" class="form-control" />
                    <span for="" class="form-text">First Name</label>
                </div>
                <div class="col">
                    <input type="text" name="Mname" class="form-control" maxlength="1" />
                    <span for="" class="form-text">Middle Initial</label>
                </div>
            </div>
            <div class="row p-3">
                    <p class="">Address</p>
                <div class="col">
                    <input type="text" name="add1" class="form-control" />
                    <span for="" class="form-text">Building, Street, & Barangay</label>
                </div>
                <div class="col">
                    <input type="text" name="add2" class="form-control" />
                    <span for="" class="form-text">City</label>
                </div>
            </div>
            <div class="row p-3">
                <div class="col">
                    <input type="text" name="add3" class="form-control" />
                    <span for="" class="form-text">Province</label>
                </div>
                <div class="col">
                    <input type="text" name="add4" class="form-control" />
                    <span for="" class="form-text">Country</label>
                </div>
                <div class="col">
                    <input type="number" name="add5" class="form-control" />
                    <span for="" class="form-text">ZIP</label>
                </div>
            </div>
            <div class="row p-3">
                <p># of Kilowatts</p>
                <div class="col">
                    <input type="number" name="volts" id="" class="form-control">
                </div>
            </div>
            <div class="row p-3 gap-3">
                <div class="col bg-warning p-4 d-flex flex-column justify-content-center rounded-5">
                    <h3 class="text-white text-center">Subscription Type</h3>
                      <div class="form-check">
                        <input type="radio" name="subscription" value="Residential" id="" class="form-check-input">
                        <label for="" class="form-check-label text-white"> Residential (Php 2.75 per kW)</label>
                      </div>
                      <div class="form-check">
                        <input type="radio" name="subscription" value="Industrial" id="" class="form-check-input">
                        <label for="" class="form-check-label text-white"> Industrial (Php 3.75 per kW)</label>
                      </div>
                      <div class="form-check">
                        <input type="radio" name="subscription" value="Commercial" id="" class="form-check-input">
                        <label for="" class="form-check-label text-white"> Commercial (Php 4.25 per kW)</label>
                      </div>
                </div>
                <div class="col bg-warning p-4 d-flex flex-column justify-content-center rounded-5">
                    <h3 class="text-white text-center">Other Charges</h3>
                    <div class="form-check">
                        <input type="checkbox" name="disconnection" id="" class="form-check-input">
                        <label for="" class="form-check-label text-white">Disconnection (Php 500.00)</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="reconnection" id="" class="form-check-input">
                        <label for="" class="form-check-label text-white">Reconnection (Php 600.00)</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="latePayment" id="" class="form-check-input">
                        <label for="" class="form-check-label text-white">Late Payment (30% of the Energy Charge)</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="additionalElecMtr" id="" class="form-check-input">
                        <label for="" class="form-check-label text-white">Additional Electricity Meter (Php 750.00)</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="ElectMtrTrns" id="" class="form-check-input">
                        <label for="" class="form-check-label text-white">Electricity Meter Transfer (Php 1,500.00)</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <input type="submit" name="sub" value="Compute" class="btn btn-warning text-white w-75">
                </div>
            </div>
        </div>
         </div>
        </form>
      </div>
  </div>
</body>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>