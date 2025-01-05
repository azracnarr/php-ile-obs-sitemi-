<?php
include('connect.php');


// Oturumdan giriş yapan öğrencinin kullanıcı adını al
$username = $_SESSION['username']; // Oturumdaki kullanıcı adını al

// Eğer oturumda kullanıcı adı yoksa, giriş sayfasına yönlendir
if (!isset($username)) {
    header("Location: login.php");  // Kullanıcıyı giriş sayfasına yönlendir
    exit();
}

// Öğrenci ID'sini almak için username üzerinden sorgu yap
$sql = "SELECT id FROM ogrenciler WHERE username = '$username'";

// Sorguyu çalıştır ve öğrenci ID'sini al
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ogrenci_id = $row['id'];  // Öğrenci ID'sini al
} else {
    echo "Öğrenci bilgileri bulunamadı.";
    exit();
}

// Notları ve ders adlarını almak için SQL sorgusu
$sql = "SELECT n.not_degeri, n.not_tarihi, d.ders_adi 
        FROM notlar n 
        INNER JOIN dersler d ON n.ders_id = d.id 
        WHERE n.ogrenci_id = $ogrenci_id";

// Sorguyu çalıştır
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Notları</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        header {
           
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color:rgb(12, 83, 134);
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e6f7ff;
        }

        .message {
            text-align: center;
            font-size: 18px;
            color: #333;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Öğrenci Notları</h1>
</header>

<div class="content">
    <?php
    // Notlar listesi
    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Ders Adı</th>
                    <th>Not Değeri</th>
                    <th>Not Tarihi</th>
                </tr>";

        // Her bir sonucu tabloya ekle
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['ders_adi'] . "</td>
                    <td>" . $row['not_degeri'] . "</td>
                    <td>" . $row['not_tarihi'] . "</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<div class='message'>Bu öğrenciye ait ders notu bulunmamaktadır.</div>";
    }

    // Veritabanı bağlantısını kapat
    $conn->close();
    ?>
</div>

</body>
</html>
