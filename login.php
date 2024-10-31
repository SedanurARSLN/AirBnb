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
                    
                    header("location:template.php");
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
  </head>
  <body>
   <div class="container p-5">
    <div class="card p-5">
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

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    -->
  </body>
</html>
