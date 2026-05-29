<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="bg-secondary">
<?php
// btn function
if(isset($_POST['sub'])){

$TGfullName = $_POST['Fname']. ' ' . $_POST['Lname'] ?? ''; /* to prevent error if user first visit page*/
$TGstudNo = $_POST['studNo'] ?? '';
$TGgender = $_POST['gender'] ?? '';
$TGbirthday = $_POST['bday'] ?? '';
$TGcourse = $_POST['course'] ?? '';
$TGyearLevel = $_POST['year'] ?? '';
$TGemail = $_POST['email'] ?? '';
$TGcontactNum = $_POST['conNo'] ?? '';
$TGaddInf= $_POST['comment'] ?? '';


echo "<div class='w-25 m-auto justify-content-center bg-dark p-4 shadow-lg rounded-5 mt-5  border border-1 border-dark-subtle text-center'> ";
echo "<h1 class='text-white'>Student Form</h1>";
echo "<p class='text-white'>Thank you for registering.</p>";
echo "<hr class='text-white' />";
echo "<p class='text-white'>Full Name: {$TGfullName}\n</p>";
echo "<p class='text-white'>Student No. {$TGstudNo}\n</p>";
echo "<p class='text-white'>Gender: {$TGgender}\n</p>";
echo "<p class='text-white'>Birthday: {$TGbirthday}\n</p>";
echo "<p class='text-white'>Course: {$TGcourse}\n</p>";
echo "<p class='text-white'>Year: {$TGyearLevel}\n</p>";
echo "<p class='text-white'>Email: {$TGemail}\n</p>";
echo "<p class='text-white'>Phone Number: {$TGcontactNum}\n</p>";
echo "<p class='text-white'>Additional Information: {$TGaddInf}\n</p>";
echo "<a href='three.php' class='btn btn-primary'>Back to Forms</a>";
echo "</div>";
}
?>
</body>
</html>