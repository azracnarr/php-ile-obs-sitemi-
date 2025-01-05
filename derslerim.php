<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademisyen Dersleri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            color:rgb(76, 76, 175);
            margin-top: 20px;
        }

        h2 {
            color:rgb(76, 83, 175);
            margin-left: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color:rgb(3, 21, 153);
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .button {
            background-color:rgb(28, 43, 121);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Akademisyen Dersleri</h1>

    <?php
    // Oturumun başlatılmamış olduğunu kontrol et
    if (session_status() == PHP_SESSION_NONE) {
        session_start();  // Oturum başlat
    }

    // Veritabanı bağlantısını dahil et
    include('connect.php');

    // Giriş yapan akademisyenin username'ini al
    $username = $_SESSION['username'];

    // Akademisyen bilgilerini almak için SQL sorgusu
    $sql_akademisyen = "SELECT id FROM akademisyenler WHERE username = '$username'";
    $result_akademisyen = $conn->query($sql_akademisyen);

    if ($result_akademisyen->num_rows > 0) {
        // Akademisyen bilgilerini al
        $akademisyen = $result_akademisyen->fetch_assoc();
        $akademisyen_id = $akademisyen['id'];

        // Akademisyenin verdiği dersleri çekmek için SQL sorgusu
        $sql_dersler = "SELECT * FROM dersler WHERE akademisyen_id = $akademisyen_id";
        $result_dersler = $conn->query($sql_dersler);

        if ($result_dersler->num_rows > 0) {
            echo "<h2>Verdiğiniz Dersler:</h2>";
            echo "<table>
                    <tr>
                        <th>Ders Adı</th>
                        <th>Ders Saati</th>
                        <th>Ders İçeriği</th>
                        <th>Kayıt Tarihi</th>
                    </tr>";

            // Her bir dersi listele
            while($ders = $result_dersler->fetch_assoc()) {
                echo "<tr>
                        <td>" . $ders['ders_adi'] . "</td>
                        <td>" . $ders['ders_saati'] . "</td>
                        <td>" . $ders['ders_icerigi'] . "</td>
                        <td>" . $ders['kayit_tarihi'] . "</td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "<p>Bu akademisyen henüz ders vermiyor.</p>";
        }
    } else {
        echo "<p>Akademisyen bilgileri bulunamadı.</p>";
    }

    $conn->close();
    ?>
</div>

</body>
</html>
