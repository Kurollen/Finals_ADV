<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Reservation Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body class = "bg-light">
    <div class="container shadow-lg bg-dark p-5 w-75 my-3 text-white">
        <form action="output.php" method="post">
            <div class="col mb-3 p-5 bg-info align-items-center text-center text-white">
                <h1>Hotel Reservation Form</h1>
                <p>Fill up this form to reserve</p>
            </div>

            <h4 class="text-info">Guest Information</h4>
            <div class="row my-3">
                <label for="">Fullname</label>
                <div class="col">
                    <input type="text" name="fname" class="form-control" placeholder="Firstname">
                </div>
                <div class="col">
                    <input type="text" name="lname" class="form-control" placeholder="Lastname" >
                </div>
            </div>

            <div class="row mb-3">
                <label for="">Email Address</label>
                <div class="col">
                    <input type="text" name="email" class="form-control" placeholder="Email">
                </div>
            </div>

            <div class="row mb-3">
                <label for="">Contact Number</label>
                <div class="col">
                    <input type="number" name="number" class="form-control" placeholder="ex. 0932484301223">
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="">Address</label>
                <div class="col">
                    <input type="text" name="addy" class="form-control" placeholder="Street, City, Province, Country">
                </div>
            </div>

            <h4 class="text-info">Room Reservation</h4>
            <div class="row mb-3">
                <label for="">Check-in Date</label>
                <div class="col">
                    <input type="datetime-local" name="date" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <label for="">Room Preferences</label>
                <div class="col mx-5">
                    <div class="form-check-inline">
                        <input type="radio" name="room" value="Standard" class="form-check-input">
                        <label for="">Standard(P1500.00)</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check-inline">
                        <input type="radio" name="room" value="Deluxe" class="form-check-input">
                        <label for="">Deluxe(P3000.00)</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-chceck-inline">



                        <input type="radio" name="room" value="Suite" class="form-check-input">
                        <label for="">Suite(P4500.00)</label>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="">No. of Days</label>
                <div class="col">
                    <input type="number" name="numdays" class="form-control">
                </div>
            </div>

            <div class="row my-3">
                <label for="">Number of Guest</label>
                <div class="col">
                    <label for="">Adult</label>
                    <input type="number" name="adult" class="form-control" placeholder="Max: 3">
                </div>
                <div class="col">
                    <label for="">Children</label>
                    <input type="number" name="child" class="form-control" placeholder="Max: 2" >
                </div>
            </div>

            <div class="row mb-3">
                <label for="">Additional number of Guests</label>
                <div class="col">
                    <input type="number" value="0" name="addguest" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <label for="">Special Request</label>
                <div class="col">
                    <textarea name="special" id="" class="form-control"></textarea>
                </div>
            </div>
            

            <div class="row mt-3">
                <div class="col text-center">
                    <input type="submit" name="sub" class="btn btn-info w-75 text-white">
                </div>
            </div>

            <div class="col mt-3 p-3 bg-info align-items-center text-center text-white">
                <h3>@ajv2026</h3>
            </div>




        </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>