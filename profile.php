<?php

session_start();
if (isset($_SESSION["kullanici_adi"])) {
   
    echo "<h3>".$_SESSION["kullanici_adi"]." HOŞGELDİN</h3>";
    echo "<h3>".$_SESSION["email"]."</h3>";

    echo "<a href='cikis.php' style='color:blue; background-color:#FF8C9E ;border: 1px solid #FF4E88; padding:5px 5px;'>ÇIKIŞ YAP</a> ";
}
 else {
    
    echo "Bu sayfayı görüntüleme yetkiniz yoktur.";
 }

?>