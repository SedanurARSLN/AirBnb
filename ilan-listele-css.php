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
        /* Genel stil */
        body {
            font-family: Arial, sans-serif;
            background-image:url('images/resim.jpg'); /* Arka plana resim ekler */
            background-size:contain; 
            background-repeat: repeat;
            background-attachment: fixed;
             background-color: rgba(255, 255, 255, 0); /* Şeffaf bir arka plan rengi */
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            font-size: 2.5em;
            color: #f4f4f4;
            text-shadow: 2px 2px 5px #000;
        }

        h3 {
            color: #222;
            font-size: 1.8em;
            border-bottom: 2px solid #777;
            padding-bottom: 5px;
        }

        h4 {
            color: #555;
            font-size: 1.5em;
            margin-top: 20px;
        }

        p {
            line-height: 1.6;
        }

        /* Tablo stil */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: rgba(255, 255, 255, 0.9); /* Tablo arka planını şeffaf yapar */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            color: #333;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        /* Çıkış butonu stil */
        input[type="submit"] {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 20px;
            display: block;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        /* Genel stil düzenlemeleri */
        .container {
            max-width: 900px;
            margin: auto;
            background: rgba(255, 255, 255, 0.8); /* Sayfanın genel arka planını şeffaf yapar */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>İlanlar ve Rezervasyonlar</h2>
        <?php while ($ilan = mysqli_fetch_assoc($ilan_sonuc)): ?>
            <h3><?php echo htmlspecialchars($ilan['title']); ?></h3>
            <p><strong>İlan Açıklama:</strong> <?php echo htmlspecialchars($ilan['description']); ?></p>
            <p><strong>Gecelik Fiyat:</strong> <?php echo htmlspecialchars($ilan['nightly_price']); ?> TL</p>
            <p><strong>İlanın Konumu:</strong> <?php echo htmlspecialchars($ilan['location']); ?></p>
            <p><strong>Oluşturulma Tarihi:</strong> <?php echo htmlspecialchars($ilan['created_at']); ?></p>

            <h4>Rezervasyonlar:</h4>
            <?php
            $stmt = mysqli_prepare($baglanti, $reservasyon_query);
            mysqli_stmt_bind_param($stmt, 'i', $ilan['id']);
            mysqli_stmt_execute($stmt);
            $rezervasyon_sonuc = mysqli_stmt_get_result($stmt);

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
                        <?php while ($rezervasyon = mysqli_fetch_assoc($rezervasyon_sonuc)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($rezervasyon['user_id']); ?></td>
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
        mysqli_close($baglanti);
        ?>
        <!-- Çıkış Butonu -->
        <form action="logout.php" method="post">
            <input type="submit" value="Çıkış Yap">
        </form>
    </div>
</body>
</html>
