<?php
session_start();
require_once "dbconnection.php";

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index1.php">
                Appdev Movie Booking System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-light" href="cinemas.php">Cinemas</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="index1.php">Now Showing</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="register.php">Register/Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="bg-secondary text-white py-2 shadow-lg">
        <div class="container d-flex justify-content-between">
            <span id="date"></span>
            <span class="badge bg-danger">Admin Panel</span>
        </div>
    </div>

    <script>
        function updateDate() {
            const today = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById("date").innerHTML = today.toLocaleDateString('en-US', options);
        }
        updateDate();
    </script>

    <section class="bg-warning text-center p-3 shadow-lg">
        <div class="container py-3">
            <h1 class="display-5 fw-bold">User Accounts Viewing</h1>
            <p class="fw-semibold mt-2 mb-0">View registered customers, view all user credentials, and track roles.</p>
        </div>
    </section>

    <section class="py-4 bg-white flex-grow-1">
        <div class="container">

            <div class="mb-3">
                <a href="adminview.php" class="text-dark fw-semibold text-decoration-none">← Back to Management Dashboard</a>
            </div>

            <div class="container shadow bg-dark p-4 rounded-4 text-white mb-4">
                <form action="" method="post" class="m-0">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-9">
                            <input type="search" name="searchinput" placeholder="Search" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <input type="submit" name="btnsearch" value="Search" class="btn btn-warning fw-bold w-100">
                        </div>
                    </div>
                </form>
            </div>


<?php
if (isset($_POST['btnsearch'])) {
    //search user input
    $searchinput = $_POST["searchinput"];

    if ($searchinput != NULL) {
        $displaysql = "SELECT * FROM user
        WHERE full_name LIKE '%".$searchinput."%' 
        OR roles LIKE '%".$searchinput."%'
        OR email LIKE '%".$searchinput."%'
        OR username LIKE '%".$searchinput."%'";

    $logssql = "Insert INTO logs(user_id, action, datetime) values('".$_SESSION["user_id"]."','Searched for:".$searchinput." ', NOW())";
    $conn ->query($logssql);

    }
    else {
        $displaysql = "SELECT * FROM user";
    }
}
else {
    //string query
    $displaysql = "SELECT * FROM user";
}

$result = $conn -> query($displaysql);

if ($result ->num_rows > 0) {
?>
            <div class="card shadow-lg border-0 rounded-4 w-100">
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover m-0 align-middle">
                        <thead class="table-secondary text-uppercase fs-7">
                            <tr>
                                <th class="ps-4 py-3">User_id</th>
                                <th class="py-3">Full Name</th>
                                <th class="py-3">Role</th>
                                <th class="py-3">Email</th>
                                <th class="pe-4 py-3 text-end">Username</th>
                            </tr>
                        </thead>
                        <tbody>

<?php
    //display record
    foreach ($result as $fieldname) {
        echo "<tr>";
        echo "<td class='ps-4 fw-semibold text-warning'>".$fieldname['user_id']."</td>";
        echo "<td>".$fieldname['full_name']."</td>";
        echo "<td><span class='badge bg-secondary'>".$fieldname['roles']."</span></td>";
        echo "<td>".$fieldname['email']."</td>";
        echo "<td class='pe-4 text-end text-light-50 fs-7'>".$fieldname['username']."</td>";
        echo "</tr>";
    }
}
else {
    echo "<div class='p-5 text-center bg-dark text-muted rounded-4'><p class='fs-4 mb-0'>No record found</p></div>";
}

?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       </div>
    </section>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">© Finals Movie Booking System — Admin Panel</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>