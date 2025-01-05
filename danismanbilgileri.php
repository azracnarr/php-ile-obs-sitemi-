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

        // Öğrencinin akademisyen bilgisini almak için ogrenci_akademisyen tablosunu kullan
        $danisman_sql = "SELECT akademisyen_id FROM ogrenci_akademisyen WHERE ogrenci_id = '$ogrenci_id'";
        $danisman_result = $conn->query($danisman_sql);

        if ($danisman_result->num_rows > 0) {
            // Danışman bilgisini al
            $danisman = $danisman_result->fetch_assoc();
            $akademisyen_id = $danisman['akademisyen_id'];

            // Akademisyen bilgilerini almak için akademisyenler tablosunu kullan
            $akademisyen_sql = "SELECT ad, soyad, departman FROM akademisyenler WHERE id = '$akademisyen_id'";
            $akademisyen_result = $conn->query($akademisyen_sql);

            if ($akademisyen_result->num_rows > 0) {
                // Akademisyen bilgilerini al
                $akademisyen = $akademisyen_result->fetch_assoc();
                $danisman_adi = $akademisyen['ad'];
                $danisman_soyadi = $akademisyen['soyad'];
                $danisman_departman = $akademisyen['departman'];
            } else {
                echo "<p>Danışman bilgileri bulunamadı.</p>";
                exit;
            }
        } else {
            echo "<p>Öğrenciye ait danışman bilgisi bulunamadı.</p>";
            exit;
        }
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
    <title>Öğrenci ve Danışman Bilgileri</title>
    <style>
        

        h1 {
            text-align: center;
            margin-top: 0;
            font-size: 28px;
            color: #333;
        }

        .ogrenci-info p, .danisman-info p {
            font-size: 18px;
            margin: 8px 0;
        }

        .danisman-info {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1><?php echo $ogrenci_adi . ' ' . $ogrenci_soyadi; ?>'nın Danışman Bilgileri</h1>

    <!-- Öğrenci Bilgileri -->
    <div class="ogrenci-info">
        <p><strong>Öğrenci Adı:</strong> <?php echo $ogrenci_adi . ' ' . $ogrenci_soyadi; ?></p>
    </div>

    <!-- Danışman Bilgileri -->
    <div class="danisman-info">
        <h3>Danışman Bilgileri</h3>
        <p><strong>Danışman Adı:</strong> <?php echo $danisman_adi . ' ' . $danisman_soyadi; ?></p>
        <p><strong>Danışman Bölümü:</strong> <?php echo $danisman_departman; ?></p>
    </div>
</div>
</body>
</html>
