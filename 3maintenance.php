<?php
include 'db_conn_new.php';
include 'CRUD_functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_maintenance'])) {
        create_maintenance($_POST['departmentID'], $_POST['M_duration'], $_POST['Descrip']);
    } elseif (isset($_POST['update_maintenance'])) {
        update_maintenance($_POST['departmentID'], $_POST['M_duration'], $_POST['Descrip']);
    } elseif (isset($_POST['delete_maintenance'])) {
        delete_maintenance($_POST['departmentID']);
    }
}

$maintenance_list = read_maintenance();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Maintenance Details</title>
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
    <h1>Maintenance Details</h1>
    
    <h2>Maintenance List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Department ID</th>
                <th>Duration</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($maintenance_list->num_rows > 0) {
            while($row = $maintenance_list->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['departmentID'] ?></td>
                    <td><?= $row['M_duration'] ?></td>
                    <td><?= $row['Descrip'] ?></td>
                </tr>
            <?php }
            } else {
                echo "<tr><td colspan='3'>No records found</td></tr>";
            } ?>
        </tbody>
    </table>
    
    <form method="POST">
        <h2>Add New Maintenance Record</h2>
        <input type="text" name="departmentID" placeholder="Department ID" required>
        <input type="text" name="M_duration" placeholder="Maintenance Duration" required>
        <input type="text" name="Descrip" placeholder="Description" required>
        <button type="submit" name="create_maintenance">Add Record</button>
    </form>

    <form method="POST">
        <h2>Update Maintenance Record</h2>
        <input type="text" name="departmentID" placeholder="Department ID" required>
        <input type="text" name="M_duration" placeholder="New Duration" required>
        <input type="text" name="Descrip" placeholder="New Description" required>
        <button type="submit" name="update_maintenance">Update Record</button>
    </form>
    
    <form method="POST">
        <h2>Delete Maintenance Record</h2>
        <input type="text" name="departmentID" placeholder="Department ID" required>
        <button type="submit" name="delete_maintenance">Delete Record</button>
    </form>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</div>
</body>
</html>
