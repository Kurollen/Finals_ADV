<?php
// database connection
$servername="localhost";
$username="root";
$password="cics";
$database="db_useraccountajv";

$conn = new mysqli($servername,$username,$password,$database);

//check if connected

// if (!$conn->connect_error) {
//     echo "Connected";
// }

?>