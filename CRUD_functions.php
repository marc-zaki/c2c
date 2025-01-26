<?php
function connect_db() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "trip";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}

// Train
function create_train($trainID, $nSeats, $trainModel, $deptID) {
    $conn = connect_db();
    $sql = "INSERT INTO train (trainID, nSeats, trainModel, deptID)
            VALUES ('$trainID', '$nSeats', '$trainModel', '$deptID')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}

function read_trains() {
    $conn = connect_db();
    $result = $conn->query("SELECT trainID, nSeats, trainModel, deptID FROM train");
    $conn->close();
    return $result;
}

function update_train($trainID, $nSeats) {
    $conn = connect_db();
    $sql = "UPDATE train SET nSeats='$nSeats' WHERE trainID='$trainID'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    
    $conn->close();
}

function delete_train($trainID) {
    $conn = connect_db();
    $sql = "DELETE FROM train WHERE trainID='$trainID'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    
    $conn->close();
}

// Stations
function create_station($stationsID, $locations, $stationsName) {
    $conn = connect_db();
    $sql = "INSERT INTO stations (stationsID, locations, stationsName)
            VALUES ('$stationsID', '$locations', '$stationsName')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New station created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}

function read_stations() {
    $conn = connect_db();
    $result = $conn->query("SELECT stationsID, locations, stationsName FROM stations");
    $conn->close();
    return $result;
}

function update_station($stationsID, $locations, $stationsName) {
    $conn = connect_db();
    $sql = "UPDATE stations SET locations='$locations', stationsName='$stationsName' WHERE stationsID='$stationsID'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Station updated successfully";
    } else {
        echo "Error updating station: " . $conn->error;
    }
    
    $conn->close();
}

function delete_station($stationsID) {
    $conn = connect_db();
    $sql = "DELETE FROM stations WHERE stationsID='$stationsID'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Station deleted successfully";
    } else {
        echo "Error deleting station: " . $conn->error;
    }
    
    $conn->close();
}

// Maintenance
function create_maintenance($departmentID, $M_duration, $Descrip) {
    $conn = connect_db();
    $sql = "INSERT INTO maintenance (departmentID, M_duration, Descrip)
            VALUES ('$departmentID', '$M_duration', '$Descrip')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New maintenance record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}

function read_maintenance() {
    $conn = connect_db();
    $result = $conn->query("SELECT departmentID, M_duration, Descrip FROM maintenance");
    $conn->close();
    return $result;
}

function update_maintenance($departmentID, $M_duration, $Descrip) {
    $conn = connect_db();
    $sql = "UPDATE maintenance SET M_duration='$M_duration', Descrip='$Descrip' WHERE departmentID='$departmentID'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Maintenance record updated successfully";
    } else {
        echo "Error updating maintenance record: " . $conn->error;
    }
    
    $conn->close();
}

function delete_maintenance($departmentID) {
    $conn = connect_db();
    $sql = "DELETE FROM maintenance WHERE departmentID='$departmentID'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Maintenance record deleted successfully";
    } else {
        echo "Error deleting maintenance record: " . $conn->error;
    }
    
    $conn->close();
}

// Line
function create_line($lineName, $numStops, $lineID) {
    $conn = connect_db();
    $sql = "INSERT INTO line (lineName, numStops, lineID)
            VALUES ('$lineName', '$numStops', '$lineID')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New line created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}

function read_lines() {
    $conn = connect_db();
    $result = $conn->query("SELECT lineName, numStops, lineID FROM line");
    $conn->close();
    return $result;
}

function update_line($lineName, $numStops, $lineID) {
    $conn = connect_db();
    $sql = "UPDATE line SET lineName='$lineName', numStops='$numStops' WHERE lineID='$lineID'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Line updated successfully";
    } else {
        echo "Error updating line: " . $conn->error;
    }
    
    $conn->close();
}

function delete_line($lineID) {
    $conn = connect_db();
    $sql = "DELETE FROM line WHERE lineID='$lineID'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Line deleted successfully";
    } else {
        echo "Error deleting line: " . $conn->error;
    }
    
    $conn->close();
}

// Driver 
function create_driver_details($drvID, $drvLine, $drvFname, $drvLname, $DOB, $trID) {
    $conn = connect_db();
    $sql = "INSERT INTO drivers (drvID, drvLine, drvFname, drvLname, DOB, trID)
            VALUES ('$drvID', '$drvLine', '$drvFname', '$drvLname', '$DOB', '$trID')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New driver created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}

function read_driver_details() {
    $conn = connect_db();
    $result = $conn->query("SELECT drvID, drvLine, drvFname, drvLname, DOB, trID FROM drivers");
    $conn->close();
    return $result;
}

function update_driver_details($drvID, $drvLine, $drvFname, $drvLname, $DOB, $trID) {
    $conn = connect_db();
    $sql = "UPDATE drivers SET drvLine='$drvLine', drvFname='$drvFname', drvLname='$drvLname', DOB='$DOB', trID='$trID' WHERE drvID='$drvID'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Driver details updated successfully";
    } else {
        echo "Error updating driver details: " . $conn->error;
    }
    
    $conn->close();
}

function delete_driver_details($drvID) {
    $conn = connect_db();
    $sql = "DELETE FROM drivers WHERE drvID='$drvID'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Driver details deleted successfully";
    } else {
        echo "Error deleting driver details: " . $conn->error;
    }
    
    $conn->close();
}
?>
