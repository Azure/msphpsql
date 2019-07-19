--TEST--
Test that right braces are escaped correctly and that error messages are correct when they're not
--SKIPIF--
<?php require('skipif.inc'); ?>
--FILE--
<?php
$server = 'fakeserver';
$uid = 'sa';
$password = 'fakepassword';

// If the braces are fine, then we expect the connection to fail with a login timeout error
$braceError = "An unescaped right brace (}) was found";
$connError = "Could not open a connection to SQL Server";

// Every combination of one, two, three, or more right braces I can think of
$testStrings = array(array("test", $connError),
                     array("{test}", $connError),
                     array("{test", $connError),
                     array("test}", $braceError),
                     array("{{test}}", $braceError),
                     array("{{test}", $connError),
                     array("{{test", $connError),
                     array("test}}", $connError),
                     array("{test}}", $braceError),
                     array("test}}}", $braceError),
                     array("{test}}}", $connError),
                     array("{test}}}}", $braceError),
                     array("{test}}}}}", $connError),
                     array("{test}}}}}}", $braceError),
                     array("te}st", $braceError),
                     array("{te}st}", $braceError),
                     array("{te}}st}", $connError),
                     array("{te}}}st}", $braceError),
                     array("te}}s}t", $braceError),
                     array("te}}s}}t", $connError),
                     array("te}}}st", $braceError),
                     array("te}}}}st", $connError),
                     array("tes}}t", $connError),
                     array("te}s}}t", $braceError),
                     array("tes}}t}}", $connError),
                     array("tes}}t}}}", $braceError),
                     array("tes}t}}", $braceError),
                     );

foreach ($testStrings as $test) {

    $conn = sqlsrv_connect($server, array('uid'=>$test[0], 'pwd'=>$password, 'LoginTimeout'=>1));
    echo $test[0]."\n";

    if (strpos(sqlsrv_errors()[0][2], $test[1]) === false) {
        print_r("Wrong error message returned. Expected ".$test[1].", actual output:\n");
        print_r(sqlsrv_errors());
    } 

    unset($conn);
}

echo "Done.\n";
?>
--EXPECT--
Done.
