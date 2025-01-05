<?php 
session_start();
include "connect.php";

// Giriş kontrolü
if (!isset($_SESSION['username'])) {
    header("Location: ogrenci_giris.php");
    exit;
}

// Oturumdan kullanıcı adını al
$username = $_SESSION['username'];

// Öğrenci bilgilerini veritabanından çek
$sql = "SELECT ad, soyad FROM ogrenciler WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
    $ogrenci_adi = $student['ad'];
    $ogrenci_soyadi = $student['soyad'];
  
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
    <title>Öğrenci Bilgi Sistemi</title> 
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
        <a class="navbar-brand" href="anasayfa.php">OBS Sistemi</a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        Hoşgeldiniz, <?php echo htmlspecialchars($ogrenci_adi . " " . $ogrenci_soyadi); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-danger ms-2" href="ogrenci_giris.php">Çıkış Yap</a>
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
                            Genel İşlemler
                        </button>
                    </h2>
                    <div id="genelislemCollapse" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <ul class="list-group">
                            <li class="list-group-item">
                               <a href="?sayfa=kullanimklavuzu" class="alt-baslik" data-id="1">Kullanım Klavuzu</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=özlükbilgileri" class="alt-baslik" data-id="2">Özlük Bilgileri</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=genelbilgiler" class="alt-baslik" data-id="3">Genel Bilgiler</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=akademiktakvim" class="alt-baslik" data-id="4">Akademik Takvim</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=danismanbilgileri" class="alt-baslik" data-id="5">Danışman Bilgileri</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=sinavtakvimi" class="alt-baslik" data-id="6">Sınav Takvimi</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=dersprogrami" class="alt-baslik" data-id="7">Ders Programı</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=harcbilgileri" class="alt-baslik" data-id="8">Harç Bilgileri</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=stajbilgileri" class="alt-baslik" data-id="9">Staj Bilgileri</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=mezuniyetonaybilgileri" class="alt-baslik" data-id="10">Mezuniyet Onay Bilgileri</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Ders ve Dönem İşlemleri -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="dersdonemHeading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#dersdonemCollapse">
                            Ders ve Dönem İşlemleri
                        </button>
                    </h2>
                    <div id="dersdonemCollapse" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <ul class="list-group">
                            <li class="list-group-item">
                                <a href="?sayfa=derskayit" class="alt-baslik" data-id="11">Ders Kayıt</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=bütünlemekayit" class="alt-baslik" data-id="12">Bütünleme Kayıt</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=dönemortalama" class="alt-baslik" data-id="13">Dönem Ortalamaları</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=notlistesi" class="alt-baslik" data-id="14">Not Listesi</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=transkript" class="alt-baslik" data-id="15">Transkript Senaryosu</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=diğerbelgeler" class="alt-baslik" data-id="16">Diğer Belgeler</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=müfredatdurum" class="alt-baslik" data-id="17">Müfredat Durum</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=devamsızlıkdurumu" class="alt-baslik" data-id="18">Devamsızlık Durumu</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Form -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="formHeading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#formCollapse">
                            Form İşlemleri
                        </button>
                    </h2>
                    <div id="formCollapse" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <ul class="list-group">
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="19">Anketler</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="20">Değerlendirme Formları</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=ogrencibilgiformu" class="alt-baslik" data-id="21">Öğrenci Bilgi Formu</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- İlişik kesme talebi -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="ilisikHeading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#ilisikCollapse">
                            İlişik Kesme Talebi
                        </button>
                    </h2>
                    <div id="ilisikCollapse" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <ul class="list-group">
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="22">İlişik Kesme Talebi</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Hazırlık -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="hazirlikHeading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#hazirlikCollapse">
                            Hazırlık İşlemleri
                        </button>
                    </h2>
                    <div id="hazirlikCollapse" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <ul class="list-group">
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="23">Haz. Sınav Takvimi</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="24">Haz. Not Listesi</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="25">Haz. Devamsızlık Durumu</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="26">Haz. Ders Programı</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Başvuru -->
                <div class="accordion-item mt-3">
                    <h2 class="accordion-header" id="basvuruHeading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#basvuruCollapse">
                            Başvuru İşlemleri
                        </button>
                    </h2>
                    <div id="basvuruCollapse" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <ul class="list-group">
                            <li class="list-group-item">
                                <a href="?sayfa=kayitdondurma" class="alt-baslik" data-id="27">Kayıt Dondurma Başvurusu</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="28">Mazeret Sınavı Başvurusu</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="29">Formasyon İptal Başvurusu</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Kullanıcı -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="kullaniciHeading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#kullaniciCollapse">
                            Kullanıcı İşlemleri
                        </button>
                    </h2>
                    <div id="kullaniciCollapse" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <ul class="list-group">
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="30">Yapılacaklar Listesi</a>
                            </li>
                            <li class="list-group-item">
                                <a href="?sayfa=gelenmesajlar" class="alt-baslik" data-id="31">Gelen Mesajlar</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="32">Gönderilecek Mesajlar</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="33">Belge Talebi</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="34">Şifre Değiştir</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="alt-baslik" data-id="35">Fotoğraf Güncelle</a>
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
if (isset($_GET['sayfa'])) {
    $sayfa = $_GET['sayfa'];

    switch ($sayfa) {
            case 'genelbilgiler':
                // Transkript sayfası
                include('arasayfa/genelbilgiler.php');
                break;
            case 'akademiktakvim':
                    // Transkript sayfası
                include('arasayfa/akademiktakvim.php');
                break;
            case 'danismanbilgileri':
                    // Transkript sayfası
                include('arasayfa/danismanbilgileri.php');
                break;
            case 'sinavtakvimi':
                        // Transkript sayfası
                include('arasayfa/sinavtakvimi.php');
                break;
            case 'dersprogrami':
                            // Transkript sayfası
                include('arasayfa/dersprogrami.php');
                break;
        
            case 'stajbilgileri':
            // Transkript sayfası
                include('arasayfa/stajbilgileri.php');
                break;
            case 'ogrencibilgiformu':
                    // Transkript sayfası
                include('arasayfa/ogrencibilgiformu.php');
                break;
            case 'notlistesi':
                        // Transkript sayfası
                include('arasayfa/notlistesi.php');
                break;
            case 'müfredatdurum':
                        // Transkript sayfası
                include('arasayfa/müfredatdurum.php');
                break;
            case 'kayitdondurma':
                            // Transkript sayfası
                include('arasayfa/kayitdondurma.php');
                break;
            case 'gelenmesajlar':
                                // Transkript sayfası
                    include('arasayfa/gelenmesajlar.php');
                    break;
            
            case 'dönemortalama':
                // Transkript sayfası
                include('arasayfa/dönemortalama.php');
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
