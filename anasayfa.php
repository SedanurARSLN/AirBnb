<?php
session_start();
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit;
}

include("baglantim.php");

// Kullanıcı bilgilerini al
$kullanici_id = $_SESSION['kullanici_id'];
$sorgu = $pdo->prepare("SELECT kullanici_adi FROM kullanicilar WHERE id = ?");
$sorgu->execute([$kullanici_id]);
$kullanici = $sorgu->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ana Sayfa</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Hoş Geldiniz, <?php echo htmlspecialchars($kullanici['kullanici_adi']); ?>!</h1>
        <p>Bu ana sayfadan ilan ekleyebilir, mevcut ilanlarınızı görebilirsiniz.</p>

        <div class="menu">
            <a href="ilan-ekle.php" class="button">İlan Ekle</a>
            <a href="ilan-listele.php" class="button">İlanları Listele</a>
            <a href="cikis.php" class="button">Çıkış Yap</a>
        </div>
    </div>
</body>
</html>
