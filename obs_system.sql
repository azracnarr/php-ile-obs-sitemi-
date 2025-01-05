-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3309
-- Üretim Zamanı: 03 Oca 2025, 17:40:47
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `obs_system`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `akademik_takvim`
--

CREATE TABLE `akademik_takvim` (
  `id` int(11) NOT NULL,
  `olay_adı` varchar(255) NOT NULL,
  `olay_tarihi` date NOT NULL,
  `açıklama` text DEFAULT NULL,
  `oluşturulma_tarihi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `akademik_takvim`
--

INSERT INTO `akademik_takvim` (`id`, `olay_adı`, `olay_tarihi`, `açıklama`, `oluşturulma_tarihi`) VALUES
(1, 'Ders Başlangıcı', '2025-02-01', 'Yaz dönemi dersleri başlayacak.', '2025-01-02 22:36:55'),
(2, 'Ara Sınav', '2025-03-15', 'Yaz dönemi ara sınavı', '2025-01-02 22:36:55'),
(3, 'Final Sınavı', '2025-06-01', 'Yaz dönemi final sınavı', '2025-01-02 22:36:55');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `akademisyenler`
--

CREATE TABLE `akademisyenler` (
  `id` int(11) NOT NULL,
  `ad` varchar(100) DEFAULT NULL,
  `soyad` varchar(100) DEFAULT NULL,
  `departman` varchar(100) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `akademisyenler`
--

INSERT INTO `akademisyenler` (`id`, `ad`, `soyad`, `departman`, `username`, `password`) VALUES
(1, 'Dr. Ali', 'Demir', 'Bilgisayar Mühendisliği', 'dr. ali.demir', '123456'),
(2, 'Prof. Ahmet', 'Öztürk', 'Matematik', 'prof. ahmet.ozturk', '123456'),
(3, 'Dr. Zeynep', 'Yavuz', 'Elektrik Mühendisliği', 'dr. zeynep.yavuz', '123456'),
(4, 'Doç. Emre', 'Kurt', 'Fizik', 'doc. emre.kurt', '123456'),
(5, 'Dr. Selin', 'Büke', 'Kimya', 'dr. selin.buke', '123456'),
(6, 'Prof. Özkan', 'Çetin', 'Makine Mühendisliği', 'prof. ozkan.cetin', '123456');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dersler`
--

CREATE TABLE `dersler` (
  `id` int(11) NOT NULL,
  `ders_adi` varchar(100) NOT NULL,
  `ders_saati` varchar(50) DEFAULT NULL,
  `ders_icerigi` text DEFAULT NULL,
  `kayit_tarihi` timestamp NOT NULL DEFAULT current_timestamp(),
  `akademisyen_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `dersler`
--

INSERT INTO `dersler` (`id`, `ders_adi`, `ders_saati`, `ders_icerigi`, `kayit_tarihi`, `akademisyen_id`) VALUES
(1, 'Yazılım Mühendisliği', 'Pazartesi 10:00 - 12:00', 'Yazılım geliştirme süreçleri, yazılım yaşam döngüsü, proje yönetimi konuları ele alınacaktır.', '2024-12-25 20:54:45', 6),
(2, 'Veritabanı Yönetim Sistemleri', 'Salı 14:00 - 16:00', 'Veritabanı tasarımı, SQL kullanımı, ilişkisel veritabanları ve normalizasyon konuları işlenecektir.', '2024-12-25 20:54:45', 1),
(3, 'Ağ ve Güvenlik', 'Çarşamba 09:00 - 11:00', 'Ağ yapıları, güvenlik protokolleri, şifreleme teknikleri ve güvenlik duvarları hakkında dersler verilecektir.', '2024-12-25 20:54:45', 2),
(4, 'Yapay Zeka', 'Perşembe 10:00 - 12:00', 'Makine öğrenimi, derin öğrenme, yapay sinir ağları...', '2025-01-02 23:49:34', 3),
(5, 'Web Programlama', 'Cuma 14:00 - 16:00', 'HTML, CSS, JavaScript, PHP, ve veritabanı entegrasyonu...', '2025-01-02 23:49:34', 4),
(6, 'Mobil Uygulama Geliştirme', 'Cumartesi 11:00 - 13:00', 'Android ve iOS platformları için mobil uygulama geliştirme...', '2025-01-02 23:49:34', 5),
(7, 'Bilgisayar Ağları', 'Pazartesi 14:00 - 16:00', 'Ağ protokolleri, TCP/IP, IP adresleme ve yönlendirme...', '2025-01-02 23:49:34', 1),
(8, 'Veri Yapıları', 'Salı 10:00 - 12:00', 'Ağaç yapıları, bağlı listeler, grafikler, algoritmalar...', '2025-01-02 23:49:34', 2),
(9, 'İleri Düzey Web Programlama', 'Çarşamba 14:00 - 16:00', 'Node.js, React, ve veritabanı yönetim sistemleri...', '2025-01-02 23:49:34', 3),
(10, 'Mobil Oyun Geliştirme', 'Perşembe 14:00 - 16:00', 'Unity kullanarak 2D ve 3D oyun geliştirme...', '2025-01-02 23:49:34', 4),
(11, 'İşlem Sistemleri', 'Cuma 10:00 - 12:00', 'İşlem yönetimi, bellek yönetimi, dosya yönetimi...', '2025-01-02 23:49:34', 5),
(12, 'Veri Tabanı Yönetimi', 'Cumartesi 14:00 - 16:00', 'İlişkisel veri modellemesi ve SQL optimizasyonu...', '2025-01-02 23:49:34', 6),
(13, 'Bilişim Güvenliği', 'Pazar 10:00 - 12:00', 'Ağ güvenliği, şifreleme algoritmaları, güvenlik protokolleri...', '2025-01-02 23:49:34', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `duyurular`
--

CREATE TABLE `duyurular` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `icerik` text NOT NULL,
  `duyuru_tarihi` timestamp NOT NULL DEFAULT current_timestamp(),
  `bitis_tarihi` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `duyurular`
--

INSERT INTO `duyurular` (`id`, `baslik`, `icerik`, `duyuru_tarihi`, `bitis_tarihi`) VALUES
(1, 'Yazılım Mühendisliği Sınavı', 'Yazılım mühendisliği final sınavı 15 Aralık tarihinde yapılacaktır.', '2024-12-25 20:56:14', '2024-12-15 20:59:59'),
(2, 'Veritabanı Projesi Teslimi', 'Veritabanı projelerinin teslimi 20 Aralık\'a kadar yapılmalıdır.', '2024-12-25 20:56:14', '2024-12-20 20:59:59'),
(3, 'Ağ ve Güvenlik Dersi Ekstra Eğitim', 'Ağ ve güvenlik dersi için ekstra eğitim 18 Aralık tarihinde verilecektir.', '2024-12-25 20:56:14', '2024-12-18 20:59:59');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notlar`
--

CREATE TABLE `notlar` (
  `id` int(11) NOT NULL,
  `ogrenci_id` int(11) NOT NULL,
  `ders_id` int(11) NOT NULL,
  `not_degeri` decimal(5,2) DEFAULT NULL,
  `not_tarihi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `notlar`
--

INSERT INTO `notlar` (`id`, `ogrenci_id`, `ders_id`, `not_degeri`, `not_tarihi`) VALUES
(5, 1, 1, 58.00, '2025-01-02 23:53:37'),
(6, 1, 2, 88.00, '2025-01-02 23:53:37'),
(7, 1, 3, 58.00, '2025-01-02 23:53:37'),
(8, 1, 4, 88.00, '2025-01-02 23:53:37'),
(9, 1, 5, 88.00, '2025-01-02 23:53:37'),
(10, 1, 6, 88.00, '2025-01-02 23:53:37'),
(11, 3, 1, 78.00, '2025-01-02 23:53:37'),
(12, 3, 2, 88.00, '2025-01-02 23:53:37'),
(13, 3, 3, 88.00, '2025-01-02 23:53:37'),
(14, 3, 4, 18.00, '2025-01-02 23:53:37'),
(15, 3, 5, 88.00, '2025-01-02 23:53:37'),
(16, 3, 6, 988.00, '2025-01-02 23:53:37'),
(17, 4, 1, 88.00, '2025-01-02 23:53:37'),
(18, 4, 2, 28.00, '2025-01-02 23:53:37'),
(19, 4, 3, 88.00, '2025-01-02 23:53:37'),
(20, 4, 4, 38.00, '2025-01-02 23:53:37'),
(21, 4, 5, 49.00, '2025-01-02 23:53:37'),
(22, 4, 6, 88.00, '2025-01-02 23:53:37');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciler`
--

CREATE TABLE `ogrenciler` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` int(11) NOT NULL,
  `ad` varchar(30) NOT NULL,
  `soyad` varchar(30) NOT NULL,
  `numara` varchar(30) NOT NULL,
  `date` date DEFAULT NULL,
  `ogrenci_adres` text DEFAULT NULL,
  `ogrenci_dogum_tarihi` date DEFAULT NULL,
  `ogrenci_bolum` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `ogrenciler`
--

INSERT INTO `ogrenciler` (`id`, `username`, `password`, `ad`, `soyad`, `numara`, `date`, `ogrenci_adres`, `ogrenci_dogum_tarihi`, `ogrenci_bolum`) VALUES
(1, 'azracnr', 1234, 'azra', 'çınar', '23536253', '2025-01-01', 'Kadıköy, İstanbul', '2000-05-15', 'Yazılım Mühendisliği'),
(3, 'atakanalkn', 1234, 'atakan', 'alkan', '2847365493', '2025-01-01', 'Beşiktaş, İstanbul', '1999-08-22', 'Yazılım Mühendisliği'),
(4, 'esmablk', 1234, 'esma', 'balıkçı', '2847632', '2025-01-01', 'Kadıköy, İstanbul', '2001-12-10', 'Yazılım Mühendisliği');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenci_akademisyen`
--

CREATE TABLE `ogrenci_akademisyen` (
  `ogrenci_id` int(11) DEFAULT NULL,
  `akademisyen_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `ogrenci_akademisyen`
--

INSERT INTO `ogrenci_akademisyen` (`ogrenci_id`, `akademisyen_id`) VALUES
(1, 1),
(3, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenci_ders`
--

CREATE TABLE `ogrenci_ders` (
  `ogrenci_id` int(11) NOT NULL,
  `ders_id` int(11) NOT NULL,
  `durum` enum('Aktif','Tamamlandı','Devam Ediyor') DEFAULT 'Devam Ediyor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `ogrenci_ders`
--

INSERT INTO `ogrenci_ders` (`ogrenci_id`, `ders_id`, `durum`) VALUES
(1, 1, 'Aktif'),
(1, 2, 'Aktif'),
(1, 8, 'Devam Ediyor'),
(1, 9, 'Aktif'),
(1, 10, 'Tamamlandı'),
(1, 11, 'Devam Ediyor'),
(1, 12, 'Devam Ediyor'),
(1, 13, 'Devam Ediyor'),
(3, 1, 'Tamamlandı'),
(3, 7, 'Devam Ediyor'),
(3, 8, 'Aktif'),
(3, 9, 'Tamamlandı'),
(3, 10, 'Aktif'),
(3, 11, 'Devam Ediyor'),
(4, 3, 'Devam Ediyor'),
(4, 6, 'Devam Ediyor'),
(4, 7, 'Tamamlandı'),
(4, 8, 'Aktif'),
(4, 11, 'Aktif'),
(4, 12, 'Aktif'),
(4, 13, 'Aktif');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sinav_takvimi`
--

CREATE TABLE `sinav_takvimi` (
  `id` int(11) NOT NULL,
  `ders_adi` varchar(100) NOT NULL,
  `sinav_tarihi` date NOT NULL,
  `sinav_saati` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `sinav_takvimi`
--

INSERT INTO `sinav_takvimi` (`id`, `ders_adi`, `sinav_tarihi`, `sinav_saati`) VALUES
(1, 'Yazılım Mühendisliğine Giriş', '2025-01-15', '09:00:00'),
(2, 'Algoritmalar ve Veri Yapıları', '2025-01-17', '10:00:00'),
(3, 'Veritabanı Yönetim Sistemleri', '2025-01-19', '14:00:00'),
(4, 'Web Tabanlı Uygulama Geliştirme', '2025-01-20', '11:00:00'),
(5, 'Bilgisayar Ağları', '2025-01-21', '08:30:00'),
(6, 'Yazılım Tasarımı ve Mühendisliği', '2025-01-22', '12:00:00'),
(7, 'İşlevsel Programlama', '2025-01-23', '15:00:00'),
(8, 'Mobil Uygulama Geliştirme', '2025-01-24', '10:30:00'),
(9, 'Yazılım Testi ve Kalite Güvencesi', '2025-01-25', '13:30:00'),
(10, 'Proje Yönetimi ve Yazılım Mühendisliği', '2025-01-26', '16:00:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `staj`
--

CREATE TABLE `staj` (
  `id` int(11) NOT NULL,
  `ogrenci_id` int(11) DEFAULT NULL,
  `firma_adi` varchar(255) NOT NULL,
  `staj_baslangic_tarihi` date DEFAULT NULL,
  `staj_bitis_tarihi` date DEFAULT NULL,
  `staj_konusu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `staj`
--

INSERT INTO `staj` (`id`, `ogrenci_id`, `firma_adi`, `staj_baslangic_tarihi`, `staj_bitis_tarihi`, `staj_konusu`) VALUES
(1, 1, 'TechX Firması', '2023-06-01', '2023-08-01', 'Yazılım Geliştirme'),
(2, 3, 'DevTech Firması', '2023-09-01', '2023-12-01', 'Veri Analitiği'),
(3, 4, 'InnovateX', '2024-01-01', '2024-03-01', 'Yapay Zeka Araştırma');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `akademik_takvim`
--
ALTER TABLE `akademik_takvim`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `akademisyenler`
--
ALTER TABLE `akademisyenler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `dersler`
--
ALTER TABLE `dersler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_akademisyen` (`akademisyen_id`);

--
-- Tablo için indeksler `duyurular`
--
ALTER TABLE `duyurular`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `notlar`
--
ALTER TABLE `notlar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ogrenci_id` (`ogrenci_id`),
  ADD KEY `ders_id` (`ders_id`);

--
-- Tablo için indeksler `ogrenciler`
--
ALTER TABLE `ogrenciler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ogrenci_akademisyen`
--
ALTER TABLE `ogrenci_akademisyen`
  ADD KEY `ogrenci_id` (`ogrenci_id`),
  ADD KEY `akademisyen_id` (`akademisyen_id`);

--
-- Tablo için indeksler `ogrenci_ders`
--
ALTER TABLE `ogrenci_ders`
  ADD PRIMARY KEY (`ogrenci_id`,`ders_id`),
  ADD KEY `ders_id` (`ders_id`);

--
-- Tablo için indeksler `sinav_takvimi`
--
ALTER TABLE `sinav_takvimi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `staj`
--
ALTER TABLE `staj`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ogrenci_id` (`ogrenci_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `akademik_takvim`
--
ALTER TABLE `akademik_takvim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `akademisyenler`
--
ALTER TABLE `akademisyenler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `dersler`
--
ALTER TABLE `dersler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `duyurular`
--
ALTER TABLE `duyurular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `notlar`
--
ALTER TABLE `notlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenciler`
--
ALTER TABLE `ogrenciler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `sinav_takvimi`
--
ALTER TABLE `sinav_takvimi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `staj`
--
ALTER TABLE `staj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `dersler`
--
ALTER TABLE `dersler`
  ADD CONSTRAINT `fk_akademisyen` FOREIGN KEY (`akademisyen_id`) REFERENCES `akademisyenler` (`id`);

--
-- Tablo kısıtlamaları `notlar`
--
ALTER TABLE `notlar`
  ADD CONSTRAINT `notlar_ibfk_1` FOREIGN KEY (`ogrenci_id`) REFERENCES `ogrenciler` (`id`),
  ADD CONSTRAINT `notlar_ibfk_2` FOREIGN KEY (`ders_id`) REFERENCES `dersler` (`id`);

--
-- Tablo kısıtlamaları `ogrenci_akademisyen`
--
ALTER TABLE `ogrenci_akademisyen`
  ADD CONSTRAINT `ogrenci_akademisyen_ibfk_1` FOREIGN KEY (`ogrenci_id`) REFERENCES `ogrenciler` (`id`),
  ADD CONSTRAINT `ogrenci_akademisyen_ibfk_2` FOREIGN KEY (`akademisyen_id`) REFERENCES `akademisyenler` (`id`);

--
-- Tablo kısıtlamaları `ogrenci_ders`
--
ALTER TABLE `ogrenci_ders`
  ADD CONSTRAINT `ogrenci_ders_ibfk_1` FOREIGN KEY (`ogrenci_id`) REFERENCES `ogrenciler` (`id`),
  ADD CONSTRAINT `ogrenci_ders_ibfk_2` FOREIGN KEY (`ders_id`) REFERENCES `dersler` (`id`);

--
-- Tablo kısıtlamaları `staj`
--
ALTER TABLE `staj`
  ADD CONSTRAINT `staj_ibfk_1` FOREIGN KEY (`ogrenci_id`) REFERENCES `ogrenciler` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
