<?php
// Veritabanı bağlantısını dahil et
include('connect.php');

// Sınav takvimindeki dersleri almak için sorgu (ilk 6 ders)
$sql = "SELECT ders_adi, sinav_tarihi, sinav_saati 
        FROM sinav_takvimi 
        ORDER BY sinav_tarihi ASC 
        LIMIT 6";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>6 Derslik Ders Programı</title>
    
    <style>
        /* Sayfa genel stil ayarları */
        

        h1 {
            color: #333;
            text-align: center;
            font-size: 28px;
        }

        /* Ders programı tablosu stili */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            font-size: 16px;
            border-bottom: 1px solid #ddd;
        }

        /* Tablo başlık rengi */
        table th {
            background-color:rgb(12, 83, 134);
            color: white;
        }

        /* Satır hover efekti */
        table tr:hover {
            background-color: #f1f1f1;
        }

        /* Alternatif satır renkleri */
        table tr:nth-child(even) {
            background-color: #f7f7f7;
        }

        /* Tabloyu yuvarlatma */
        table {
            border-radius: 8px;
            overflow: hidden;
        }

        /* Tabloyu daha geniş göstermek */
        table {
            width: 90%;
        }
    </style>
</head>
<body>

<!-- İçerik Alanı -->
<div class="content">
    <h1> Ders Programı</h1>

    <?php
    if ($result->num_rows > 0) {
        // Tabloyu oluşturma
        echo "<table>
                <tr>
                    <th>Ders Adı</th>
                    <th>Sınav Tarihi</th>
                    <th>Sınav Saati</th>
                </tr>";

        // Veritabanındaki her kaydı yazdırma
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["ders_adi"] . "</td>
                    <td>" . date("d-m-Y", strtotime($row["sinav_tarihi"])) . "</td>
                    <td>" . date("H:i", strtotime($row["sinav_saati"])) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Hiç sınav bulunmamaktadır.</p>";
    }

    // Bağlantıyı kapatma
    $conn->close();
    ?>
</div>

</body>
</html>
