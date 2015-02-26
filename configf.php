<?php
 
define('BASE_PATH','Please use your own');
define('DB_HOST', 'Please use your own');
define('DB_NAME', 'Please use your own');
define('DB_USER','Please use your own');
define('DB_PASSWORD','Please use your own');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

?>
