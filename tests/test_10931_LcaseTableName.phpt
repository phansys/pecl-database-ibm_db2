--TEST--
IBM-DB2: PECL bug 10931 -- no result for db2_columns with lowercase table name
--SKIPIF--
<?php
  require_once('skipif3.inc');
?>
--FILE--
<?php

require_once('connection.inc');

$conn = db2_connect($database, $user, $password);

if ($conn) {
		 $sql = "DROP TABLE \"TEST\".\"test_10931\"";
		 @db2_exec($conn, $sql);

		 $sql = "create table \"TEST\".\"test_10931\" ( \"id\" INTEGER not null generated BY DEFAULT AS identity (NOCACHE, INCREMENT BY 1), \"title\" VARCHAR(50), \"created\" TIMESTAMP DEFAULT CURRENT TIMESTAMP,  constraint P_USERS_U1 primary key (\"id\"))";
		 db2_exec($conn, $sql);

		 $stmt = @db2_columns ($conn ,null , 'TEST' , 'test_10931' , '%' );
		 if ( $stmt ) 
		 {
		 		 while ($rowC = db2_fetch_assoc($stmt)) 
		 		 {
		 		 		 var_dump( $rowC );
		 		 }
		 }
}
else {
		 echo "Connection failed.\n";
}

?>
--EXPECT--
array(18) {
  ["TABLE_CAT"]=>
  NULL
  ["TABLE_SCHEM"]=>
  string(4) "TEST"
  ["TABLE_NAME"]=>
  string(10) "test_10931"
  ["COLUMN_NAME"]=>
  string(2) "id"
  ["DATA_TYPE"]=>
  int(4)
  ["TYPE_NAME"]=>
  string(7) "INTEGER"
  ["COLUMN_SIZE"]=>
  int(10)
  ["BUFFER_LENGTH"]=>
  int(4)
  ["DECIMAL_DIGITS"]=>
  int(0)
  ["NUM_PREC_RADIX"]=>
  int(10)
  ["NULLABLE"]=>
  int(0)
  ["REMARKS"]=>
  NULL
  ["COLUMN_DEF"]=>
  NULL
  ["SQL_DATA_TYPE"]=>
  int(4)
  ["SQL_DATETIME_SUB"]=>
  NULL
  ["CHAR_OCTET_LENGTH"]=>
  NULL
  ["ORDINAL_POSITION"]=>
  int(1)
  ["IS_NULLABLE"]=>
  string(2) "NO"
}
array(18) {
  ["TABLE_CAT"]=>
  NULL
  ["TABLE_SCHEM"]=>
  string(4) "TEST"
  ["TABLE_NAME"]=>
  string(10) "test_10931"
  ["COLUMN_NAME"]=>
  string(5) "title"
  ["DATA_TYPE"]=>
  int(12)
  ["TYPE_NAME"]=>
  string(7) "VARCHAR"
  ["COLUMN_SIZE"]=>
  int(50)
  ["BUFFER_LENGTH"]=>
  int(50)
  ["DECIMAL_DIGITS"]=>
  NULL
  ["NUM_PREC_RADIX"]=>
  NULL
  ["NULLABLE"]=>
  int(1)
  ["REMARKS"]=>
  NULL
  ["COLUMN_DEF"]=>
  NULL
  ["SQL_DATA_TYPE"]=>
  int(12)
  ["SQL_DATETIME_SUB"]=>
  NULL
  ["CHAR_OCTET_LENGTH"]=>
  int(50)
  ["ORDINAL_POSITION"]=>
  int(2)
  ["IS_NULLABLE"]=>
  string(3) "YES"
}
array(18) {
  ["TABLE_CAT"]=>
  NULL
  ["TABLE_SCHEM"]=>
  string(4) "TEST"
  ["TABLE_NAME"]=>
  string(10) "test_10931"
  ["COLUMN_NAME"]=>
  string(7) "created"
  ["DATA_TYPE"]=>
  int(93)
  ["TYPE_NAME"]=>
  string(9) "TIMESTAMP"
  ["COLUMN_SIZE"]=>
  int(26)
  ["BUFFER_LENGTH"]=>
  int(16)
  ["DECIMAL_DIGITS"]=>
  int(6)
  ["NUM_PREC_RADIX"]=>
  NULL
  ["NULLABLE"]=>
  int(1)
  ["REMARKS"]=>
  NULL
  ["COLUMN_DEF"]=>
  string(17) "CURRENT TIMESTAMP"
  ["SQL_DATA_TYPE"]=>
  int(9)
  ["SQL_DATETIME_SUB"]=>
  int(3)
  ["CHAR_OCTET_LENGTH"]=>
  NULL
  ["ORDINAL_POSITION"]=>
  int(3)
  ["IS_NULLABLE"]=>
  string(3) "YES"
}
