<?php

// Ders bilgilerini çekme
$sql = "SELECT id, ders_adi, ogretim_elemani, ders_saati, ders_icerigi, kayit_tarihi FROM dersler";
$result = $conn->query($sql);

// Dersleri diziye atama
$dersler = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dersler[] = $row;
    }
} else {
    $dersler = [];
}

// Bağlantıyı kapat
$conn->close();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ders Bilgileri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .ders {
            background-color: #fff;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .ders h3 {
            color: #333;
            margin: 0;
        }
        .ders p {
            margin: 5px 0;
            color: #555;
        }
        .ders p strong {
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Ders Bilgileri</h2>

    <?php           
    if (count($dersler) > 0) {
        foreach ($dersler as $ders) {
            echo "<div class='ders'>";
            echo "<h3>" . $ders["ders_adi"] . "</h3>";
            echo "<p><strong>Öğretim Elemanı:</strong> " . $ders["ogretim_elemani"] . "</p>";
            echo "<p><strong>Ders Saati:</strong> " . $ders["ders_saati"] . "</p>";
            echo "<p><strong>Ders İçeriği:</strong> " . $ders["ders_icerigi"] . "</p>";
            echo "<p><strong>Kayıt Tarihi:</strong> " . $ders["kayit_tarihi"] . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>Hiç ders bulunamadı.</p>";
    }
    ?>

</div>

</body>
</html>
