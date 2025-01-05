<?php
include "connect.php";
$username = $_SESSION['username'];

// Öğrenci bilgilerini çekmek için SQL sorgusu
$sql = "SELECT * FROM ogrenciler WHERE username = '$username'";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Bilgileri</title>
    <style>
        
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color:rgb(76, 125, 175);
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <h2>Öğrenci Bilgileri</h2>
    <?php
    // Veritabanından alınan veriler varsa tabloyu oluştur
    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Ad</th>
                    <th>Soyad</th>
                    <th>Numara</th>
                    <th>Tarih</th>
                    <th>Adres</th>
                    <th>Doğum Tarihi</th>
                    <th>Bölüm</th>
                </tr>";

        // Satırları döngüyle gezerek veriyi ekranda göster
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['password'] . "</td>
                    <td>" . $row['ad'] . "</td>
                    <td>" . $row['soyad'] . "</td>
                    <td>" . $row['numara'] . "</td>
                    <td>" . $row['date'] . "</td>
                    <td>" . $row['ogrenci_adres'] . "</td>
                    <td>" . $row['ogrenci_dogum_tarihi'] . "</td>
                    <td>" . $row['ogrenci_bolum'] . "</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Veri bulunamadı.</p>";
    }

    // Bağlantıyı kapat
    $conn->close();
    ?>
</body>
</html>
