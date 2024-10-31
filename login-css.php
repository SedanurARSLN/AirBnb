<?php
include("baglantim.php");
$email_err=$parola_err="";

if(isset($_POST["giris"]))//name kaydet olduğu için
{

        //Email doğrulama
        if(empty($_POST["email"])){

            $email_err="Email alanı boş geçilemez.";
        }

        else {
            $email=$_POST["email"];
        }

        //Parola Doğrulama Kısmı

        if (empty($_POST["parola"])) {
            
            $parola_err="Parola boş geçilemez";
        }

        else{

            $parola=$_POST["parola"];
        }

     
    //$parola=password_hash($_POST["parola"],PASSWORD_DEFAULT); parola verisini değişkene atadım


        if(isset($email)&& isset($parola))
        {
            $secim="SELECT * FROM kullanicilar WHERE email='$email'";
            $calistir=mysqli_query($baglanti,$secim);
            $kayitsayisi=mysqli_num_rows($calistir);// ya 0 ya da 1 dir

            if ($kayitsayisi>0) {
               
                $ilgilikayit=mysqli_fetch_assoc($calistir);
                $hashlisifre=$ilgilikayit["parola"];


                if(password_verify($parola,$hashlisifre)){

                    session_start();
                    $_SESSION["kullanici_adi"]=$ilgilikayit["kullanici_adi"];
                    $_SESSION["email"]=$ilgilikayit["email"];
                    header("Location:template.php");

                }

                else{
                    echo '<div class="alert alert-danger" role="alert">
            Parola Yanlış.
     </div>';
                }           
            }
            else {
                echo '<div class="alert alert-danger" role="alert">
            Kullanıcı Adı Yanlış.
     </div>';
            }



    mysqli_close($baglanti);

}
}
?>

<!doctype html>
<html lang="ar" >
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

    <title>ÜYE GİRİŞ İŞLEMİ</title>

    <style>
        body {
            background-image: url('images/giris.jpg'); /* Arka plan resmi */
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            color: #fff; /* Yazı rengi */
            font-family: 'Arial', sans-serif;
        }

        .container {
            background: rgba(0, 0, 0, 0.4); /* Form arka planı için şeffaf siyah katman */
            border-radius: 15px;
            padding: 30px;
            max-width: 450px;
            margin-top: 180px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); /* Gölge efekti */
        }

        .form-label {
            font-weight: bold;
            color: #FF407D; /* Başlık rengi */
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.2); /* Form alanı arka planı */
            border: 2px solid #FFF6EA;
            color: #fff;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.3);
            border-color: #FEECB3;
            box-shadow: none;
        }

        .btn-primary {
    background-color: #295F98; /* Butonun temel rengi */
    border: none;
    color: #fff;
    font-weight: bold;
    padding: 12px 24px;
    border-radius: 50px; /* Yuvarlatılmış köşeler */
    transition: background-color 0.3s, transform 0.3s;
    position: relative;
    overflow: hidden;
    margin-top: 20px; /* Butonu aşağıya taşıyan margin */
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 300%;
    height: 300%;
    transform: translate(-50%, -50%) scale(0);
    border-radius: 50%;
    transition: transform 0.5s;
}

.btn-primary:hover::before {
    transform: translate(-50%, -50%) scale(1);
}

.btn-primary:hover {
    background-color: #295F98; /* Hover efekti */
    transform: translateY(-3px); /* Butonun hover sırasında yukarı kayması */
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
}

.btn-primary:active {
    transform: translateY(-1px); /* Butona tıklanınca hafifçe geri gelmesi */
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
}
.invalid-feedback {
            font-size: 0.9em;
            color: #ff4444; /* Hata mesajı rengi */}

        .card {
            border: none;
            background: transparent;
        }
    </style>
  </head>
  <body>
   <div class="container">
    <div class="card">
            <form action="login.php" method="POST">

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email Adresi</label>
            <input type="text" class="form-control 
            <?php
            if (!empty($email_err)) {
                echo "is-invalid";
            }
            ?>
            " id="exampleInputEmail1" name="email">
            <div id="validationServer03Feedback" class="invalid-feedback">
    <?php
   echo $email_err;
    ?>
    </div>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Parola</label>
            <input type="password" class="form-control 
            <?php
           if (!empty($parola_err)) {
            echo " is-invalid";
           }
           ?>
            " id="exampleInputPassword1" name="parola">
            <div id="validationServer03Feedback" class="invalid-feedback">
    <?php
    echo $parola_err;
    ?>
    </div>
        </div>

        <button type="submit" name="giris" class="btn btn-primary">GİRİŞ YAP</button>
        </form>

    </div>
   </div>

    <!-- Optional JavaScript; choose one of the two! -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
