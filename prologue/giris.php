<?php

# mysql baglantisi, sesion_start yapilmis varsayiyoruz

# bilgiler
  $kadi  = $_POST["kadi"];
  $sifre = $_POST["sifre"];

# kullanici bilgisi alalim
  $sorgu = mysql_query("select sifre from uyeler where kadi = '".$kadi."'");
  if( mysql_num_rows($sorgu) != 1 ){
    print '<script>alert("Kullan�c� bulunamad�!");history.back(-1);</script>';
    exit;
  }else{
    # veriyi al�yoruz
      $bilgi = mysql_fetch_assoc($sorgu);
  }

# sifre eslestirmesi
  if( md5( trim($sifre) ) != $bilgi["sifre"] ){
    print '<script>alert("Yanl�� �ifre girdiniz!");history.back(-1);</script>';
    exit;
  }

# ba�ar�l� giri� yap�ld�
# oturuma kaydedip anasayfaya gidelim
  $_SESSION["giris"] = md5( "kullanic_oturum_" . md5( $bilgi["sifre"] ) . "_ds785667f5e67w423yjgty" );
  $_SESSION["kadi"]  = $kadi;

?>
<script>
  alert("Ba�ar�yla giri� yapt�n�z! �imdi anasayfaya y�nlendiriliyorsunuz.");
  window.top.location = './';
</script>