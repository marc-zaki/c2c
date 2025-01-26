<?php
include 'db_conn_new.php';
include 'CRUD_functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_driver'])) {
        create_driver_details($_POST['drvID'], $_POST['drvLine'], $_POST['drvFname'], $_POST['drvLname'], $_POST['DOB'], $_POST['trID']);
    } elseif (isset($_POST['update_driver'])) {
        update_driver_details($_POST['drvID'], $_POST['drvLine'], $_POST['drvFname'], $_POST['drvLname'], $_POST['DOB'], $_POST['trID']);
    } elseif (isset($_POST['delete_driver'])) {
        delete_driver_details($_POST['drvID']);
    }
}

$driver_list = read_driver_details();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Driver Details</title>
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
    <h1>Driver Details</h1>
    <h2>Driver List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Driver ID</th>
                <th>Driver Line</th>
                <th>Driver First Name</th>
                <th>Driver Last Name</th>
                <th>Date of Birth</th>
                <th>Train ID</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($driver_list->num_rows > 0) {
            while($row = $driver_list->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['drvID'] ?></td>
                    <td><?= $row['drvLine'] ?></td>
                    <td><?= $row['drvFname'] ?></td>
                    <td><?= $row['drvLname'] ?></td>
                    <td><?= $row['DOB'] ?></td>
                    <td><?= $row['trID'] ?></td>
                </tr>
            <?php }
            } else {
                echo "<tr><td colspan='6'>No records found</td></tr>";
            } ?>
        </tbody>
    </table>
    
    <form method="POST">
        <h2>Add New Driver</h2>
        <input type="text" name="drvID" placeholder="Driver ID" required>
        <input type="text" name="drvLine" placeholder="Driver Line" required>
        <input type="text" name="drvFname" placeholder="Driver First Name" required>
        <input type="text" name="drvLname" placeholder="Driver Last Name" required>
        <input type="date" name="DOB" placeholder="Date of Birth" required>
        <input type="text" name="trID" placeholder="Train ID" required>
        <button type="submit" name="create_driver">Add Driver</button>
    </form>
    

    <form method="POST">
        <h2>Update Driver</h2>
        <input type="text" name="drvID" placeholder="Driver ID" required>
        <input type="text" name="drvLine" placeholder="New Driver Line" required>
        <input type="text" name="drvFname" placeholder="New Driver First Name" required>
        <input type="text" name="drvLname" placeholder="New Driver Last Name" required>
        <input type="date" name="DOB" placeholder="New Date of Birth" required>
        <input type="text" name="trID" placeholder="New Train ID" required>
        <button type="submit" name="update_driver">Update Driver</button>
    </form>
    
    <form method="POST">
        <h2>Delete Driver</h2>
        <input type="text" name="drvID" placeholder="Driver ID" required>
        <button type="submit" name="delete_driver">Delete Driver</button>
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</div>
</body>
</html>
