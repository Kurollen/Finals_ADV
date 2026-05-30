<?php
require_once "dbconnection.php";
session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container p-5 bg-light">
    <form action="" method="post">
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

if (isset($_POST['btnsearch'])) {
    //search user input
    $searchinput = $_POST["searchinput"];

    if ($searchinput != NULL) {
        $displaysql = "SELECT * FROM logs
        WHERE user_id LIKE '%".$searchinput."%' 
        OR action LIKE '%".$searchinput."%'
        OR datetime LIKE '%".$searchinput."%'";

    $logssql = "Insert INTO logs(user_id, action, datetime) values('".$_SESSION["user_id"]."','Searched for:".$searchinput." ', NOW())";
    $conn ->query($logssql);

    }
    else {
        $displaysql = "SELECT * FROM logs";
    }
}
else {
    //string query
    $displaysql = "SELECT * FROM logs";
}

$result = $conn -> query($displaysql);

if ($result ->num_rows > 0) {
?>
    <table class="table table-primary">
        <tr>
            <th>Log_id</th>
            <th>User_id</th>
            <th>Action</th>
            <th>Date & Time</th>
        </tr>

<?php
    //display record
    foreach ($result as $fieldname) {
        echo"<tr>";
        echo"<td>".$fieldname['log_id']."</td>";
        echo"<td>".$fieldname['user_id']."</td>";
        echo"<td>".$fieldname['action']."</td>";
        echo"<td>".$fieldname['datetime']."</td>";
        echo"</tr>";
    }
}
else {
    echo "No record found";
}

?>
    </table>
</div>
</body>
</html>