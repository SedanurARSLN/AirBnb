<?php

$host = "localhost";
$kullanici_adi = "root";
$parola = "";
$vt = "ekleme"; 

$baglanti = mysqli_connect($host, $kullanici_adi, $parola, $vt);

if (!$baglanti) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = mysqli_real_escape_string($baglanti, $_POST['user_id']);
    $title = mysqli_real_escape_string($baglanti, $_POST['title']);
    $description = mysqli_real_escape_string($baglanti, $_POST['description']);
    $nightly_price = mysqli_real_escape_string($baglanti, $_POST['nightly_price']);
    $location = mysqli_real_escape_string($baglanti, $_POST['location']);

    // Formun boş olup olmadığını kontrol ettim
    if (empty($user_id) || empty($title) || empty($description) || empty($nightly_price) || empty($location)) {
        echo "Lütfen tüm alanları doldurun.";
    } else {
        // İlanı veritabanına ekledim
        $sql = "INSERT INTO listings (user_id, title, description, nightly_price, location) 
                VALUES ('$user_id', '$title', '$description', '$nightly_price', '$location')";

        if (mysqli_query($baglanti, $sql)) {
            echo "İlan başarıyla eklendi.";

            header("Location:ilan_listele.php");
            
            exit();

        } else {
            echo "Hata: " . mysqli_error($baglanti);
        }
    }
}

// Bağlantıyı kapat
mysqli_close($baglanti);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İlan Ekleme Sayfası</title>
</head>
<body>
    <h2>Yeni İlan Ekle</h2>
    <form action="" method="post">
        <label for="user_id">İlan Sahibi Kullanıcı ID:</label><br>
        <input type="number" id="user_id" name="user_id" required><br><br>

        <label for="title">İlan Başlık:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">İlan Açıklaması:</label><br>
        <textarea id="description" name="description" rows="5" cols="40" required></textarea><br><br>

        <label for="nightly_price">Gecelik Fiyat:</label><br>
        <input type="text" id="nightly_price" name="nightly_price" required><br><br>

        <label for="location">İlanın Konumu:</label><br>
        <input type="text" id="location" name="location" required><br><br>

        <input type="submit" value="İlanı Ekle">
    </form>
</body>
</html>
