<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'rumah_makan_fix';

// Koneksi ke MySQL
$conn = new mysqli($host, $user, $pass);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Buat database jika belum ada
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

// Pilih database
$conn->select_db($dbname);

// Baca file SQL
$sql = file_get_contents('c:\xampp\htdocs\skripsi-dian-pnp\rumah_makan_fix.sql');

// Eksekusi SQL
if ($conn->multi_query($sql)) {
    echo "Database imported successfully\n";
} else {
    echo "Error importing database: " . $conn->error . "\n";
}

$conn->close();
