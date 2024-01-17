<?php

define('SERVER_NAME', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'gyedi_enterprise');

$db = mysqli_connect(SERVER_NAME, DB_USER, DB_PASSWORD, DB_NAME);

if(!$db){
    die('Database connection failed');
}