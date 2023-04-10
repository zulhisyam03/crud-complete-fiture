<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "crud";
$koneksi = mysqli_connect($host, $user, $password, $database);

// Query untuk mengambil data Dari Tabel
$query = "SELECT * FROM crud";
$result = mysqli_query($koneksi, $query);
