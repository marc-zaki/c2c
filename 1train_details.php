<?php
include 'db_conn_new.php';
include 'CRUD_functions.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_train'])) {
        create_train($_POST['trainID'], $_POST['nSeats'], $_POST['trainModel'], $_POST['deptID']);
    } elseif (isset($_POST['update_train'])) {
        update_train($_POST['trainID'], $_POST['nSeats']);
    } elseif (isset($_POST['delete_train'])) {
        delete_train($_POST['trainID']);
    }
}

$train_list = read_trains();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Train Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./db.css">

</head>
<body>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="login.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img src="./pictures/logo c2c.png" alt="logo" height="100px" width="230px">
                <span class="fs-4">Cairo2Capital Transport</span>
            </a>
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="./stations.php" class="nav-link text-success">Home</a></li>
                <li class="nav-item"><a href="./lines.html" class="nav-link text-success">Lines</a></li>
                <li class="nav-item"><a href="./FAQs.html" class="nav-link text-success">FAQs</a></li>
                <li class="nav-item"><a href="./about.html" class="nav-link text-success">About</a></li>
                <li class="nav-item"><a href="./edit_user.php" class="nav-link text-success">Account</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active bg-success text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admin Portal
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./1train_details.php">Train Details</a></li>
                        <li><a class="dropdown-item" href="./2stations_details.php">Stations Details</a></li>
                        <li><a class="dropdown-item" href="./3maintenance.php">Maintenance</a></li>
                        <li><a class="dropdown-item" href="./4line_details.php">Line Details</a></li>
                        <li><a class="dropdown-item" href="./5drivers_details.php">Drivers Details</a></li>
                    </ul>
                </li>
            </ul>
        </header>
    </div>
<div class="container">
    <h1>Train Details</h1>
    <h2>Train List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Train ID</th>
                <th>Number of Seats</th>
                <th>Train Model</th>
                <th>Department ID</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($train_list->num_rows > 0) {
            while($row = $train_list->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['trainID'] ?></td>
                    <td><?= $row['nSeats'] ?></td>
                    <td><?= $row['trainModel'] ?></td>
                    <td><?= $row['deptID'] ?></td>
                </tr>
            <?php }
            } else {
                echo "<tr><td colspan='4'>No records found</td></tr>";
            } ?>
        </tbody>
    </table>

        <form method="POST">
        <h2>Add New Train</h2>
        <input type="text" name="trainID" placeholder="Train ID" required>
        <input type="text" name="nSeats" placeholder="Number of Seats" required>
        <input type="text" name="trainModel" placeholder="Train Model" required>
        <input type="text" name="deptID" placeholder="Department ID" required>
        <button type="submit" name="create_train">Add Train</button>
    </form>

    <form method="POST">
        <h2>Update Train Seats</h2>
        <input type="text" name="trainID" placeholder="Train ID" required>
        <input type="text" name="nSeats" placeholder="New Number of Seats" required>
        <button type="submit" name="update_train">Update Seats</button>
    </form>
    
    <form method="POST">
        <h2>Delete Train</h2>
        <input type="text" name="trainID" placeholder="Train ID" required>
        <button type="submit" name="delete_train">Delete Train</button>
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    </div>
</body>
</html>
