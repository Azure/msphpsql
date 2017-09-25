--TEST--
Test for inserting and retrieving encrypted data of money types
--DESCRIPTION--
Bind params using sqlsrv_prepare with all sql_type
--SKIPIF--
<?php require('skipif_versions_old.inc'); ?>
--FILE--
<?php
include 'MsCommon.inc';
include 'AEData.inc';

$dataTypes = array( "smallmoney", "money" );

// this is a list of implicit datatype conversion that SQL Server allows (https://docs.microsoft.com/en-us/sql/t-sql/data-types/data-type-conversion-database-engine)
$compatList = array( "smallmoney" => array( "SQLSRV_SQLTYPE_BINARY", "SQLSRV_SQLTYPE_VARBINARY", "SQLSRV_SQLTYPE_CHAR", "SQLSRV_SQLTYPE_VARCHAR", "SQLSRV_SQLTYPE_NCHAR", "SQLSRV_SQLTYPE_NVARCHAR", "SQLSRV_SQLTYPE_DATETIME", "SQLSRV_SQLTYPE_SMALLDATETIME", "SQLSRV_SQLTYPE_DECIMAL(18,5)", "SQLSRV_SQLTYPE_NUMERIC(10,5)", "SQLSRV_SQLTYPE_FLOAT", "SQLSRV_SQLTYPE_REAL", "SQLSRV_SQLTYPE_BIGINT", "SQLSRV_SQLTYPE_INT", "SQLSRV_SQLTYPE_SMALLINT", "SQLSRV_SQLTYPE_TINYINT", "SQLSRV_SQLTYPE_MONEY", "SQLSRV_SQLTYPE_SMALLMONEY", "SQLSRV_SQLTYPE_BIT", "SQLSRV_SQLTYPE_TIMESTAMP" ),
                     "money" => array( "SQLSRV_SQLTYPE_BINARY", "SQLSRV_SQLTYPE_VARBINARY", "SQLSRV_SQLTYPE_CHAR", "SQLSRV_SQLTYPE_VARCHAR", "SQLSRV_SQLTYPE_NCHAR", "SQLSRV_SQLTYPE_NVARCHAR", "SQLSRV_SQLTYPE_DATETIME", "SQLSRV_SQLTYPE_SMALLDATETIME", "SQLSRV_SQLTYPE_DECIMAL(18,5)", "SQLSRV_SQLTYPE_NUMERIC(10,5)", "SQLSRV_SQLTYPE_FLOAT", "SQLSRV_SQLTYPE_REAL", "SQLSRV_SQLTYPE_BIGINT", "SQLSRV_SQLTYPE_INT", "SQLSRV_SQLTYPE_SMALLINT", "SQLSRV_SQLTYPE_TINYINT", "SQLSRV_SQLTYPE_MONEY", "SQLSRV_SQLTYPE_SMALLMONEY", "SQLSRV_SQLTYPE_BIT", "SQLSRV_SQLTYPE_TIMESTAMP" ));

$conn = ae_connect();

foreach ( $dataTypes as $dataType ) {
    echo "\nTesting $dataType: \n";
    $success = true;
    
    // create table
    $tbname = GetTempTableName( "", false );
    $colMetaArr = array( new columnMeta( $dataType, "c_det" ), new columnMeta( $dataType, "c_rand", null, "randomized" ));
    create_table( $conn, $tbname, $colMetaArr );
    
    // test each SQLSRV_SQLTYPE_ constants
    foreach ( $sqlTypes as $sqlType )
    {
        // insert a row
        $inputValues = array_slice( ${explode( "(", $dataType )[0] . "_params"}, 1, 2 );
        $sqlType = get_default_size_prec( $sqlType );
        $paramOp = array( new bindParamOption( 1, null, null, $sqlType ), new bindParamOption( 2, null, null, $sqlType ));
        $r;
        $stmt = insert_row( $conn, $tbname, array( $colMetaArr[0]->colName => $inputValues[0], $colMetaArr[1]->colName => $inputValues[1] ), $r, "prepareParamsOp", $paramOp );
        
        if ( !is_col_enc() )
        {
            if ( $r === false )
            {
                $isCompatible = false;
                foreach ( $compatList[$dataType] as $compatType )
                {
                    if ( stripos( $compatType, $sqlType ) !== false )
                        $isCompatible = true;
                }
                // 22018 is the SQLSTATE for any incompatible conversion errors
                if ( $isCompatible && sqlsrv_errors()[0]['SQLSTATE'] == 22018 )
                {
                    echo "$sqlType should be compatible with $dataType\n";
                    $success = false;
                }
            } 
        }
        else
        {
            if ( $r !== false )
            {
                echo "$dataType should not be compatible with any type.\n";
                $success = false;
            }   
        }
        sqlsrv_query( $conn, "TRUNCATE TABLE $tbname" );
    }
    if ( $success )
        echo "Test successfully done.\n";
    DropTable( $conn, $tbname );
}
sqlsrv_free_stmt( $stmt );
sqlsrv_close( $conn );
?>
--EXPECT--

Testing smallmoney: 
Test successfully done.

Testing money: 
Test successfully done.
