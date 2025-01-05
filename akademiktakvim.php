<?php
// Veritabanı bağlantısını dahil et
include('connect.php');

// Akademik takvim verilerini çekmek için SQL sorgusu
$sql = "SELECT * FROM akademik_takvim ORDER BY olay_tarihi ASC"; // Olayları tarih sırasına göre getir
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik Takvim</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Akademik Takvim</h1>
        <table>
            <tr>
                <th>Olay Adı</th>
                <th>Tarih</th>
                <th>Açıklama</th>
            </tr>

            <?php
            // Veritabanından gelen her bir kaydı tabloya yazdır
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['olay_adı'] . "</td>";
                    echo "<td>" . $row['olay_tarihi'] . "</td>";
                    echo "<td>" . $row['açıklama'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Henüz kaydedilmiş bir akademik takvim yok.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
