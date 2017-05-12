--TEST--
inserting and retrieving UTF-8 text.
--SKIPIF--
<?php require('skipif.inc'); ?>
--FILE--
<?php

sqlsrv_configure( 'WarningsReturnAsErrors', 0 );
sqlsrv_configure( 'LogSeverity', SQLSRV_LOG_SEVERITY_ALL );

// For testing in Azure, can not switch databases
require( 'MsCommon.inc' );
$c = Connect();

if( $c === false ) {
    die( print_r( sqlsrv_errors(), true ));
}

$s = sqlsrv_query( $c, "IF OBJECT_ID('utf8test', 'U') IS NOT NULL DROP TABLE utf8test" );

// test a varchar, nvarchar non max, and nvarchar max
$s = sqlsrv_query( $c, "CREATE TABLE utf8test (c1 varchar(100), c2 nvarchar(100), c3 nvarchar(max))");
if( $s === false ) {
    die( print_r( sqlsrv_errors(), true ));
}

$utf8 = "Şơмė śäოрŀề ΆŚĈĨİ-ť℮×ŧ";

$s = sqlsrv_query( $c, "INSERT INTO utf8test (c1, c2, c3) VALUES (?,?,?)",
                   array(
                       array( &$utf8, SQLSRV_PARAM_IN, SQLSRV_PHPTYPE_STRING('utf-8')),
                       array( &$utf8, SQLSRV_PARAM_IN, SQLSRV_PHPTYPE_STRING('utf-8')),
                       array( &$utf8, SQLSRV_PARAM_IN, SQLSRV_PHPTYPE_STRING('utf-8')) ));
if( $s === false ) {
    die( print_r( sqlsrv_errors(), true ));
}

$s = sqlsrv_query( $c, 
"DROP PROCEDURE IntDoubleProc;
DROP PROCEDURE Utf8OutProc;
DROP PROCEDURE Utf8OutWithResultsetProc;
DROP PROCEDURE Utf8InOutProc;
DROP TABLE Utf8TestTable;" );

$create_proc = <<<PROC
CREATE PROCEDURE Utf8OutProc
	@param nvarchar(25) OUTPUT
AS
BEGIN
    set @param = convert(nvarchar(25), 0x5E01A1013C04170120005B01E400DD1040044001C11E200086035A010801280130012D0065012E21D7006701);
END;
PROC;
$s = sqlsrv_query( $c, $create_proc );
if( $s === false ) {
    die( print_r( sqlsrv_errors(), true ));
}

$create_proc = <<<PROC
CREATE PROCEDURE Utf8OutWithResultsetProc
	@param nvarchar(25) output
AS
BEGIN
	select c1, c2, c3 from utf8test
    set @param = convert(nvarchar(25), 0x5E01A1013C04170120005B01E400DD1040044001C11E200086035A010801280130012D0065012E21D7006701);
END;
PROC;
$s = sqlsrv_query( $c, $create_proc );
if( $s === false ) {
    die( print_r( sqlsrv_errors(), true ));
}

$create_proc = <<<PROC
CREATE PROCEDURE Utf8InOutProc
	@param nvarchar(25) output
AS
BEGIN
    -- INSERT INTO utf8test (c1, c2, c3) VALUES (@param, @param, @param);
    set @param = convert(nvarchar(25), 0x6001E11EDD10130120006101E200DD1040043A01BB1E2000C5005A01C700CF0007042D006501BF1E45046301);
END;
PROC;
$s = sqlsrv_query( $c, $create_proc );
if( $s === false ) {
    die( print_r( sqlsrv_errors(), true ));
}

$create_proc = <<<PROC
CREATE PROCEDURE IntDoubleProc
	@param int output
AS
BEGIN
    set @param = @param + @param;
END;
PROC;
$s = sqlsrv_query( $c, $create_proc );
if( $s === false ) {
    die( print_r( sqlsrv_errors(), true ));
}

$s = sqlsrv_query( $c, 'SELECT c1, c2, c3 FROM utf8test' );
if( $s === false ) {
    die( print_r( sqlsrv_errors(), true ));
}

if( sqlsrv_fetch( $s ) === false ) {
    die( print_r( sqlsrv_errors(), true ));
}

$t = sqlsrv_get_field( $s, 0, SQLSRV_PHPTYPE_STRING( 'utf-8' ));
if( $t === false ) {
    die( print_r( sqlsrv_errors(), true ));
}

if( $t != "So?e sä???? ?SCII-te×t" ) {
    die( "varchar(100) doesn't match So?e sä???? ?SCII-te×t" );
}

$t = sqlsrv_get_field( $s, 1, SQLSRV_PHPTYPE_STRING( 'utf-8' ));
if( $t === false ) {
    die( print_r( sqlsrv_errors(), true ));
}

if( $t != $utf8 ) {
    die( "nvarchar(100) doesn't match the inserted UTF-8 text." );
}

$t = sqlsrv_get_field( $s, 2, SQLSRV_PHPTYPE_STRING( 'utf-8' ));
if( $t === false ) {
    die( print_r( sqlsrv_errors(), true ));
}

if( $t != $utf8 ) {
    die( "nvarchar(max) doesn't match the inserted UTF-8 text." );
}

sqlsrv_free_stmt( $s );

// test proc to baseline with
$t = 1;

$s = sqlsrv_query( $c, "{call IntDoubleProc(?)}", array( array( &$t, SQLSRV_PARAM_INOUT, SQLSRV_PHPTYPE_INT )));

if( $s === false ) {
    die( print_r( sqlsrv_errors(), true ));
}
if( $t != 2 ) {
    die( "Incorrect results for IntDoubleProc" );
}

$t = "";

// output param with immediate conversion
$s = sqlsrv_query( $c, "{call Utf8OutProc(?)}",
                   array( array( &$t, SQLSRV_PARAM_OUT, SQLSRV_PHPTYPE_STRING('utf-8'), SQLSRV_SQLTYPE_NVARCHAR(50)) ));

if( $s === false ) {
    echo "{call Utf8OutProc(?)} failed\n";
    die( print_r( sqlsrv_errors(), true ));
}

if( $t != $utf8 ) {
    die( "Incorrect results from Utf8OutProc\n" );
}

$t = "";

$s = sqlsrv_query( $c, "{call Utf8OutWithResultsetProc(?)}",
                   array( array( &$t, SQLSRV_PARAM_OUT, SQLSRV_PHPTYPE_STRING('utf-8'), SQLSRV_SQLTYPE_NVARCHAR(50)) ));

if( $s === false ) {
    die( print_r( sqlsrv_errors(), true ));
}

// retrieve all the results
while( sqlsrv_next_result( $s ));

if( $t != $utf8 ) {
    die( "Incorrect results from Utf8OutWithResultsetProc\n" );
}

// another set of UTF-8 text to try
$utf8 = "Šỡოē šâოрĺẻ ÅŚÇÏЇ-ťếхţ";

// this input string is smaller than the output size for testing
$t = "This is a test.";

// this works
$s = sqlsrv_query( $c, "{call Utf8InOutProc(?)}",
                   array( array( &$t, SQLSRV_PARAM_INOUT, SQLSRV_PHPTYPE_STRING('utf-8'), SQLSRV_SQLTYPE_NVARCHAR(25)) ));

if( $s === false ) {
    die( print_r( sqlsrv_errors(), true ));
}

if( $t != $utf8 ) {
    die( "Incorrect results from Utf8InOutProc 1\n" );
}


$t = "This is a longer test that exceeds the returned values buffer size so that we can test an input buffer size larger than the output buffer size.";

// this returns an error 22001, meaning that the string is too large
$s = sqlsrv_query( $c, "{call Utf8InOutProc(?)}",
                   array( array( &$t, SQLSRV_PARAM_INOUT, SQLSRV_PHPTYPE_STRING('utf-8'), SQLSRV_SQLTYPE_NVARCHAR(25)) ));

if( $s !== false ) {
    die( "Should have failed since the string is too long" );
}

print_r( sqlsrv_errors() );

$t = pack( 'H*', '7a61cc86c7bdceb2f18fb3bf' );

$s = sqlsrv_query( $c, "INSERT INTO utf8test (c1, c2, c3) VALUES (?,?,?)",
                   array(
                       array( &$t, SQLSRV_PARAM_IN, SQLSRV_PHPTYPE_STRING('utf-8')),
                       array( &$t, SQLSRV_PARAM_IN, SQLSRV_PHPTYPE_STRING('utf-8')),
                       array( &$t, SQLSRV_PARAM_IN, SQLSRV_PHPTYPE_STRING('utf-8')) ));
if( $s === false ) {
    die( print_r( sqlsrv_errors(), true ));
}
print_r( sqlsrv_errors() );

$s = sqlsrv_query( $c, 'SELECT c1, c2, c3 FROM utf8test' );
if( $s === false ) {
    die( print_r( sqlsrv_errors(), true ));
}

if( sqlsrv_fetch( $s ) === false ) {
    die( print_r( sqlsrv_errors(), true ));
}
// move to the second row
if( sqlsrv_fetch( $s ) === false ) {
    die( print_r( sqlsrv_errors(), true ));
}

$u = sqlsrv_get_field( $s, 1, SQLSRV_PHPTYPE_STRING( 'utf-8' ));
if( $u === false ) {
    die( print_r( sqlsrv_errors(), true ));
}

if( $t !== $u ) {
    die( "Round trip failed." );
}

$t = pack( 'H*', 'ffffffff' );

$s = sqlsrv_query( $c, "{call IntProc(?)}", array( array( &$t, SQLSRV_PARAM_IN, SQLSRV_PHPTYPE_STRING('utf-8'))));
if( $s !== false ) {
    die( "no error from an invalid utf-8 string" );
}
print_r( sqlsrv_errors() );

sqlsrv_close( $c );

echo "Test succeeded.\n";

?>
--EXPECTF--
Array
(
    [0] => Array
        (
            [0] => 22001
            [SQLSTATE] => 22001
            [1] => 0
            [code] => 0
            [2] => %SString data, right truncation
            [message] => %SString data, right truncation
        )

)
Array
(
    [0] => Array
        (
            [0] => IMSSP
            [SQLSTATE] => IMSSP
            [1] => -40
            [code] => -40
            [2] => An error occurred translating string for input param 1 to UCS-2: %a
            [message] => An error occurred translating string for input param 1 to UCS-2: %a
        )

)
Test succeeded.
