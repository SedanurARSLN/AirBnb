<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <title>Airbnb Clone</title>
    <link rel="icon" type="image/png" href="images.png">
    <style>
       .background-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 300px; /* Resmin görünür yüksekliğini ayarlar */
    background-image: url('images/resim9.jpg');
    background-repeat: repeat;
    background-size: contain;    
}
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    margin: 0;
}
        .navbar {
            background-color: rgba(255, 255, 255, 0.5);
        }
        .nav-item {
            margin-right: 10px;
        }
        .navbar-brand {
            font-size: 1.5rem;
        }
        .navbar-nav .nav-link {
            font-size: 1.2rem;
        }
        .container {
            padding-top: 20px;
            color: #333;
            flex: 1;
        }
        .yorum .box-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(15rem, 1fr));
            gap: 1.0rem;
            max-width: 100%; /* Konteyner genişliğini sınırlamak için */
            margin: 0 auto; /* Konteynerı ortalar */
        }
        .yorum .box-container .box {
            border: var(--border);
            text-align: center;
            padding: 1rem;
            background-color: #BED1CF;
            border-radius: 1rem;
            width:100%;
        }
        .yorum .box-container .box p {
            font-size: 1.1rem;
            line-height: 1rem;
            padding: 0.5rem;
        }
        
        .yorum .box-container .box h3 {
            padding: 1rem 0;
            font-size: 1rem;
            color: #e43707;
        }
        
        footer {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="background-image"></div>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">Airbnb Clone</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="ilan-listele-css.php">İlanlar</a></li>
                <li class="nav-item"><a class="nav-link" href="ilan-ekle-css.php">İlan Ekle</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <!-- İçerik buraya gelecek -->
    </div>

    <!-- Yorumlar Bölümü -->
    <section class="yorum" id="yorum">
        <h1 class="heading" >Kullanıcılarımız <span>Ne</span> Diyor <span>?</span></h1>
        <div class="box-container">
            <div class="box">
                <img src="images/alıntı1.png" alt="alıntı" width="50">
                <p>Bu site, ev kiralama sürecini inanılmaz derecede kolaylaştırıyor! Sadece birkaç tıklama ile istediğiniz evi bulup hemen rezervasyon yapabiliyorsunuz. Hızlı ve güvenilir bir deneyim sunuyor..</p>
                <h3>Ahmet Kaya</h3>
                <div class="stars">
                    
                </div>
            </div>
            <div class="box">
                <img src="images/alıntı1.png" alt="alıntı" width="50">
                <p>Airbnb klon sitesi, çeşitli konumlarda çok sayıda ilan sunuyor. İster şehir merkezinde lüks bir daire, ister doğa içinde sakin bir ev arayın, her ihtiyaca uygun seçenek bulmak mümkün.</p>
                <h3>Fatma Gül TÜRKMEN</h3>
               
            </div>
            <div class="box">
                <img src="images/alıntı1.png" alt="alıntı" width="50">
                <p>Ev sahiplerinin profilleri ve daha önceki misafir yorumları sayesinde, kiralayacağınız yer hakkında önceden fikir sahibi olabiliyorsunuz. Bu, daha güvenli ve memnun edici bir kiralama deneyimi sağlıyor.</p>
                <h3>Sedanur ARSLAN</h3>
            </div>
            <div class="box">
                <img src="images/alıntı1.png" alt="alıntı" width="50">
                <p>Site, ev kiralama sürecini herkes için erişilebilir kılıyor. Arama filtreleri, kullanıcı dostu tasarımı ve kolay anlaşılır rezervasyon sistemi ile aradığınız evi bulmak çok basit.</p>
                <h3>Muhammed Memiş</h3>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Airbnb Clone. Tüm Hakları Saklıdır.</p>
    </footer>
</body>
</html>
