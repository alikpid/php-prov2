<?php
$host = 'localhost';
$database = 'hotel';
$user = 'root';
$mysqli = mysqli_connect($host, $user, NULL, $database);

if(mysqli_errno($mysqli)) {
    echo "Извините:" . mysqli_connect_error();
}