<?php
$servername = "localhost"; // Veritabanı sunucusu
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı şifresi
$dbname = "obs_system"; // Veritabanı adı
$port = 3309;

// Veritabanına bağlan
$conn = new mysqli($servername, $username, $password, $dbname,$port);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
