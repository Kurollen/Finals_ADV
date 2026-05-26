<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container my-5 bg-dark p-5 w-50 text-white">
        <form action="discussion3.php" method="post">
            <div class="row">
                <div class="col">
                    <label for="" class="form-label"> First Number</label>
                    <input type="text" name="first" id="" class="form-control">
                </div>      
            </div>
            <div class="row">
                <div class="col">
                    <label for="" class="form-label"> Second Number</label>
                    <input type="text" name="second" id="" class="form-control">
                </div>      
            </div>
            <div class="row">
                <div class="col">
                    <label for="" class="form-label"> Age</label>
                    <input type="text" name="age" id="" class="form-control">
                </div>      
            </div>
            <div class="row mt-2">
                <div class="col">
                    <label for="" class="form-label"> Food</label>
                    <div class="form-check">
                        <input type="checkbox" name="pizza" class="form-check-input">
                        <label for="" class="form-check-label">Pizza (350)</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="ice_cream" class="form-check-input">
                        <label for="" class="form-check-label">Ice Cream (90)</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="fried_chicken" class="form-check-input">
                        <label for="" class="form-check-label">Fried Chicken (100)</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="fries" class="form-check-input">
                        <label for="" class="form-check-label">Fries (75)</label>
                    </div>
                </div>      
            </div>
            <div class="row">
                <div class="col">
                    <label for="">Coke Drinks</label>
                    <div class="form-check">
                        <input type="radio" name="drinks" value="Small" class="form-check-input">
                        <label for="" class="form-check-label">Small (P 5)</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="drinks" value="Medium" class="form-check-input">
                        <label for="" class="form-check-label">Medium (P 10)</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="drinks" value="Large" class="form-check-input">
                        <label for="" class="form-check-label">Large (P 15)</label>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col text-center">
                    <input type="submit" name="sub" value="Save" class="btn btn-danger w-75">
                </div>
            </div>
        </form>


        <?php
        
        if (isset($_POST['sub'])) {
        
        //variables
        $first = $_POST['first'];
        $second = $_POST['second'];
        $age = $_POST['age'];
        $valid = "";
        $foodname = "";
        $totalprice = 0;
        $drinks = $_POST['drinks'];

        //computation and conditions
        $sum = $first + $second;
        $ave = ($first + $second)/2;
        
        if ($age > 18) {
            
            $valid = "Valid to vote";
        }else {
            $valid = "NOT Valid to vote";
        }
        
        //pizza
        if (isset($_POST['pizza'])) {
            $price = 350;
            $foodname = "Pizza - P".$price."<br>";
            $totalprice += $price;
        } else {
            $foodname = NULL;
            $price = 0;
        }
        if (isset($_POST['ice_cream'])) {
            $price1 = 90;
            $foodname1 = "Ice Cream - P".$price1."<br>";
            $totalprice += $price1;
            
        } else {
            $foodname1 = NULL;
            $price1 = 0;
        }
        if (isset($_POST['fried_chicken'])) {
            $price2 = 100;
            $foodname2 = "Fried Chicken - P".$price2."<br>";
            $totalprice += $price2;
        } else {
            $foodname2 = NULL;
            $price2 = 0;
        }
        if (isset($_POST['fries'])) {
            $price3 = 70;
            $foodname3 = "Fries - P".$price3."<br>";
            $totalprice += $price3;
        } else {
            $foodname3 = NULL;
            $price3 = 0;
        }

        //drinks
        if ($drinks == "Small") {
            $drinks_price = 5;
            $totalprice += $drinks_price;
        }
        elseif ($drinks == "Medium") {
            $drinks_price = 10;
            $totalprice += $drinks_price;

        }
         elseif ($drinks == "Large") {
            $drinks_price = 15;
            $totalprice += $drinks_price;

         } 
         else {
            $drinks_price = 0;
        }
        

        
        
        //print
        echo "<br>First number: ".$first;
        echo "<br>Second: ".$second;
        echo "<br>Sum: ".$sum;
        echo "<br>Average: ".$ave;
        echo "<br>$valid";         
        echo "<br>Order/s: ".$foodname.$foodname1.$foodname2.$foodname3;
        echo "<br>Drinks: ".$drinks;
        echo "<br>Total: ".$totalprice;
        
        }
        


        ?>
         
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>