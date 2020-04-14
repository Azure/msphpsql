--TEST--
Test another ANSI encoding fr_FR euro locale outside Windows
--DESCRIPTION--
This file must be saved in ANSI encoding and the required locale must be present
--ENV--
PHPT_EXEC=true
--SKIPIF--
<?php require('skipif_unix_ansitests.inc'); ?>
--FILE--
<?php

function insertData($conn, $tableName, $inputs)
{
    try {
        $tsql = "INSERT INTO $tableName (id, phrase) VALUES (?, ?)";
        $stmt = $conn->prepare($tsql);
        
        for ($i = 0; $i < count($inputs); $i++) {
            $stmt->execute(array($i, $inputs[$i]));
        }
    } catch( PDOException $e ) {
        echo "Failed to insert data\n";
        print_r( $e->getMessage() );
    }
}

function dropTable($conn, $tableName)
{
    $tsql = "IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'" . $tableName . "') AND type in (N'U')) DROP TABLE $tableName";
    $conn->exec($tsql);
}

require_once('MsSetup.inc');

try {
    $locale = 'fr_FR@euro';
    setlocale(LC_ALL, $locale);
    
    $conn = new PDO("sqlsrv:server = $server; database=$databaseName; driver=$driver", $uid, $pwd);
    $conn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_SYSTEM);
    $tableName = "pdo_ansitest_FR";

    dropTable($conn, $tableName);
    
    $tsql = "CREATE TABLE $tableName([id] [int] NOT NULL, [phrase] [varchar](50) NULL)";
    $conn->exec($tsql);
    
    $inputs = array("� tout � l'heure!", 
                    "Je suis d�sol�.", 
                    "� plus!", 
                    " Je dois aller � l'�cole.");

    // Next, insert the strings
    insertData($conn, $tableName, $inputs);

    // Next, fetch the strings
    $tsql = "SELECT phrase FROM $tableName ORDER by id";
    $stmt = $conn->query($tsql);

    $results = $stmt->fetchAll(PDO::FETCH_NUM);
    for ($i = 0; $i < count($inputs); $i++) {
        if ($results[$i][0] !== $inputs[$i]) {
            echo "Unexpected phrase retrieved:\n";
            var_dump($results[$i][0]);
        }
    }

    dropTable($conn, $tableName);

    unset($stmt);
    unset($conn);
} catch (PDOException $e) {
    print_r($e->getMessage());
}

echo "Done" . PHP_EOL;
?>
--EXPECT--
Done
