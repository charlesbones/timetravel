<?php

include("db.php");

$actual_link = "https://dennisbu.octans.uberspace.de/audio/";

$match = $_GET['match'];

$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbName);

$sql = "SELECT file FROM matches JOIN records ON matches.id_record = records.id WHERE matches.id_pattern = '$match'";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    while($r = $result->fetch_assoc()) {
      $rows[] = $r;
    }
} else {
    echo "0 results";
}

print json_encode($rows, JSON_UNESCAPED_SLASHES);

$con->close();
?>



