<?php
if (isset($_POST['sm'],$_POST['smk'])&& !empty($_POST['sm']) && !empty($_POST['smk'])) {//Sayfa geldiğinde bir veri geliyorsa ve boş değilse
    function sifrele($sifrelenecekmetin,$sifrelenecekmetinkatsayi){// Şifreleme fonksiyonu yazıldı
        $harfler = "abcdefghijklmnoprstuvyzABCDEFGHIJKLMNOPRSTUVYZ";//alfabe belirlendi
        $sayilar = "0123456789";//sayılar belirlendi
        $sifrelenmismetin=null;
        for ($i=0; $i < strlen($sifrelenecekmetin) ; $i++) {
            for ($j=0; $j <strlen($harfler) ; $j++) {
             if ($sifrelenecekmetin[$i]==$harfler[$j]) {//string içerisinden gelen her karakter alfabade var mı ona bakıldı
                if ($j+1>23) {//sayı değeri 23 den büyükse büyük harf değilse küçük harf olduğu belirlendi
                    if ($j+1+$sifrelenecekmetinkatsayi>46) {//sayı değeri 46 dan büyükse Z den sonra A ya geçildi
                        //$test = mb_convert_encoding($harfler[$j+$sifrelenecekmetinkatsayi-28],"UTF-8", "auto");
                        //echo "*".$test."**";
                        /* echo $sifrelenecekmetin[$i]."1b===>".$harfler[$j+$sifrelenecekmetinkatsayi-23]."<br>"; */
                        $sifrelenmismetin.=$harfler[$j+$sifrelenecekmetinkatsayi-23];
                        break;
                    }
                    else{//sayı değeri 46 dan büyük değilse yazıldı
                        /* echo $sifrelenecekmetin[$i]."2b===>".$harfler[$j+$sifrelenecekmetinkatsayi]."<br>"; */
                        $sifrelenmismetin.=$harfler[$j+$sifrelenecekmetinkatsayi];
                        break;
                    }
                } else {
                    if ($j+1+$sifrelenecekmetinkatsayi>23) {//sayı değeri 23 den büyükse küçük z den a ya geçildi
                        //$test = mb_convert_encoding($harfler[$j+$sifrelenecekmetinkatsayi-28],"UTF-8", "auto");
                        //echo "*".$test."**";
                        /* echo $sifrelenecekmetin[$i]."1k===>".$harfler[$j+$sifrelenecekmetinkatsayi-23]."<br>"; */
                        $sifrelenmismetin.=$harfler[$j+$sifrelenecekmetinkatsayi-23];
                        break;
                    }
                    else{
                        /* echo $sifrelenecekmetin[$i]."2k===>".$harfler[$j+$sifrelenecekmetinkatsayi]."<br>"; */
                        $sifrelenmismetin.=$harfler[$j+$sifrelenecekmetinkatsayi];
                        break;
                    }
                    
                 }


                }
                
            }
            for ($k=0; $k <strlen($sayilar) ; $k++) { // gelen string içerisinde sayı var mı o kontrol edildi
                if ($sifrelenecekmetin[$i]==$sayilar[$k]) {
                    if ($k+$sifrelenecekmetinkatsayi>9) {//sayı değeri kaydırıldığında 9 u geçerse 0 a döndürülmesi yapıldı
                        /* echo $sayilar[($k+$sifrelenecekmetinkatsayi)-10]."<br>"; */
                        $sifrelenmismetin.=$sayilar[($k+$sifrelenecekmetinkatsayi)-10];
                        break;
                    }else{
                        /* echo $sayilar[$k+$sifrelenecekmetinkatsayi]."<br>"; */
                        $sifrelenmismetin.=$sayilar[$k+$sifrelenecekmetinkatsayi];
                        break;
                    }
                    
                    /* echo  "burası"."<br>"; *///$sifrelenecekmetin[$i]."s".$k."===>".$sayilar[$k+$sifrelenecekmetinkatsayi]."<br>"; 
                }
            } 
            
            $gecicikarakter = $sifrelenecekmetin[$i]."<br>";
            
        }
        return $sifrelenmismetin;//fonksiyondan şifrelenmiş metin geri döndürüldü
    }
    $sifrelenecekmetin = $_POST['sm'];
    $sifrelenecekmetinkatsayi = $_POST['smk'];
    $sifrelenecekmetinkatsayi = $sifrelenecekmetinkatsayi % 26;//katsayı 26 dan büyüksse 26 ya göre mod alınıp alfabe dışına çıkılmadı
    //echo strlen($sifrelenecekmetin);
    $sifrelimetin=sifrele($sifrelenecekmetin,$sifrelenecekmetinkatsayi);
}

?>
<!doctype html>
<html lang="tr">
  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title></title>
  </head>
  <body>
    <div class="container bg-primary p-3">
        <h2>Şifrelenmiş Metniniz</h2>
        <div class="w-100 bg-white">
            <p><?php
                if (isset($sifrelimetin)) {//şifreli metin ekrana yazdırıldı
                    echo $sifrelimetin;
                }else{
                    echo "şifrelenecek metni aşağıya giriniz..";
                }
            ?></p>
        </div>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <div class="mb-3">
            <label for="sm" class="form-label">Şifrelenecek Metni Giriniz</label>
            <input type="text" class="form-control" name="sm" id="sm" aria-describedby="sm">
        </div>
        <div class="mb-3">
            <label for="smk" class="form-label">Katsayı Giriniz</label>
            <input type="text" class="form-control" name="smk" id="smk">
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        </form>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>