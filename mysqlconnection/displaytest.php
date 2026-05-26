<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container p-5 bg-light">
    <form action="displaytest.php" method="post">
        <div class="row g-3">
            <div class="col">
                <input type="search" name="searchinput" placeholder="Search" class="form-control">
            </div>
            <div class="col">
                <input type="submit" name="btnsearch" value="Search" class="btn btn-primary">
            </div>
        </div>
    </form>

<?php

require_once "dbaseconnection.php";

if (isset($_POST["btnsearch"])) {
    //search user input
    $searchinput = $_POST["searchinput"];

    if ($searchinput != NULL) {
        $displaysql = "SELECT * FROM tbl_userdetails_ajv 
               WHERE lname LIKE '%".$searchinput."%'
               OR userid LIKE '%".$searchinput."%'
               OR fname LIKE '%".$searchinput."%'
               OR studNo LIKE '%".$searchinput."%'
               OR batch LIKE '%".$searchinput."%'
               OR gender LIKE '%".$searchinput."%'
               OR bday LIKE '%".$searchinput."%'
               OR course LIKE '%".$searchinput."%'
               OR yearlevel LIKE '%".$searchinput."%'
               OR email LIKE '%".$searchinput."%'
               OR contact LIKE '%".$searchinput."%'
               OR addinfo LIKE '%".$searchinput."%'";

    } else {
        $displaysql = "select * from tbl_userdetails_ajv";
            }
    
} else {
    //string query 
    $displaysql = "select * from tbl_userdetails_ajv";
}

//converts string query to an actual query then transfer it to mysql
$result = $conn->query($displaysql);

//check if the table is empty  or not
if ($result->num_rows > 0) {
?>
    <table class="table table-primary">
        <!-- field names -->
        <tr>
            <th>User ID</th>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Student No.</th>
            <th>Batch</th>
            <th>Gender</th>
            <th>Birthday</th>
            <th>Course</th>
            <th>Year Level</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Add Info</th>
            <th>Image</th>
        </tr>
    

<?php
        //display record for each field
        foreach ($result as $fieldname) {
            echo "<tr>";
            echo "<td>".$fieldname['userid']."</td>";
            echo "<td>".$fieldname['lname']."</td>";
            echo "<td>".$fieldname['fname']."</td>";
            echo "<td>".$fieldname['studNo']."</td>";
            echo "<td>".$fieldname['batch']."</td>";
            echo "<td>".$fieldname['gender']."</td>";
            echo "<td>".$fieldname['bday']."</td>";
            echo "<td>".$fieldname['course']."</td>";
            echo "<td>".$fieldname['yearlevel']."</td>";
            echo "<td>".$fieldname['email']."</td>";
            echo "<td>".$fieldname['contact']."</td>";
            echo "<td>".$fieldname['addinfo']."</td>";
            echo "<td><img src='".$fieldname['img_pthajv']."' width=250 length=250></td>";
            echo "</tr>";
        } 

} else {
    echo "No record found";
}


?>
    </table>
</div>
</body>
</html>
