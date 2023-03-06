<?php
$host = 'localhost';
$database = 'hotel';
$user = 'root';
$mysqli = mysqli_connect($host, $user, 'QWEasd123', $database);
if(mysqli_errno($mysqli)) {
    echo "Извините:" . mysqli_connect_error();
}
mysqli_query($mysqli, "SET NAMES 'utf8mb4'");