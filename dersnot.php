<?php
// Oturumun başlatılmamış olduğunu kontrol et
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Oturum başlat
}

// Veritabanı bağlantısını dahil et
include('connect.php');

// Oturumdaki kullanıcı adını al
$username = $_SESSION['username'];

// Kullanıcı adını güvenli bir şekilde sorguya dahil et
$sql = "SELECT ad, soyad, departman, id FROM akademisyenler WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username); // Kullanıcı adı parametresi
$stmt->execute();
$result = $stmt->get_result();

echo '<style>
/* Genel Stil */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    color: #333;
    margin-top: 20px;
}

p {
    text-align: center;
    color: #555;
    font-size: 1.1em;
}

/* Tablo Stili */
table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #fff;
}

th, td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color:rgb(30, 58, 125);
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}

/* Hata Mesajları */
.error {
    color: red;
    font-weight: bold;
    text-align: center;
    margin-top: 20px;
}

.success {
    color: green;
    font-weight: bold;
    text-align: center;
    margin-top: 20px;
}
</style>';

if ($result->num_rows > 0) {
    // Giriş başarılı, akademisyen bilgilerini al
    $row = $result->fetch_assoc();
    $akademisyen_id = $row["id"];
    echo "<h2> " . $row['ad'] . " " . $row['soyad'] . "</h2>";
    echo "<p>Departman: " . $row['departman'] . "</p>";
    
    // Akademisyenin verdiği dersleri alan öğrencilerin notlarını listele
    $sql = "
    SELECT ogrenci_ders.ogrenci_id, ogrenciler.ad AS ogrenci_ad, ogrenciler.soyad AS ogrenci_soyad, dersler.ders_adi, notlar.not_degeri
    FROM ogrenci_ders 
    JOIN dersler ON ogrenci_ders.ders_id = dersler.id
    JOIN ogrenciler ON ogrenci_ders.ogrenci_id = ogrenciler.id
    LEFT JOIN notlar ON notlar.ogrenci_id = ogrenciler.id AND notlar.ders_id = dersler.id
    WHERE dersler.akademisyen_id = ? 
    ORDER BY ogrenci_ders.ogrenci_id ASC
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $akademisyen_id); // Akademisyen ID parametresi
    $stmt->execute();
    $result = $stmt->get_result();

    // Sonuçları HTML tablosunda göster
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Öğrenci ID</th>
                    <th>Öğrenci Adı</th>
                    <th>Öğrenci Soyadı</th>
                    <th>Ders Adı</th>
                    <th>Not</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["ogrenci_id"] . "</td>
                    <td>" . $row["ogrenci_ad"] . "</td>
                    <td>" . $row["ogrenci_soyad"] . "</td>
                    <td>" . $row["ders_adi"] . "</td>
                    <td>" . ($row["not_degeri"] ? $row["not_degeri"] : "Henüz Not Verilmedi") . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Verilen derslerde kayıtlı öğrenci bulunamadı.";
    }
} else {
    echo "Geçersiz kullanıcı adı.";
}

// Bağlantıyı kapat
$conn->close();
?> 
