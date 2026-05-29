<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container p-5 mt-3 rounded-2">
    <div class="row ">
      <div class="col-md-4 bg-warning d-flex justify-content-center align-items-center text-white">
          <h1 class="text-center">Meralco Billing Form</h1>
    </div>
    <div class="col p-5  bg-light">
        <form action="meralcoFormsOutput.php" method="post">
            <div class="row">
              <p>Customer Name</p>
                <div class="col">
                    <input type="text" name="lname" class="form-control">
                    <span for="" class="form-text">Last Name</label>
                </div>
                <div class="col">
                    <input type="text" name="fname" class="form-control">
                    <span for="" class="form-text">Firstname</label>
                </div>
                <div class="col-2">
                    <input type="text" name="midint" class="form-control">
                    <span for="" class="form-text">Middle Initial</label>
                </div>
            </div>


            <div class="row mt-3">
              <p>Address</p>
                <div class="col-7">
                  <input type="text" name="buildingetc" class="form-control">
                  <span for="" class="form-text">Building number, Street, and Barangay</label>
                </div>
                <div class="col">
                  <input type="text" name="city" class="form-control">
                  <span for="" class="form-text">City</label>
                </div>
            </div>


            <div class="row mt-3">
              <div class="col">
                <input type="text" name="province" class="form-control">
                <span for="" class="form-text">Province</label>
              </div>
              <div class="col">
                <input type="text" name="country" class="form-control">
                <span for="" class="form-text">Country</label>
              </div>
              <div class="col-2">
                <input type="text" name="zip" class="form-control">
                <span for="" class="form-text">ZIP</label>
              </div>
            </div>


            <div class="row mt-3">
              <p>No. of Kilowatts</p>
                <div class="col">
                  <input type="number" name="kilowatts" class="form-control">
                </div>
            </div>


            <div class="row mt-3">
              <div class="col-5 mx-3 bg-warning rounded align-items-center text-white">
                <h4 class="text-center mt-2">Subscription Type</h4>
                <div class="row">
                  <div class="col">
                    <input type="radio" name="subscription" value="Residential" class="form-check-input">
                    <label for="">Residential (Php 2.75 per KW)</label>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col">
                    <input type="radio" name="subscription" value="Industrial" class="form-check-input">
                    <label for="">Industrial (Php 3.75 per KW)</label>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col">
                    <input type="radio" name="subscription" value="Commercial"class="form-check-input">
                    <label for="">Commercial (Php 4.25 per KW)</label>
                  </div>
                </div>
              </div>
                
                <h4 class="text-center mt-2">Other Charges</h4>
                <div class="row">
                  <div class="col">
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" name="disconnection" id="">
                        <label for="" class="form-check-label">Disconnection(Php 500.00)</label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" name="reconnection" id="">
                        <label for="" class="form-check-label">Reconnection(Php 600.00)</label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" name="latecharge" id="">
                        <label for="" class="form-check-label">Late Payment(30% of the Energy Charge)</label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" name="additional" id="">
                        <label for="" class="form-check-label">Additional Electricity Meter(Php 750.00)</label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" name="transfer" id="">
                        <label for="" class="form-check-label">Electricity Meter Transfer(Php 1,500.00)</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-3">
                <div class="col text-center">
                    <input type="submit" name="sub" value="Compute" class="text-white btn btn-warning w-50">
                </div>
            </div>

        </form>
    </div>
  </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
