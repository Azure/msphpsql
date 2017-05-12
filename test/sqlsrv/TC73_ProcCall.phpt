--TEST--
Stored Proc Call Test
--DESCRIPTION--
Verifies the ability to create and subsequently call a stored procedure.
--ENV--
PHPT_EXEC=true
--SKIPIF--
<?php require('skipif.inc'); ?>
--FILE--
<?php
include 'MsCommon.inc';

function StoredProc()
{
    include 'MsSetup.inc';

    $testName = "Stored Proc Call";
    StartTest($testName);

    Setup();
    $conn1 = Connect();

    $step = 0;
    $dataStr = "The quick brown fox jumps over the lazy dog.";
    $dataInt = 0;

    // Scenario #1: using a null buffer
    $step++;
    if (!ExecProc1($conn1, $procName, $dataStr, 40, 0))
    {
        die("Execution failure at step $step.");
    }

    // Scenario #2: using a pre-allocated buffer
    $step++;
    if (!ExecProc1($conn1, $procName, $dataStr, 25, 1))
    {
        die("Execution failure at step $step.");
    }

    // Scenario #3: specifying an exact return size
    $step++;
    if (!ExecProc1($conn1, $procName, $dataStr, 0, 2))
    {
        die("Execution failure at step $step.");
    }

    // Scenario #4: specifying a larger return size
    $step++;
    if (!ExecProc1($conn1, $procName, $dataStr, 50, 2))
    {
        die("Execution failure at step $step.");
    }

    // Scenario #5: returning a value
    $step++;
    if (!ExecProc2($conn1, $procName, $dataInt))
    {
        die("Execution failure at step $step.");
    }

    sqlsrv_close($conn1);

    EndTest($testName);
}

function ExecProc1($conn, $procName, $dataIn, $extraSize, $phpInit)
{
    $inValue = trim($dataIn);
    $outValue = null;
    $lenData = strlen($inValue);
    $len = $lenData + $extraSize;
    $procArgs = "@p1 VARCHAR($len) OUTPUT";
    $procCode = "SET @p1 = '$inValue'";

    if ($phpInit == 1)
    {
        $outValue = "";
        for ($i = 0; $i < $len; $i++)
        {   // fill the buffer with "A"
            $outValue = $outValue."A";
        }
    }
    $callArgs =  array(array(&$outValue, SQLSRV_PARAM_OUT,
                 SQLSRV_PHPTYPE_STRING(SQLSRV_ENC_CHAR),
                         SQLSRV_SQLTYPE_VARCHAR($lenData + 1)));

    CreateProc($conn, $procName, $procArgs, $procCode);
    CallProc($conn, $procName, "?", $callArgs);
    DropProc($conn, $procName);

    if ($inValue != trim($outValue))
    {
        Trace("Data corruption: [$inValue] => [$outValue]\n");
        return (false);
    }
    return (true);
}


function ExecProc2($conn, $procName, $dataIn)
{
    $procArgs = "@p1 INT";
    $procCode = "SET NOCOUNT ON; SELECT 199 IF @p1 = 0 RETURN 11 ELSE RETURN 22";
    $retValue = -1; 
    $callArgs =  array(array(&$retValue, SQLSRV_PARAM_OUT), array($dataIn, SQLSRV_PARAM_IN));

    CreateProc($conn, $procName, $procArgs, $procCode);
    $stmt = CallProcEx($conn, $procName, "? = ", "?", $callArgs);
    DropProc($conn, $procName);

    $row = sqlsrv_fetch_array($stmt);
    $count = count($row);
    sqlsrv_next_result($stmt);  
    sqlsrv_free_stmt($stmt);

    if (($row === false) || ($count <= 0) || ($row[0] != 199) ||
        (($retValue != 11) && ($retValue != 22)))
    {
        Trace("Row count = $count, Returned value = $retValue\n");
        return (false);
    }
    return (true);
}

//--------------------------------------------------------------------
// Repro
//
//--------------------------------------------------------------------
function Repro()
{
    try
    {
        StoredProc();
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
}

Repro();

?>
--EXPECT--
Test "Stored Proc Call" completed successfully.
