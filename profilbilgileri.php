<?php
// Oturumun başlatılmamış olduğunu kontrol et
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Oturum başlat
}

// Veritabanı bağlantısını dahil et
include('connect.php');

$username = $_SESSION['username'];
$sql = "SELECT ad, soyad, departman  FROM akademisyenler WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $akd = $result->fetch_assoc();
    $akademisyen_adi = $akd['ad'];
    $akademisyen_soyadi = $akd['soyad'];
    $akademisyen_departman = $akd['departman'];
    

} else {
    $akademisyen_adi = "Bilinmiyor";
    $akademisyen_soyadi = "";
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genel Bilgiler</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Genel Ayarlar */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Konteyner Ayarları */
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        /* Başlık Ayarları */
        h1 {
            font-size: 24px;
            text-align: center;
            color:rgb(76, 102, 175);
        }

        /* Alt Başlık Ayarları */
        h2 {
            font-size: 20px;
            color: #333;
            margin-top: 20px;
        }

        /* Tablo Ayarları */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        td {
            background-color: #fafafa;
        }

        /* Satır Hover Efekti */
        tr:hover {
            background-color: #f5f5f5;
        }

        /* Responsive Tasarım (Ekran küçükse tablo genişliği) */
        @media screen and (max-width: 768px) {
            .container {
                width: 90%;
                padding: 10px;
            }

            h1 {
                font-size: 20px;
            }

            h2 {
                font-size: 18px;
            }

            table {
                width: 100%;
                font-size: 14px;
            }

            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
<div class="container">
        <h1>Genel Bilgileriniz, <?php echo $akademisyen_adi . ' ' . $akademisyen_soyadi; ?></h1>

        <h2>Akademisyen Bilgileri:</h2>
        <table border="1"width="80%">
            <tr>
                <th>Akademisyen Adı Adı</th>
                <td><?php echo $akademisyen_adi; ?></td>
            </tr>
            <tr>
                <th>Akademisyen Soyadı</th>
                <td><?php echo $akademisyen_soyadi; ?></td>
            </tr>
            <tr>
                <th>Departman</th>
                <td><?php echo $akademisyen_departman; ?></td>
            </tr>
            
        </table>
    </div>
</body>
</html>