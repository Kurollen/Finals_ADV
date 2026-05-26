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
//field titles
    //row of records inside the table
    echo "<div class=container align-items-center d-flex justify-content-center>";
    echo "<div class=row>";
    foreach ($result as $index => $fieldnames) {
    ?>
      <div class="col-4">
        <div class="container p-3 m-3 bg-secondary">
            <div class="row">
              <div class="col">
                <img src="<?php echo $fieldnames['img_pthajv'] ?>" alt="" width=100 height=100>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <?php echo $fieldnames['lname'] ?>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <i class=small><?php echo $fieldnames['fname'] ?></i>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <a href="" class="btn btn-success">View </a>
              </div>
            </div>
        </div>
      </div>
<?php
    }
     echo "</div>";
     echo "</div>";


?>
    </table>
</div>
</body>
</html>
