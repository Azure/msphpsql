--TEST--
Complex Query Test
--DESCRIPTION--
Verifies the behavior of INSERT queries with and without the IDENTITY flag set.
--ENV--
PHPT_EXEC=true
--SKIPIF--
<?php require('skipif.inc'); ?>
--FILE--
<?php

include 'MsCommon.inc';

function ComplexQuery()
{
    include 'MsSetup.inc';

    $testName = "Statement - Complex Query";
    StartTest($testName);

    Setup();
    $conn1 = Connect();

    $dataTypes = "[c1_int] int IDENTITY, [c2_tinyint] tinyint, [c3_smallint] smallint, [c4_bigint] bigint, [c5_varchar] varchar(512)";
    CreateTableEx($conn1, $tableName, $dataTypes);

    Execute($conn1, true, "SET IDENTITY_INSERT [$tableName] ON;");
    Execute($conn1, true, "INSERT INTO [$tableName] (c1_int, c2_tinyint, c3_smallint, c4_bigint, c5_varchar) VALUES (-204401468, 168, 4787, 1583186637, '�<��C~z��a.Oa._ߣ*�<u_��C�oa �����a+O�h�obUa:zB_C�@~U�z+���//Z@�o_:r,o��r�zoZ�*ߪ��~ U�a>��ZU�/�_Z����h�C�+/.ob�|���,���:��:*/>+/�a�.��<�:>�O~*~��z�<����.O,>�,�b�@b�h�C*<<hb��*o��h���a+A/_@b/�B�B��@�~z�Z�C@�U_�U�hvU*a@���:�ZA�Ab�U_��b��:���or��ߪ_��֪z����oa� <�~zZ�aB.+�A���><�:/Ur �U��Oa�:a|++��.r~:/+�|��o++v_@BZ:��A�C�.�/Ab<,��>U����bb|��ߣ:�<<b��a+,<_a�._�>�<|�z�z@>��:a,C�r__�.<��C�+U�U�_�z� b�~�o|, .�,b/U>��aBZ@ܣ: b�v�b>�/��@��/�b�+r:Z�>��|�u��ZAC:C�h *.ã�_��u|Ur�.:aAUv@u>@<��.<�Z b�ZA�֣o���*,�:��')");
    Execute($conn1, true, "SET IDENTITY_INSERT [$tableName] OFF;"); 
    Execute($conn1, false,"INSERT INTO [$tableName] (c1_int, c2_tinyint, c3_smallint, c4_bigint, c5_varchar) VALUES (1264768176, 111, 23449, 1421472052, 'u�C@b�UOv~,�v,BZ�*oh>zb_���<@*OO�_�<�u�/o�r <��b�U�����~�~� bܩ�.u�Т�:|_���B�b����v@,<C�O�v~:+,CZ�vhC/o�Uu��a<�>�/Ub,+AЩ�:�r�B+~~�����+_<vO@ �����aCz���@:r�.~vh~r.�b���_�C�r B��:BbUv���Z+|,C�aA�C,a�bb*U���A hCu�hOb �|�C.<C<.aB�vu���,A�a>AB��U/O<����O�uߣ~u�+��rb�/:��o  /_�O:u�z�Uv�A�_B�/>UCr,�� a��aãv�Z@�r*_::~/+.�~�a��bz*z<~rU~O+Z|A<_B�ߩ�� ::.�b���r/�rh�:��U �OA~A�r<��v��+hC/v�oU�+O��*�B�.Zbh/�,��>*���U��>a�bBbv���/b�|�� u.z��~��z�U.UA*a*.�>� r� ~C��a�+r�~�@a�/�C�*a,��bb<o+v.�u<�B<�BZ��u�/_>*~')");
    Execute($conn1, true, "SET IDENTITY_INSERT [$tableName] ON;INSERT INTO [$tableName] (c1_int, c2_tinyint, c3_smallint, c4_bigint, c5_varchar) VALUES (-411114769, 198, 1378, 140345831, '�@�a�rêA*���A>_hO�v@|h~O<�+*��Cbaz�a�Z/��:��u��az��Ah+u+r�:| U*������_v�@@~Ch��_�*AA�B��B,�b��.�B+u*CAv�,�>��CU<���rz�@�r�*�ub�B�a�@�.�Bv�o~ ��o o�u/>���,�,�aO��>�C:�Z>���<�+�r.bO.�,uA�r><ov:,�����+�./||CU��_�Īh~<�_�/hb� ĩuBu�<�@bo��B�C�A/��:� �U�*�vu�.B���o_�b�r_��>��ܣB�A�va�v��C�U�  �v�u�><��UC*a�U�r�hr+>|���|o�r�У<�<�|A�oh�A�_vu~:~��h�+�Bu�� �@Z+�@h��|@bU�_�/� |:�zb>@Uߩ  ��o �@��B�_�BOB��hC�b~�>�� r���Uzu�rbz�/��U��u�.�@�__vBb�/�r��u�z��*�/*�O');SET IDENTITY_INSERT [$tableName] OFF;"); 

    $stmt1 = SelectFromTable($conn1, $tableName);
    $rowCount = RowCount($stmt1);
    sqlsrv_free_stmt($stmt1);
    
    if ($rowCount != 2)
    {
        die("Table $tableName has $rowCount rows instead of 2.");
    }

    DropTable($conn1, $tableName);  
    
    sqlsrv_close($conn1);
    
    EndTest($testName);
}

function Execute($conn, $expectedOutcome, $query)
{
    Trace("Executing query ".ltrim(substr($query, 0, 40))." ... ");
    $stmt = ExecuteQueryEx($conn, $query, true);
    if ($stmt === false)
    {
        Trace("failed.\n");
        $actualOutcome = false;
    }
    else
    {
        Trace("succeeded.\n");
        sqlsrv_free_stmt($stmt);
        $actualOutcome = true;
    }
    if ($actualOutcome != $expectedOutcome)
    {
        die("Unexpected query execution outcome.");
    }
}

//--------------------------------------------------------------------
// Repro
//
//--------------------------------------------------------------------
function Repro()
{
    try
    {
        ComplexQuery();
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
}

Repro();

?>
--EXPECT--
Test "Statement - Complex Query" completed successfully.
