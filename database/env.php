<?php 

// *Database host
define('DB_HOST', 'localhost');

// *Database Username
define('DB_USER', 'root');

// *Database password
define('DB_PSK', '');

// *Database name
define('DB_NAME', 'yummy_foods');

/*
// *Database host
define('DB_HOST', 'sql100.infinityfree.com ');

// *Database Username
define('DB_USER', 'if0_38316315');

// *Database password
define('DB_PSK', 'AB094dur');

// *Database name
define('DB_NAME', 'if0_38316315_yummy_foods ');
*/
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PSK, DB_NAME);