--TEST--
Test the bindColumn method using either by bind by column number or bind by column name
--SKIPIF--
<?php require "skipif.inc"; ?>
--FILE--
<?php

require_once "MsCommon.inc";

function bindColumn_byName($db)
{
    global $table1;
    $stmt = $db->prepare("SELECT IntCol, CharCol, DateTimeCol FROM " . $table1);
    $stmt->execute();
    $stmt->bindColumn('IntCol', $intCol);
    $stmt->bindColumn('CharCol', $charCol);
    $stmt->bindColumn('DateTimeCol', $dateTimeCol);
    
    while($row = $stmt->fetch(PDO::FETCH_BOUND))
    {
        echo $intCol . " : " . $charCol . " : " . $dateTimeCol . "\n";
    }
}

function bindColumn_byNumber($db)
{
    global $table1;
    $stmt = $db->prepare("SELECT IntCol, CharCol, DateTimeCol FROM " . $table1);
    $stmt->execute();
    $stmt->bindColumn(1, $intCol);
    $stmt->bindColumn(2, $charCol);
    $stmt->bindColumn(3, $dateTimeCol);
    
    while($row = $stmt->fetch(PDO::FETCH_BOUND))
    {
        echo $intCol . " : " . $charCol . " : " . $dateTimeCol . "\n";
    }
}

try
{
    $db = connect();
    echo "Bind Column by name :\n";
    bindColumn_byName($db);
    echo "Bind Column by number :\n";
    bindColumn_byNumber($db);
    
}
catch (PDOException $e)
{
    var_dump($e);
}

?>
--EXPECT--
Bind Column by name :
1 : STRINGCOL1 : 2000-11-11 11:11:11.110
2 : STRINGCOL2 : 2000-11-11 11:11:11.223
Bind Column by number :
1 : STRINGCOL1 : 2000-11-11 11:11:11.110
2 : STRINGCOL2 : 2000-11-11 11:11:11.223