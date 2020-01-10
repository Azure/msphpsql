--TEST--
Test rich computations and in-place encryption of plaintext with AE v2.
--DESCRIPTION--
This test cycles through $encryptionTypes and $keys, creating a plaintext table
each time, then trying to encrypt it with different combinations of enclave-enabled and non-enclave keys
and encryption types. It then cycles through $targetTypes and $targetKeys to try re-encrypting
the table with different target combinations of enclave-enabled and non-enclave keys
and encryption types.
The sequence of operations is the following:
1. Create a table in plaintext with two columns for each AE-supported data type.
2. Insert some data in plaintext.
3. Encrypt one column for each data type.
4. Perform rich computations on each AE-enabled column (comparisons and pattern matching) and compare the result
   to the same query on the corresponding non-AE column for each data type.
5. Ensure the two results are the same.
6. Re-encrypt the table using new key and/or encryption type.
7. Compare computations as in 4. above.
--SKIPIF--
<?php require("skipif_not_hgs.inc"); ?>
--FILE--
<?php
require_once("MsSetup.inc");
require_once("AE_v2_values.inc");
require_once("pdo_AE_functions.inc");

$initialAttestation = $attestation;

// Create a table for each key and encryption type, re-encrypt using each
// combination of target key and target encryption
foreach ($ceValues as $attestationType=>$ceValue) {
    
    // Cannot create a table with encrypted data if CE is disabled
    // TODO: Since we can create an empty encrypted table with 
    // CE disabled, account for the case where CE is disabled.
    if ($ceValue == 'disabled') continue;
    
    foreach ($keys as $key) {
        foreach ($encryptionTypes as $encryptionType) {
            
            // $count is used to ensure we only run testCompare and
            // testPatternMatch once for the initial table
            $count = 0;

            foreach ($targetCeValues as $targetAttestationType=>$targetCeValue) {
                foreach ($targetKeys as $targetKey) {
                    foreach ($targetTypes as $targetType) {
                        
                        $conn = connect($server, $ceValue);
                        if (!$conn) {
                            if ($attestationType == 'invalid') {
                                continue;
                            } else {
                                die("Connection failed when it shouldn't have\n");
                            }
                        } elseif ($attestationType == 'invalid') {
                            die("Connection should have failed for invalid protocol\n");
                        }
                        
                        // Free the encryption cache to avoid spurious 'operand type clash' errors
                        $conn->query("DBCC FREEPROCCACHE");

                        // Create and populate an encrypted table
                        $createQuery = constructAECreateQuery($tableName, $dataTypes1, $colNames1, $colNamesAE1, $slength, $key, $encryptionType);
                        $insertQuery = constructInsertQuery($tableName, $dataTypes1, $colNames1, $colNamesAE1);

                        try {
                            $stmt = $conn->query("DROP TABLE IF EXISTS $tableName");
                            $stmt = $conn->query($createQuery);
                        } catch(Exception $error) {
                            print_r($error);
                            die("Creating an encrypted table failed when it shouldn't have!\n");
                        }

                        $ceDisabled = $attestationType == 'disabled' ? true : false;
                        insertValues($conn, $insertQuery, $dataTypes1, $testValues, $ceDisabled);
                        
                        $isEncrypted = true;

                        // Test rich computations
                        if ($count == 0) {
                            testCompare($conn, $tableName, $comparisons, $dataTypes1, $colNames1, $thresholds, $length, $key, $encryptionType, $attestationType, $isEncrypted);
                            testPatternMatch($conn, $tableName, $patterns, $dataTypes1, $colNames1, $key, $encryptionType, $attestationType, $isEncrypted);
                        }
                        ++$count;

                        // $sameKeyAndType is used when checking re-encryption, because no error is returned
                        $sameKeyAndType = false;
                        if ($key == $targetKey and $encryptionType == $targetType and $isEncrypted) {
                            $sameKeyAndType = true;
                        }

                        // Disconnect and reconnect with the target ColumnEncryption keyword value
                        unset($conn);

                        $conn = connect($server, $targetCeValue);
                        if (!$conn) {
                            if ($targetAttestationType == 'invalid') {
                                continue;
                            } else {
                                die("Connection failed when it shouldn't have\n");
                            }
                        } elseif ($targetAttestationType == 'invalid') {
                            continue;
                        }

                        testCompare($conn, $tableName, $comparisons, $dataTypes1, $colNames1, $thresholds, $length, $key, $encryptionType, $targetAttestationType, $isEncrypted);
                        testPatternMatch($conn, $tableName, $patterns, $dataTypes1, $colNames1, $key, $encryptionType, $targetAttestationType, $isEncrypted);

                        // Re-encrypt the table
                        $initiallyEnclaveEncryption = isEnclaveEnabled($key);

                        // Split the data type array, because for some reason we get an error
                        // if the query is too long (>2000 characters)
                        // TODO: This is a known issue, follow up on it.
                        $splitdataTypes = array_chunk($dataTypes1, 5);
                        foreach ($splitdataTypes as $split) {
                            $alterQuery = constructAlterQuery($tableName, $colNamesAE1, $split, $targetKey, $targetType, $slength);
                            $encryptionSucceeded = encryptTable($conn, $alterQuery, $targetKey, $targetType, $targetAttestationType, $sameKeyAndType, true, $initiallyEnclaveEncryption);
                        }

                        // Test rich computations
                        if ($encryptionSucceeded) {
                            testCompare($conn, $tableName, $comparisons, $dataTypes1, $colNames1, $thresholds, $length, $targetKey, $targetType, $targetAttestationType,true);
                            testPatternMatch($conn, $tableName, $patterns, $dataTypes1, $colNames1, $targetKey, $targetType, $targetAttestationType, true);
                        } else {
                            testCompare($conn, $tableName, $comparisons, $dataTypes1, $colNames1, $thresholds, $length, $key, $encryptionType, $targetAttestationType, $isEncrypted);
                            testPatternMatch($conn, $tableName, $patterns, $dataTypes1, $colNames1, $key, $encryptionType, $targetAttestationType, $isEncrypted);
                        }
                        
                        unset($conn);
                    }
                }
            }
        }
    }
}

echo "Done.\n";

?>
--EXPECT--
Done.
