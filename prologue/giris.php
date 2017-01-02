<?php

# mysql baglantisi, sesion_start yapilmis varsayiyoruz

# bilgiler
  $kadi  = $_POST["kadi"];
  $sifre = $_POST["sifre"];

# kullanici bilgisi alalim
  $sorgu = mysql_query("select sifre from uyeler where kadi = '".$kadi."'");
  if( mysql_num_rows($sorgu) != 1 ){
    print '<script>alert("Kullanýcý bulunamadý!");history.back(-1);</script>';
    exit;
  }else{
    # veriyi alýyoruz
      $bilgi = mysql_fetch_assoc($sorgu);
  }

# sifre eslestirmesi
  if( md5( trim($sifre) ) != $bilgi["sifre"] ){
    print '<script>alert("Yanlýþ þifre girdiniz!");history.back(-1);</script>';
    exit;
  }

# baþarýlý giriþ yapýldý
# oturuma kaydedip anasayfaya gidelim
  $_SESSION["giris"] = md5( "kullanic_oturum_" . md5( $bilgi["sifre"] ) . "_ds785667f5e67w423yjgty" );
  $_SESSION["kadi"]  = $kadi;

?>
<script>
  alert("Baþarýyla giriþ yaptýnýz! Þimdi anasayfaya yönlendiriliyorsunuz.");
  window.top.location = './';
</script>