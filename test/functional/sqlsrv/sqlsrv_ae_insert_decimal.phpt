--TEST--
Test for inserting into and retrieving from decimal columns of different scale
--SKIPIF--
<?php require('skipif_versions_old.inc'); ?>
--FILE--
<?php
require_once('MsHelper.inc');

$num = array("-10.0", "13.33", "-191.78464696202265", "833.33", "-850.00000000000006", "851.64835164835168", "-316053.16053160531", "505505.5055055055055055055", "-1535020.0615", "7501300.675013006750130067501300675", "-7540010.067540010067540010067540010067", "7540450.0675404500675404500675404500", "-820012820012820.01282001282001282001282", "1122551511225515.1122", "-1234567892112345678912.3456", "123456789012346261234567890123.4629", "-13775323913775323913775323913775323913", "9876");
$frac = array("-0.000", "0.100", "-0.1333", "0.019178464696202265", "-0.083333", "0.085000000000000006", "-0.085164835164835168", "0.0000316", "-0.00005", "0.0000153502", "-0.0000075013", "0.00000754001", "-0.00000754045", "0.000000000008200", "-0.00000000000000112255", "0.00000000000000000000123456789", "-0.00000000000000000000000123456789012346", "0.00000000000000000000000000000001377532", "-0.99");
$numSets = array("Testing numbers greater than 1 or less than -1:" => $num,
                 "Testing numbers between 1 and -1:" => $frac);
$scalesToTest = array(0, 1, 2, 3, 4, 5, 7, 9, 19, 28, 38);

try {
    $conn = AE\connect();
    $tbname = "decimalTable";
    foreach ($numSets as $testName => $numSet) {
        echo "\n$testName\n";
        foreach ($numSet as $input) {
            $numInt = ceil(log10(abs($input) + 1));
            $decimalTypes = array();
            foreach ($scalesToTest as $scale) {
                if ($scale < 39 - $numInt) {
                    array_push($decimalTypes, new AE\ColumnMeta("decimal(38, $scale)", "c$scale"));
                }
            }
            if (empty($decimalTypes)) {
                $decimalTypes = array(new AE\ColumnMeta("decimal(38, 0)", "c0"));
            }
            AE\createTable($conn, $tbname, $decimalTypes);

            $insertValues = array();
            foreach ($decimalTypes as $decimalType) {
                $insertValues = array_merge($insertValues, array($decimalType->colName => $input));
            }
            AE\insertRow($conn, $tbname, $insertValues);

            $stmt = sqlsrv_query($conn, "SELECT * FROM $tbname");
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            foreach ($row as $key => $value) {
                if ($value != 0) {
                    echo "$key: $value\n";
                }
            }
            sqlsrv_query($conn, "TRUNCATE TABLE $tbname");
        }
    }
    dropTable($conn, $tbname);
    sqlsrv_close($conn);
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>
--EXPECT--

Testing numbers greater than 1 or less than -1:
c0: -10
c1: -10.0
c2: -10.00
c3: -10.000
c4: -10.0000
c5: -10.00000
c7: -10.0000000
c9: -10.000000000
c19: -10.0000000000000000000
c28: -10.0000000000000000000000000000
c0: 13
c1: 13.3
c2: 13.33
c3: 13.330
c4: 13.3300
c5: 13.33000
c7: 13.3300000
c9: 13.330000000
c19: 13.3300000000000000000
c28: 13.3300000000000000000000000000
c0: -192
c1: -191.8
c2: -191.78
c3: -191.785
c4: -191.7846
c5: -191.78465
c7: -191.7846470
c9: -191.784646962
c19: -191.7846469620226500000
c28: -191.7846469620226500000000000000
c0: 833
c1: 833.3
c2: 833.33
c3: 833.330
c4: 833.3300
c5: 833.33000
c7: 833.3300000
c9: 833.330000000
c19: 833.3300000000000000000
c28: 833.3300000000000000000000000000
c0: -850
c1: -850.0
c2: -850.00
c3: -850.000
c4: -850.0000
c5: -850.00000
c7: -850.0000000
c9: -850.000000000
c19: -850.0000000000000600000
c28: -850.0000000000000600000000000000
c0: 852
c1: 851.6
c2: 851.65
c3: 851.648
c4: 851.6484
c5: 851.64835
c7: 851.6483516
c9: 851.648351648
c19: 851.6483516483516800000
c28: 851.6483516483516800000000000000
c0: -316053
c1: -316053.2
c2: -316053.16
c3: -316053.161
c4: -316053.1605
c5: -316053.16053
c7: -316053.1605316
c9: -316053.160531605
c19: -316053.1605316053100000000
c28: -316053.1605316053100000000000000000
c0: 505506
c1: 505505.5
c2: 505505.51
c3: 505505.506
c4: 505505.5055
c5: 505505.50551
c7: 505505.5055055
c9: 505505.505505506
c19: 505505.5055055055055055055
c28: 505505.5055055055055055055000000000
c0: -1535020
c1: -1535020.1
c2: -1535020.06
c3: -1535020.062
c4: -1535020.0615
c5: -1535020.06150
c7: -1535020.0615000
c9: -1535020.061500000
c19: -1535020.0615000000000000000
c28: -1535020.0615000000000000000000000000
c0: 7501301
c1: 7501300.7
c2: 7501300.68
c3: 7501300.675
c4: 7501300.6750
c5: 7501300.67501
c7: 7501300.6750130
c9: 7501300.675013007
c19: 7501300.6750130067501300675
c28: 7501300.6750130067501300675013006750
c0: -7540010
c1: -7540010.1
c2: -7540010.07
c3: -7540010.068
c4: -7540010.0675
c5: -7540010.06754
c7: -7540010.0675400
c9: -7540010.067540010
c19: -7540010.0675400100675400101
c28: -7540010.0675400100675400100675400101
c0: 7540450
c1: 7540450.1
c2: 7540450.07
c3: 7540450.068
c4: 7540450.0675
c5: 7540450.06754
c7: 7540450.0675405
c9: 7540450.067540450
c19: 7540450.0675404500675404501
c28: 7540450.0675404500675404500675404500
c0: -820012820012820
c1: -820012820012820.0
c2: -820012820012820.01
c3: -820012820012820.013
c4: -820012820012820.0128
c5: -820012820012820.01282
c7: -820012820012820.0128200
c9: -820012820012820.012820013
c19: -820012820012820.0128200128200128200
c0: 1122551511225515
c1: 1122551511225515.1
c2: 1122551511225515.11
c3: 1122551511225515.112
c4: 1122551511225515.1122
c5: 1122551511225515.11220
c7: 1122551511225515.1122000
c9: 1122551511225515.112200000
c19: 1122551511225515.1122000000000000000
c0: -1234567892112345678912
c1: -1234567892112345678912.3
c2: -1234567892112345678912.35
c3: -1234567892112345678912.346
c4: -1234567892112345678912.3456
c5: -1234567892112345678912.34560
c7: -1234567892112345678912.3456000
c9: -1234567892112345678912.345600000
c0: 123456789012346261234567890123
c1: 123456789012346261234567890123.5
c2: 123456789012346261234567890123.46
c3: 123456789012346261234567890123.463
c4: 123456789012346261234567890123.4629
c5: 123456789012346261234567890123.46290
c7: 123456789012346261234567890123.4629000
c0: -13775323913775323913775323913775323913
c0: 9876
c1: 9876.0
c2: 9876.00
c3: 9876.000
c4: 9876.0000
c5: 9876.00000
c7: 9876.0000000
c9: 9876.000000000
c19: 9876.0000000000000000000
c28: 9876.0000000000000000000000000000

Testing numbers between 1 and -1:
c1: .1
c2: .10
c3: .100
c4: .1000
c5: .10000
c7: .1000000
c9: .100000000
c19: .1000000000000000000
c28: .1000000000000000000000000000
c1: -.1
c2: -.13
c3: -.133
c4: -.1333
c5: -.13330
c7: -.1333000
c9: -.133300000
c19: -.1333000000000000000
c28: -.1333000000000000000000000000
c2: .02
c3: .019
c4: .0192
c5: .01918
c7: .0191785
c9: .019178465
c19: .0191784646962022650
c28: .0191784646962022650000000000
c1: -.1
c2: -.08
c3: -.083
c4: -.0833
c5: -.08333
c7: -.0833330
c9: -.083333000
c19: -.0833330000000000000
c28: -.0833330000000000000000000000
c1: .1
c2: .09
c3: .085
c4: .0850
c5: .08500
c7: .0850000
c9: .085000000
c19: .0850000000000000060
c28: .0850000000000000060000000000
c1: -.1
c2: -.09
c3: -.085
c4: -.0852
c5: -.08516
c7: -.0851648
c9: -.085164835
c19: -.0851648351648351680
c28: -.0851648351648351680000000000
c5: .00003
c7: .0000316
c9: .000031600
c19: .0000316000000000000
c28: .0000316000000000000000000000
c4: -.0001
c5: -.00005
c7: -.0000500
c9: -.000050000
c19: -.0000500000000000000
c28: -.0000500000000000000000000000
c5: .00002
c7: .0000154
c9: .000015350
c19: .0000153502000000000
c28: .0000153502000000000000000000
c5: -.00001
c7: -.0000075
c9: -.000007501
c19: -.0000075013000000000
c28: -.0000075013000000000000000000
c5: .00001
c7: .0000075
c9: .000007540
c19: .0000075400100000000
c28: .0000075400100000000000000000
c5: -.00001
c7: -.0000075
c9: -.000007540
c19: -.0000075404500000000
c28: -.0000075404500000000000000000
c19: .0000000000082000000
c28: .0000000000082000000000000000
c19: -.0000000000000011226
c28: -.0000000000000011225500000000
c28: .0000000000000000000012345679
c38: .00000000000000000000123456789000000000
c28: -.0000000000000000000000012346
c38: -.00000000000000000000000123456789012346
c38: .00000000000000000000000000000001377532
c0: -1
c1: -1.0
c2: -.99
c3: -.990
c4: -.9900
c5: -.99000
c7: -.9900000
c9: -.990000000
c19: -.9900000000000000000
c28: -.9900000000000000000000000000