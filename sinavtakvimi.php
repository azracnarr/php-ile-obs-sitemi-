<?php
// Veritabanı bağlantısını dahil et
include('connect.php');


$username = $_SESSION['username']; 

// Öğrencinin sınav bilgilerini almak için sorgu
$sql = "SELECT sinav_takvimi.ders_adi, sinav_takvimi.sinav_tarihi, sinav_takvimi.sinav_saati
        FROM sinav_takvimi
        JOIN ogrenciler ON ogrenciler.id = (SELECT ogrenci_id FROM ogrenci_akademisyen WHERE ogrenci_id = (SELECT id FROM ogrenciler WHERE username = '$username'))
        ORDER BY sinav_takvimi.sinav_tarihi ASC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sınav Takvimi</title>

    <!-- CSS stilini buraya ekliyoruz -->
    <style>
        /* Sayfanın genel stil ayarları */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Tabloyu stilize etme */
        .sinav-takvimi-tablo {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Tablo başlıkları */
        .sinav-takvimi-tablo th {
            background-color:rgb(12, 83, 134);
            color: white;
            padding: 15px;
            text-align: left;
            font-size: 18px;
        }

        /* Tablo hücreleri */
        .sinav-takvimi-tablo td {
            padding: 12px;
            text-align: left;
            font-size: 16px;
            border-bottom: 1px solid #ddd;
        }

        /* Tablo satır hover efekti */
        .sinav-takvimi-tablo tr:hover {
            background-color: #f1f1f1;
        }

        /* Başlık alanı */
        h2 {
            text-align: center;
            margin-top: 20px;
            font-size: 24px;
            color: #333;
        }

        /* Tabloyu daha şık göstermek için her satırın arka plan rengini değiştirebiliriz */
        .sinav-takvimi-tablo tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Tabloyu daha geniş göstermek için */
        .sinav-takvimi-tablo {
            width: 90%; /* Daha geniş tablo */
        }
    </style>
</head>
<body>
    <h2>Sınav Takviminiz</h2>

    <?php
    if ($result->num_rows > 0) {
        // Tabloyu oluşturma
        echo "<table class='sinav-takvimi-tablo'>
                <tr>
                    <th>Ders Adı</th>
                    <th>Sınav Tarihi</th>
                    <th>Sınav Saati</th>
                </tr>";

        // Veritabanındaki her kaydı yazdırma
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["ders_adi"] . "</td>
                    <td>" . $row["sinav_tarihi"] . "</td>
                    <td>" . $row["sinav_saati"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Sınav takvimi bulunamadı.";
    }

    // Bağlantıyı
