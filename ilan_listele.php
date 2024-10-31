<?php

$host = "localhost";
$kullanici_adi = "root";
$parola = "";
$vt = "ekleme"; 

$baglanti = mysqli_connect($host, $kullanici_adi, $parola, $vt);

if (!$baglanti) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

// İlanları listeleme
$ilan_query = "SELECT * FROM listings";
$ilan_sonuc = mysqli_query($baglanti, $ilan_query);

if (!$ilan_sonuc) {
    die("İlanlar getirilemedi: " . mysqli_error($baglanti));
}

// Rezervasyonları listeleme
$reservasyon_query = "SELECT * FROM reservations WHERE listing_id = ?";

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İlanlar ve Rezervasyonlar</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>İlanlar ve Rezervasyonlar</h2>
    <?php while ($ilan = mysqli_fetch_assoc($ilan_sonuc))://mysqli_fetch_assoc() ile her bir ilan kaydını alır ve HTML içinde uygun yerlerde gösterir. ?>
        <h3><?php echo htmlspecialchars($ilan['title']); ?></h3>
        <p><strong>İlan Açıklama:</strong> <?php echo htmlspecialchars($ilan['description']); ?></p>
        <p><strong>Gecelik Fiyat:</strong> <?php echo htmlspecialchars($ilan['nightly_price']); ?> TL</p>
        <p><strong>İlanın Konumu:</strong> <?php echo htmlspecialchars($ilan['location']); ?></p>
        <p><strong>Oluşturulma Tarihi:</strong> <?php echo htmlspecialchars($ilan['created_at']); ?></p>

        <h4>Rezervasyonlar:</h4>
        <?php
        // Rezervasyonları getir
        $stmt = mysqli_prepare($baglanti, $reservasyon_query);//mysqli_prepare() fonksiyonu, sorguyu veritabanı için hazırlar ve bir hazırlıklı ifade döner.

        mysqli_stmt_bind_param($stmt, 'i', $ilan['id']);//mysqli_stmt_bind_param() fonksiyonu, yer tutucuya gerçek değerleri bağlamak için kullanılır. ? koymuştuk belli oladığı için. listing_id değerini bağlamak için kullanılır.

        mysqli_stmt_execute($stmt);//mysqli_stmt_execute() fonksiyonu, sorguyu çalıştırır.

        $rezervasyon_sonuc = mysqli_stmt_get_result($stmt);
        //mysqli_stmt_execute() fonksiyonu, sorguyu çalıştırır.

        if (mysqli_num_rows($rezervasyon_sonuc) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Kullanıcı ID</th>
                        <th>Başlangıç Tarihi</th>
                        <th>Bitiş Tarihi</th>
                        <th>Oluşturulma Tarihi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rezervasyon = mysqli_fetch_assoc($rezervasyon_sonuc)): 
                        //mysqli_fetch_assoc() fonksiyonu, sorgu sonucundaki her bir satırı bir associative array (anahtar-değer çiftleri) olarak döndürür. while döngüsü, bu satırlar üzerinden geçiş yapar.Döngü, sorgudan tüm satırlar çekilene kadar devam eder.  ?>
                                                       
                        <tr>
                            <td><?php echo htmlspecialchars($rezervasyon['user_id']); //htmlspecialchars() fonksiyonu, kullanıcıdan gelen verilerin HTML özel karakterlerini kodlar ?></td>
                            <td><?php echo htmlspecialchars($rezervasyon['start_date']); ?></td>
                            <td><?php echo htmlspecialchars($rezervasyon['end_date']); ?></td>
                            <td><?php echo htmlspecialchars($rezervasyon['created_at']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Bu ilanın rezervasyonu bulunmamaktadır.</p>
        <?php endif; ?>
    <?php endwhile; ?>

    <?php
    // Bağlantıyı kapat
    mysqli_close($baglanti);
    ?>
     <!-- Çıkış Butonu -->
     <form action="logout.php" method="post">
        <input type="submit" value="Çıkış Yap">
    </form>
</body>
</html>
