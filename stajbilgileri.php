<?php
// Veritabanı bağlantısı
include('connect.php');

// Giriş yapmış öğrenciyi kontrol et
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Öğrencinin bilgilerini almak için SQL sorgusu
    $sql = "SELECT id, ad, soyad FROM ogrenciler WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Öğrencinin bilgilerini al
        $student = $result->fetch_assoc();
        $ogrenci_id = $student['id'];
        $ogrenci_adi = $student['ad'];
        $ogrenci_soyadi = $student['soyad'];

        // Staj bilgilerini almak için SQL sorgusu
        $staj_sql = "SELECT firma_adi, staj_baslangic_tarihi, staj_bitis_tarihi, staj_konusu
                     FROM staj WHERE ogrenci_id = '$ogrenci_id'";
        $staj_result = $conn->query($staj_sql);
    } else {
        // Öğrenci bulunamazsa hata mesajı
        echo "<p>Öğrenci bilgileri bulunamadı.</p>";
        exit;
    }
} else {
    // Giriş yapılmadıysa yönlendirme
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staj Bilgileri</title>
    <style>


        /* Başlık stili */
        h1 {
            text-align: center;
            margin-top: 0;
            font-size: 28px;
            color: #333;
        }

        /* Tablo stili */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            font-size: 16px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: rgb(12, 83, 134);
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        /* Staj bilgisi bulunamadığında */
        p {
            text-align: center;
            color: #777;
            font-size: 18px;
            font-style: italic;
        }
    </style>
</head>
<body>
<div class="container">
    <h1><?php echo $ogrenci_adi . ' ' . $ogrenci_soyadi; ?>'nın Staj Bilgileri</h1>

    <?php
    if ($staj_result->num_rows > 0) {
        // Staj bilgilerini tablo olarak yazdır
        echo "<table>
                <tr>
                    <th>Firma Adı</th>
                    <th>Staj Başlangıç Tarihi</th>
                    <th>Staj Bitiş Tarihi</th>
                    <th>Staj Konusu</th>
                </tr>";

        while($row = $staj_result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["firma_adi"] . "</td>
                    <td>" . date("d-m-Y", strtotime($row["staj_baslangic_tarihi"])) . "</td>
                    <td>" . date("d-m-Y", strtotime($row["staj_bitis_tarihi"])) . "</td>
                    <td>" . $row["staj_konusu"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Bu öğrenciye ait staj bilgisi bulunmamaktadır.</p>";
    }
    ?>

</div>
</body>
</html>
