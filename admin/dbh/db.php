<?php

// define('SERVER_NAME', 'localhost');
// define('DB_USER', 'root');
// define('DB_PASSWORD', '');
// define('DB_NAME', 'gyedi_enterprise');

define('SERVER_NAME', 'sdb-54.hosting.stackcp.net');
define('DB_USER', 'gyedi_user');
define('DB_PASSWORD', ':O@sCTrqmDyA');
define('DB_NAME', 'gyedi_enterprise-35303036fd88');

$db = mysqli_connect(SERVER_NAME, DB_USER, DB_PASSWORD, DB_NAME);

if(!$db){
    die('Database connection failed');
}