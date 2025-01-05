<?php 
session_start();
include "connect.php";

// Giriş kontrolü
if (!isset($_SESSION['username'])) {
    header("Location: akademisyen_giris.php");
    exit;
}

// Oturumdan kullanıcı adını al
$username = $_SESSION['username'];

// Öğrenci bilgilerini veritabanından çek
$sql = "SELECT ad, soyad FROM akademisyenler WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $akademisyen = $result->fetch_assoc();
    $akademisyen_adi = $akademisyen['ad'];
    $akademisyen_soyadi = $akademisyen['soyad'];
  
} else {
    $ogrenci_adi = "Bilinmiyor";
    $ogrenci_soyadi = "";
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademisyen Bilgi Sistemi</title> 
    <link rel="stylesheet" href="style\anasayfa.css"> 
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Popper.js (Bootstrap için gerekli) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS (Collapse dahil tüm işlevsellik) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</head>
<body>
 
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="anasayfa.php">Akademisyen Bilgi Sistemi</a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        Hoşgeldiniz, <?php echo htmlspecialchars($akademisyen_adi. " " . $akademisyen_soyadi); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-danger ms-2" href="akademisyen_giris.php">Çıkış Yap</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- İçerik Alanı -->
<div class="container-fluid mt-4">
    <div class="row">
        <!-- Sol Menü (Sidebar) -->
        <div class="col-md-3">
            <div class="accordion" id="sidebarAccordion">
                <!-- Genel işlemler -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="genelislemHeading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#genelislemCollapse">
                            Ana Menü
                        </button>
                    </h2>
                    <div id="genelislemCollapse" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <ul class="list-group">
                            <li class="list-group-item">
                               <a href="?sayfa1=profilbilgileri" class="alt-baslik" data-id="1">Genel Bakış</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa1=profilbilgileri" class="alt-baslik" data-id="2">Profil Bilgileri</a>
                            </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Ders ve Dönem İşlemleri -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="dersdonemHeading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#dersdonemCollapse">
                        Ders Yönetimi
                        </button>
                    </h2>
                    <div id="dersdonemCollapse" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <ul class="list-group">
                            <li class="list-group-item">
                                <a href="?sayfa1=derslerim" class="alt-baslik" data-id="11">Derslerim</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa1=ogrencilist" class="alt-baslik" data-id="13">Öğrenci Listesi</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa1=dersnot" class="alt-baslik" data-id="14">Ders Notları</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=transkript" class="alt-baslik" data-id="15">Ders Materyalleri</a>
                            </li>
                            
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Form -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="formHeading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#formCollapse">
                        Sınav ve Ödev Yönetimi
                        </button>
                    </h2>
                    <div id="formCollapse" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <ul class="list-group">
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="19">Sınavlar ve Tarihleri</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="20">Ödevler</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=ogrencibilgiformu" class="alt-baslik" data-id="21">Notlandırma</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- İlişik kesme talebi -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="ilisikHeading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#ilisikCollapse">
                        Danışmanlık ve Öğrenci Takibi
                        </button>
                    </h2>
                    <div id="ilisikCollapse" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <ul class="list-group">
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="22">Danışmanlık Listesi</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Hazırlık -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="hazirlikHeading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#hazirlikCollapse">
                        İletişim ve Duyurular
                        </button>
                    </h2>
                    <div id="hazirlikCollapse" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <ul class="list-group">
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="23">Duyurular</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="24">Mesaj Kutusu</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="25">Toplantılar</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="26">Bildirimler</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Başvuru -->
                <div class="accordion-item mt-3">
                    <h2 class="accordion-header" id="basvuruHeading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#basvuruCollapse">
                        Akademik Takvim ve Etkinlikler
                        </button>
                    </h2>
                    <div id="basvuruCollapse" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <ul class="list-group">
                            
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="28">Takvim</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="29">Etkinlikler</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- Orta İçerik Alanı --> 
        <div class="col-md-9"> 
        <?php
// Bağlantı parametresine göre içerik yükle
if (isset($_GET['sayfa1'])) {
    $sayfa = $_GET['sayfa1'];

    switch ($sayfa) {
            case 'profilbilgileri':
                
                include('arasayfa2/profilbilgileri.php');
                break;
            case 'derslerim':
                    // Transkript sayfası
                include('arasayfa2/derslerim.php');
                break;
            case 'ogrencilist':
                    // Transkript sayfası
                include('arasayfa2/ogrencilist.php');
                break;
            case 'dersnot':
                        // Transkript sayfası
                include('arasayfa2/dersnot.php');
                break;
     
            default:
            // Varsayılan içerik
               echo "<p>Diğer seçeneklere göz atabilirsiniz.</p>";
               break;
    }
} else {
    // Parametre yoksa varsayılan içerik
    echo "<p>Hoşgeldiniz! Lütfen bir seçenek seçin.</p>";
}
?>
    </div>
</div>
</div>
<!-- Bootstrap JS (Accordion için gerekli) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
