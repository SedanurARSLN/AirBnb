<?php

session_start();
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous">

    <title>Profil Sayfası</title>

    <style>
        body {
            background-color: #FFCAD4; /* Arka plan rengi */
            font-family: Arial, sans-serif; /* Yazı tipi */
        }

        .container {
            max-width: 500px; /* Konteyner genişliği */
            margin-top: 50px; /* Üst boşluk */
            padding: 30px; /* İç boşluk */
            background-color: #ffffff; /* Arka plan rengi */
            border-radius: 10px; /* Köşe yuvarlama */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Gölge efekti */
        }

        .hosgeldin-mesaj{
            font-size: 1.5em; /* Yazı boyutu */
            color: #333; /* Yazı rengi */
            margin-bottom: 20px; /* Alt boşluk */
        }

        .btn-logout {
            display: inline-block;
            font-size: 1em;
            color: #ffffff;
            background-color: #FF8C9E;
            border: 1px solid #FF4E88;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .btn-logout:hover {
            background-color: #FF4E88;
            border-color: #FF8C9E;
        }

        .access-denied {
            font-size: 1.2em;
            color: #FF4E88;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    if (isset($_SESSION["kullanici_adi"])) {
        echo "<div class='hosgeldin-mesaj'>Hoşgeldin, ".$_SESSION["kullanici_adi"]."!</div>";
        echo "<div class='hosgeldin-mesaj'>Email: ".$_SESSION["email"]."</div>";
        echo "<a href='cikis.php' class='btn-logout'>ÇIKIŞ YAP</a>";
    } else {
        echo "<div class='access-denied'>Bu sayfayı görüntüleme yetkiniz yoktur.</div>";
    }
    ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
