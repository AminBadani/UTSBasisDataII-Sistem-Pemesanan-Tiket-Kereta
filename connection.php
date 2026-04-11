<?php

error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_tiket_kereta";

$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
    die("Koneksi gagal " . mysqli_connect_error());
}

?>