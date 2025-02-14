<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'm&m pharmacy';

$connection = mysqli_connect($hostname, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection Failed" . $connection->connect_error);
}
