<?php

include("db.php");


// pull the raw binary data from the POST array
$data = substr($_POST['data'], strpos($_POST['data'], ",") + 1);
$transcript = $_POST['transcript'];
$transcript = str_replace("'", "", $transcript);
$date = date('m-d-Y_h-i-s');

// decode it
$decodedData = base64_decode($data);
  
// write the data out to the file
$path = 'files/';
$filename = 'audio_'.$date.'.wav';
$fp = fopen($path.$filename, 'wb');
$fwrite = fwrite($fp, $decodedData);
  if ($fwrite === FALSE) { echo "Upload: ERROR with uploading the file."; }
  else { echo "Upload: Successfully transferred ".$filename."\n"; }
fclose($fp);


// Finally create entries in database
$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbName);

// Save record
$sql_record = "INSERT INTO records (file, transcript) VALUES ('$filename', '$transcript')";
if ($con->query($sql_record) === TRUE) { echo "Database: New record created successfully."; }
else { echo "Error: " . $sql . "<br>" . $con->error; }

// Save matches
$id_record = $con->insert_id;

  if ($_POST['love'] == "true") {
    $id_pattern = "love";
    $sql_match = "INSERT INTO matches (id_record, id_pattern) VALUES ('$id_record', '$id_pattern')";
    if ($con->query($sql_match) === TRUE) { echo "\n Match registered: love"; }
  }
  if ($_POST['hate'] == "true") {
    $id_pattern = 'hate';
    $sql_match = "INSERT INTO matches (id_record, id_pattern) VALUES ('$id_record', '$id_pattern')";
    if ($con->query($sql_match) === TRUE) { echo "\n Match registered: hate"; }
  }



$con->close();
?>