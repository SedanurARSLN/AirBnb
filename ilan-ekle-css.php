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
    <link rel="icon" href="images.png">

    <style>
        /* Genel sayfa stili */
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/resim6.jpg');
            background-size:100% auto;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f4f8;
        }

        /* Form kutusunun stili */
        .container {
            background-color: rgba(255,255,255,0.9);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        /* Form başlığı */
        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Form etiketlerinin stili */
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
            text-align: left;
        }

        /* Form elemanlarının genel stili */
        input[type="number"],
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #f9fafb;
            transition: border-color 0.3s ease;
        }

        /* Form elemanlarına odaklanıldığında */
        input[type="number"]:focus,
        input[type="text"]:focus,
        textarea:focus {
            border-color: #5c9dd1;
            outline: none;
        }

        /* Gönder butonunun stili */
        .ilanE {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 12px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Gönder butonuna fare ile gelindiğinde */
        .ilanE:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Yeni İlan Ekle</h2>
        <form action="" method="post">
            <label for="user_id">İlan Sahibi Kullanıcı ID:</label>
            <input type="number" id="user_id" name="user_id" required>

            <label for="title">İlan Başlık:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">İlan Açıklaması:</label>
            <textarea id="description" name="description" rows="5" cols="40" required></textarea>

            <label for="nightly_price">Gecelik Fiyat:</label>
            <input type="text" id="nightly_price" name="nightly_price" required>

            <label for="location">İlanın Konumu:</label>
            <input type="text" id="location" name="location" required>

            <input class="ilanE" type="submit" value="İlanı Ekle">
        </form>
    </div>
</body>
</html>
