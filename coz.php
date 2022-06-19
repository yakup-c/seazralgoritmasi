<?php
if (isset($_POST['sm'])&& !empty($_POST['sm'])) {//Sayfa geldiğinde bir veri geliyorsa ve boş değilse
    function coz($sifrelenecekmetin){ // coz fonksiyonu oluşturuldu bu fonksiyon gelen string ifadenin elemanlarının hangi harfe karşılık geldiğini bulup bundan sonraki harfleri ve önceki harfleri döndürüyor. 
        $harfler = "abcdefghijklmnoprstuvyz";
        $sayilar = "0123456789";
        $cozulmusmetin=null;
        for ($i=0; $i < strlen($sifrelenecekmetin) ; $i++) {
            for ($j=0; $j <strlen($harfler) ; $j++) {
             if ($sifrelenecekmetin[$i]==$harfler[$j]) {
                $gecicisayi = $j;
                $sayi=0;
                for ($z=0; $z <strlen($harfler) ; $z++) {
                    if ($gecicisayi+$z>22) {//sayı değeri 22 den büyükse yeni baştaki harfe geçiyor
                        /* echo $harfler[$sayi]; */
                        $cozulmusmetin[$i][]= $harfler[$sayi];//Gelen dizinin elemanları kadar dönerken her elemanı brute force ile denemekte
                        $sayi++;
                    }else{
                    /* echo $harfler[$gecicisayi+$z]; */
                    $cozulmusmetin[$i][]= $harfler[$gecicisayi+$z];

                    }
                }
                } 
                
            }
            
        }
        return $cozulmusmetin;//sonuc dizisini döndürmekte
    }
    $sifrelenecekmetin = $_POST['sm'];
    $sifrelimetin=coz($sifrelenecekmetin);
    
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
            <p>
                <?php
                if (isset($sifrelimetin)) {
                    for ($j=0; $j < 23 ; $j++) {//alfabedeki belirtilen harf sayısı
                        for ($i=0; $i < count($sifrelimetin) ; $i++) { //kaç karakterli string geliyorsa her karakter için tüm alfabeyi döndürüyor senkron şekilde
                            echo $sifrelimetin[$i][$j];//ekrana yazdırıyoruz
                        }
                        echo "<br>";
                    }
                }
                ?>
            </p>
        </div>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post"><!-- Buradaki actionun içinde yazan parametre gelen veriyi gene aynı sayfaya post etmekte -->
        <div class="mb-3">
            <label for="sm" class="form-label">şifrelenmiş Metni Giriniz</label>
            <input type="text" class="form-control" name="sm" id="sm" aria-describedby="sm">
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        </form>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>