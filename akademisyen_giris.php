<?php
session_start();
include('connect.php'); // Veritabanı bağlantısını dahil et

$error_message = ""; // Başlangıçta hata mesajı boş

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Veritabanında kullanıcıyı sorgula
    $sql = "SELECT * FROM akademisyenler WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password); // Güvenli sorgu
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Kullanıcı bulunduysa, oturum başlat
        $_SESSION['username'] = $username;
        header("Location: anasayfaakd.php"); // Başarılı giriş, anasayfaya yönlendir
        exit();
    } else {
        $error_message = "Kullanıcı adı veya şifresi hatalı"; // Yanlış girişte hata ver
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style\ogrenci_girisi.css"> 
    <title>Öğrenci Giriş Sayfası</title>
</head>
<body>
<div class="container">
        <h2>Akademisyen Girişi</h2>
        <form method="POST" action="">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" value="Giriş Yap">
        </form>

        <?php if (isset($_POST['username']) && !empty($error_message)): ?>
    <div class="error-message"><?php echo $error_message; ?></div>
<?php endif; ?>
    </div>
</body>
</html>
