<?php
$host = "localhost";
$user = "root";      // default XAMPP
$pass = "";          // kosong jika belum diset
$db   = "db_konversi";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
