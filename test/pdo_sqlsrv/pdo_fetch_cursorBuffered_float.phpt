--TEST--
prepare with cursor buffered and fetch a float column
--SKIPIF--

--FILE--
<?php
function FlatsAreEqual($a, $b, $epsilon = 3.9265E-6)
{
  return (abs($a - $b) < $epsilon);
}
require_once("MsSetup.inc");
$conn = new PDO( "sqlsrv:server=$server; database=$databaseName", $uid, $pwd);
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$sample = 1234567890.1234;

$query = 'CREATE TABLE #TESTTABLE (exist float(53))';
$stmt = $conn->exec($query);
$query = 'INSERT INTO #TESTTABLE VALUES(:p0)';
$stmt = $conn->prepare($query);
$stmt->bindValue(':p0', $sample, PDO::PARAM_INT);
$stmt->execute();

$query = 'SELECT TOP 1 * FROM #TESTTABLE';

//prepare with no buffered cursor
print "no buffered cursor, stringify off, fetch_numeric off\n"; //stringify and fetch_numeric is off by default
$stmt = $conn->prepare($query);
$stmt->execute();
$value = $stmt->fetchColumn();
var_dump ($value);
$ok = FlatsAreEqual($sample, $value) ? 'TRUE' : 'FALSE';
print "\nFetched value = Input? $ok\n\n";

print "no buffered cursor, stringify off, fetch_numeric on\n";
$conn->setAttribute( PDO::SQLSRV_ATTR_FETCHES_NUMERIC_TYPE, true);
$stmt = $conn->prepare($query);
$stmt->execute();
$value = $stmt->fetchColumn();
var_dump ($value);
$ok = FlatsAreEqual($sample, $value) ? 'TRUE' : 'FALSE';
print "\nFetched value = Input? $ok\n\n";

print "no buffered cursor, stringify on, fetch_numeric on\n";
$conn->setAttribute( PDO::ATTR_STRINGIFY_FETCHES, true);
$stmt = $conn->prepare($query);
$stmt->execute();
$value = $stmt->fetchColumn();
var_dump ($value);
$ok = FlatsAreEqual($sample, $value) ? 'TRUE' : 'FALSE';
print "\nFetched value = Input? $ok\n\n";

print "no buffered cursor, stringify on, fetch_numeric off\n";
$conn->setAttribute( PDO::SQLSRV_ATTR_FETCHES_NUMERIC_TYPE, false);
$stmt = $conn->prepare($query);
$stmt->execute();
$value = $stmt->fetchColumn();
var_dump ($value);
$ok = FlatsAreEqual($sample, $value) ? 'TRUE' : 'FALSE';
print "\nFetched value = Input? $ok\n\n";

//prepare with client buffered cursor
print "buffered cursor, stringify off, fetch_numeric off\n";
$conn->setAttribute( PDO::ATTR_STRINGIFY_FETCHES, false);
$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL, PDO::SQLSRV_ATTR_CURSOR_SCROLL_TYPE => PDO::SQLSRV_CURSOR_BUFFERED));
$stmt->execute();
$value = $stmt->fetchColumn();
var_dump ($value);
$ok = FlatsAreEqual($sample, $value) ? 'TRUE' : 'FALSE';
print "\nFetched value = Input? $ok\n\n";

print "buffered cursor, stringify off, fetch_numeric on\n";
$conn->setAttribute( PDO::SQLSRV_ATTR_FETCHES_NUMERIC_TYPE, true);
$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL, PDO::SQLSRV_ATTR_CURSOR_SCROLL_TYPE => PDO::SQLSRV_CURSOR_BUFFERED));
$stmt->execute();
$value = $stmt->fetchColumn();
var_dump ($value);
$ok = FlatsAreEqual($sample, $value) ? 'TRUE' : 'FALSE';
print "\nFetched value = Input? $ok\n\n";

print "buffered cursor, stringify on, fetch_numeric on\n";
$conn->setAttribute( PDO::ATTR_STRINGIFY_FETCHES, true);
$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL, PDO::SQLSRV_ATTR_CURSOR_SCROLL_TYPE => PDO::SQLSRV_CURSOR_BUFFERED));
$stmt->execute();
$value = $stmt->fetchColumn();
var_dump ($value);
$ok = FlatsAreEqual($sample, $value) ? 'TRUE' : 'FALSE';
print "\nFetched value = Input? $ok\n\n";

print "buffered cursor, stringify on, fetch_numeric off\n";
$conn->setAttribute( PDO::SQLSRV_ATTR_FETCHES_NUMERIC_TYPE, false);
$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL, PDO::SQLSRV_ATTR_CURSOR_SCROLL_TYPE => PDO::SQLSRV_CURSOR_BUFFERED));
$stmt->execute();
$value = $stmt->fetchColumn();
var_dump ($value);
$ok = FlatsAreEqual($sample, $value) ? 'TRUE' : 'FALSE';
print "\nFetched value = Input? $ok\n\n";

$stmt = null;
$conn = null;

?>
--EXPECT--
no buffered cursor, stringify off, fetch_numeric off
string(15) "1234567890.1234"

Fetched value = Input? TRUE

no buffered cursor, stringify off, fetch_numeric on
float(1234567890.1234)

Fetched value = Input? TRUE

no buffered cursor, stringify on, fetch_numeric on
string(15) "1234567890.1234"

Fetched value = Input? TRUE

no buffered cursor, stringify on, fetch_numeric off
string(15) "1234567890.1234"

Fetched value = Input? TRUE

buffered cursor, stringify off, fetch_numeric off
string(15) "1234567890.1234"

Fetched value = Input? TRUE

buffered cursor, stringify off, fetch_numeric on
float(1234567890.1234)

Fetched value = Input? TRUE

buffered cursor, stringify on, fetch_numeric on
string(15) "1234567890.1234"

Fetched value = Input? TRUE

buffered cursor, stringify on, fetch_numeric off
string(15) "1234567890.1234"

Fetched value = Input? TRUE
