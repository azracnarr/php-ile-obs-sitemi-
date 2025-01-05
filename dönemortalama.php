<?php
include('connect.php');

$username = $_SESSION['username'];

// Öğrenci bilgilerini almak için username ile sorgulama yapıyoruz
$sql = "SELECT id FROM ogrenciler WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ogrenci_id = $row['id'];  // Öğrencinin ID'sini alıyoruz
} else {
    die("Öğrenci bulunamadı.");
}

// Ders notlarını veritabanından çekmek için SQL sorgusu
$sql = "SELECT dersler.ders_adi, notlar.not_degeri 
        FROM notlar 
        INNER JOIN dersler ON notlar.ders_id = dersler.id 
        WHERE notlar.ogrenci_id = $ogrenci_id";

$result = $conn->query($sql);

// Ders notları için başlangıçta boş değerler
$ders_notları = [];
$ortalama = "";
$hata = "";

// Veritabanından çekilen notları diziye ekle
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ders_notları[] = $row;
    }
} else {
    $hata = "Veritabanında notlar bulunamadı.";
}

// Ortalama hesaplama
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $toplam = 0;
    $gecerli_notlar = 0;

    // Formdaki notları al ve toplamla
    for ($i = 1; $i <= count($ders_notları); $i++) {
        $not = $_POST["ders$i"];
        if ($not != "") {
            $toplam += $not;
            $gecerli_notlar++;
        }
    }

    // Ortalama hesapla
    if ($gecerli_notlar == count($ders_notları)) {
        $ortalama = $toplam / $gecerli_notlar;
    } else {
        $hata = "Lütfen tüm ders notlarını giriniz.";
    }
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dönem Ortalaması Hesaplama</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        header {
            
            
            text-align: center;
            padding: 15px;
        }

        .form-container {
            width: 60%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
        }

        .form-container label {
            font-size: 16px;
            margin-bottom: 10px;
            display: block;
        }

        .form-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-container input[type="submit"] {
            background-color: #0044cc;
            color: white;
            cursor: pointer;
            border: none;
            padding: 10px;
            border-radius: 5px;
        }

        .form-container input[type="submit"]:hover {
            background-color: #0033aa;
        }

        .message {
            text-align: center;
            font-size: 18px;
            color: #333;
            margin-top: 20px;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<header>
    <h1>Dönem Ortalaması Hesaplama</h1>
</header>

<div class="form-container">
    <h2>Ders Notlarınız</h2>
    
    <!-- Notlar formu -->
    <form method="POST" action="">
        <?php
        // Veritabanından çekilen ders notlarını formda göster
        $ders_sayisi = count($ders_notları);
        for ($i = 0; $i < $ders_sayisi; $i++) {
            echo "<label for='ders" . ($i + 1) . "'>Ders " . ($i + 1) . " (" . $ders_notları[$i]['ders_adi'] . "):</label>";
            echo "<input type='number' name='ders" . ($i + 1) . "' value='" . $ders_notları[$i]['not_degeri'] . "' step='0.01' readonly>";
        }
        ?>
        <input type="submit" value="Ortalama Hesapla">
    </form>

    <?php
    // Ortalama hesaplandıysa ekrana yazdır
    if ($ortalama !== "") {
        echo "<div class='message'>Dönem Ortalamanız: <strong>" . number_format($ortalama, 2) . "</strong></div>";
    }

    // Hata mesajı varsa göster
    if ($hata !== "") {
        echo "<div class='message error'>$hata</div>";
    }
    ?>
</div>

</body>
</html>
