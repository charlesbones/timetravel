<?php
header('Content-type: application/json; charset=utf-8');

// Include Database Connection
include("db.php");

// Get Parameter
$match = $_GET['match'];

// Open Connection
$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbName);

// Get Matches
$sql = "SELECT file FROM matches JOIN records ON matches.id_record = records.id WHERE matches.id_pattern = '$match'";
$result = $con->query($sql);

// Create array
if ($result->num_rows > 0) {
    while($r = $result->fetch_assoc()) {
      $rows[] = $r;
    }
} else {
    echo "0 results";
}

// Return Result as JSON
print json_encode($rows, JSON_UNESCAPED_SLASHES);

// Close Connection
$con->close();
?>



