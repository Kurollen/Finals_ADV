<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="bg-success">
<?php
// btn function
if(isset($_POST['sub'])){

$AJVfName = $_POST['ajvfname'];
$AJVlName = $_POST['ajvlname'];
$AJVstudNo = $_POST['ajvstudNo'];
$AJVgender = $_POST['ajvgender'];
$AJVbirthday = $_POST['ajvbday'];
$AJVcourse = $_POST['ajvcourse'];
$AJVyearLevel = $_POST['ajvyearlevel'];
$AJVemail = $_POST['ajvemail'];
$AJVcontact = $_POST['ajvcontact'];
$AJVaddInf= $_POST['ajvaddinfo'];


echo "<div class='w-25 m-auto justify-content-center rounded-5 mt-5 p-3 bg-dark border border-1 border-dark text-center'> ";
echo "<h1 class='text-white'>Student Form</h1>";
echo "<p class='text-white'>Thank you for registering</p>";
echo "<hr class='text-white' />";
echo "<p class='text-white'>Full Name: {$AJVfName} {$AJVlName}\n</p>";
echo "<p class='text-white'>Student No. {$AJVstudNo}\n</p>";
echo "<p class='text-white'>Gender: {$AJVgender}\n</p>";
echo "<p class='text-white'>Birthday: {$AJVbirthday}\n</p>";
echo "<p class='text-white'>Course: {$AJVcourse}\n</p>";
echo "<p class='text-white'>Year: {$AJVyearLevel}\n</p>";
echo "<p class='text-white'>Email: {$AJVemail}\n</p>";
echo "<p class='text-white'>Phone Number: {$AJVcontact}\n</p>";
echo "<p class='text-white'>Additional Information: {$AJVaddInf}\n</p>";
echo "<a href='forms.php' class='btn btn-primary'>Back to Forms</a>";
echo "</div>";
}
?>
</body>
</html>