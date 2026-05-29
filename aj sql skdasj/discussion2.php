<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Discussion 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <h1><?php echo "Hello World";?></h1>
    <p class=" display-1"> <b><?php echo "Hello World!"; ?></b></p>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

<?php
// set variables
$array = array(28.90, 25, 27, 29);
$FirstName = "Andre Justin";
$LastName = "Valenzuela";
$MiddleInitial = "A.";

// print numerical array
echo $array[1];
echo "<br>";

//concatenate
echo "First name: ".$FirstName;
echo "<br>";
echo "Full Name (Last Name first): ".$LastName.", ".$FirstName." ".$MiddleInitial;
echo "<br>";
echo "Full Name: ".$FirstName." ".$MiddleInitial." ".$LastName;
echo "<br>";

// see what the var has
var_dump($array); 
echo "<br>";
var_dump($FirstName);




?>
