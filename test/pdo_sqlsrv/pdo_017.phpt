--TEST--
Fetch string with new line and tab characters
--SKIPIF--
<?php require('skipif.inc'); ?>
--FILE--
<?php
require_once("MsSetup.inc");

// Connect
$conn = new PDO( "sqlsrv:server=$server; database=$databaseName", $uid, $pwd);

// Create table
$tableName = '#pdo_017';
$sql = "CREATE TABLE $tableName (c1 VARCHAR(32), c2 CHAR(32), c3 NVARCHAR(32), c4 NCHAR(32))";
$stmt = $conn->exec($sql);

// Bind parameters and insert data
$sql = "INSERT INTO $tableName VALUES (:val1, :val2, :val3, :val4)";
$value = "I USE\nMSPHPSQL\tDRIVERS WITH PHP7";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':val1', $value);
$stmt->bindParam(':val2', $value);
$stmt->bindParam(':val3', $value);
$stmt->bindParam(':val4', $value);
$stmt->execute();

// Get data
$sql = "SELECT UPPER(c1) AS VARCHAR, UPPER(c2) AS CHAR, 
    UPPER(c3) AS NVARCHAR, UPPER(c4) AS NCHAR FROM $tableName";
$stmt = $conn->query($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($row);

// Close connection
$stmt=null;
$conn=null;
print "Done"
?>

--EXPECT--
array(4) {
  ["VARCHAR"]=>
  string(32) "I USE
MSPHPSQL	DRIVERS WITH PHP7"
  ["CHAR"]=>
  string(32) "I USE
MSPHPSQL	DRIVERS WITH PHP7"
  ["NVARCHAR"]=>
  string(32) "I USE
MSPHPSQL	DRIVERS WITH PHP7"
  ["NCHAR"]=>
  string(32) "I USE
MSPHPSQL	DRIVERS WITH PHP7"
}
Done
