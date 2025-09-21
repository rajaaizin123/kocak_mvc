<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "kampus";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$host = $_SERVER['HTTP_HOST'];
$folder = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

define('BASEURL', 'http://' . $host . $folder);