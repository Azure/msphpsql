--TEST--
Test for retrieving encrypted data of datetimes as output parameters
--DESCRIPTION--
Use PDOstatement::bindParam with all PDO::PARAM_ types
--ENV--
PHPT_EXEC=true
--SKIPIF--
<?php require('skipif_mid-refactor.inc'); ?>
--FILE--
<?php
require_once("MsCommon_mid-refactor.inc");
require_once("AEData.inc");

$dataTypes = array("datetime2", "datetimeoffset", "time");
$precisions = array(/*0, */1, 2, 4, 7);
$inputValuesInit = array("datetime2" => array("0001-01-01 00:00:00", "9999-12-31 23:59:59"),
                     "datetimeoffset" => array("0001-01-01 00:00:00 -14:00", "9999-12-31 23:59:59 +14:00"),
                     "time" => array("00:00:00", "23:59:59"));

$errors = array("IMSSP" => "An invalid PHP type was specified as an output parameter. DateTime objects, NULL values, and streams cannot be specified as output parameters.", "07006" => "Restricted data type attribute violation");

// compareDate() returns true when the date/time values are basically the same
// e.g. 00:00:00.000 is the same as 00:00:00
function compareDate($dtout, $dtin, $dataType) 
{
    if ($dataType == "datetimeoffset") {
        $dtarr = explode(' ', $dtin);
        if (strpos($dtout, $dtarr[0]) !== false && strpos($dtout, $dtarr[1]) !== false && strpos($dtout, $dtarr[2]) !== false) {
            return true;
        }
    } else {
        if (strpos($dtout, $dtin) !== false) {
            return true;
        }
    }
    return false;
}

try {
    $conn = connect();
    
    $tbname = "test_datetimes_types";
    $spname = "test_datetimes_proc";

    foreach ($dataTypes as $dataType) {
        foreach ($precisions as $precision) {
            // change the input values depending on the precision
            $inputValues[0] = $inputValuesInit[$dataType][0];
            $inputValues[1] = $inputValuesInit[$dataType][1];
            if ($precision != 0) {
                if ($dataType == "datetime2") {
                    $inputValues[1] .= "." . str_repeat("9", $precision);
                } else if ($dataType == "datetimeoffset") {
                    $inputPieces = explode(" ", $inputValues[1]);
                    $inputValues[1] = $inputPieces[0] . " " . $inputPieces[1] . "." . str_repeat("9", $precision) . " " . $inputPieces[2];
                } else if ($dataType == "time") {
                    $inputValues[0] .= "." . str_repeat("0", $precision);
                    $inputValues[1] .= "." . str_repeat("9", $precision);
                }
            }

            $type = "$dataType($precision)";
            trace("\nTesting $type:\n");

            //create and populate table
            $colMetaArr = array(new ColumnMeta($type, "c_det"), new ColumnMeta($type, "c_rand", null, "randomized"));
            createTable($conn, $tbname, $colMetaArr);

            $stmt = insertRow($conn, $tbname, array("c_det" => $inputValues[0], "c_rand" => $inputValues[1] ), null, $r);
            
            // fetch with PDO::bindParam using a stored procedure
            dropProc($conn, $spname);
            $spSql = "CREATE PROCEDURE $spname (
                            @c_det $type OUTPUT, @c_rand $type OUTPUT ) AS
                            SELECT @c_det = c_det, @c_rand = c_rand FROM $tbname";
            $conn->query($spSql);
        
            // call stored procedure
            $outSql = getCallProcSqlPlaceholders($spname, 2);
            foreach ($pdoParamTypes as $pdoParamType) {
                $det = 0.0;
                $rand = 0.0;
                $stmt = $conn->prepare($outSql);
            
                $len = 2048;
                if ($pdoParamType == "PDO::PARAM_BOOL" || $pdoParamType == "PDO::PARAM_INT") {
                    $len = PDO::SQLSRV_PARAM_OUT_DEFAULT_SIZE;
                } 
                trace("\nParam $pdoParamType with $len\n");
            
                $stmt->bindParam(1, $det, constant($pdoParamType), $len); 
                $stmt->bindParam(2, $rand, constant($pdoParamType), $len); 
            
                try {
                    $stmt->execute();
                    if (!compareDate($det, $inputValues[0], $dataType) || 
                        !compareDate($rand, $inputValues[1], $dataType)) {
                        echo("****$pdoParamType failed:****\n");
                        echo "input 0: "; var_dump($inputValues[0]);
                        echo "fetched: "; var_dump($det);
                        echo "input 1: "; var_dump($inputValues[1]);
                        echo "fetched: "; var_dump($rand);
                    }
                } catch (PDOException $e) {
                    $message = $e->getMessage();
                    if ($pdoParamType == "PDO::PARAM_NULL" || $pdoParamType == "PDO::PARAM_LOB") {
                        // Expected error IMSSP: "An invalid PHP type was specified 
                        // as an output parameter. DateTime objects, NULL values, and
                        // streams cannot be specified as output parameters."
                        $found = strpos($message, $errors['IMSSP']);
                        if ($found === false) {
                            echo "****$pdoParamType failed:\n$message****\n";
                        }
                    } elseif ($pdoParamType == "PDO::PARAM_BOOL" || $pdoParamType == "PDO::PARAM_INT") {
                        if (isAEConnected()) {
                            // Expected error 07006: "Restricted data type attribute violation"
                            // What does this error mean? 
                            // The data value returned for a parameter bound as 
                            // SQL_PARAM_INPUT_OUTPUT or SQL_PARAM_OUTPUT could not 
                            // be converted to the data type identified by the  
                            // ValueType argument in SQLBindParameter.
                            $found = strpos($message, $errors['07006']);
                        } else {
                            // When not AE enabled, expected to fail with the error below
                            $msg = "Operand type clash: int is incompatible with $dataType"; 
                            $found = strpos($message, $msg);
                        }
                        if ($found === false) {
                            echo "****$pdoParamType failed:\n$message****\n";
                        }
                    } else {
                        echo("****$pdoParamType failed:\n$message****\n");
                    }
                }
            }
            dropProc($conn, $spname);
            dropTable($conn, $tbname);
        }
    }
    unset($stmt);
    unset($conn);
} catch (PDOException $e) {
    echo $e->getMessage();
}

echo "Done\n";

?>
--CLEAN--
<?php
    // drop the temporary table and stored procedure in case 
    // the test failed without dropping them
    require_once("MsCommon_mid-refactor.inc");
    $tbname = "test_datetimes_types";
    $spname = "test_datetimes_proc";
    $conn = connect();
    dropProc($conn, $spname);
    dropTable($conn, $tbname);
    unset($conn);
?>
--EXPECT--
Done