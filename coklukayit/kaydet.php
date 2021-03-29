<? 
session_start();
include "../ust.php";
include "../sol.php";

echo '<div class="story">';

$d = $_POST['d'];

for ($i=1;$i<=$d;$i++){
$almaadi = "site".$i;
$site.$i = htmlspecialchars(trim($_POST["$almaadi"]));
} // for bitim

$hacker = htmlspecialchars(trim($_POST['hacker']));
$sunucu = $_POST['sunucu'];

if($_POST['gkodumuz'] == "123456" && $_POST['zgkod'] == "123456"){ // güvenlik kontrol

if(empty($hacker)){

echo "<center>Hacker adý yazýnýz!<br/><br/>";
echo '<a href="javascript:history.back(1)">Geri dönmek için týklayýn</a></center>';

} elseif( strlen($hacker) < 4 ) {

echo "<center>Nickiniz 4 karakterden kýsa olamaz!<br/><br/>";
echo '<a href="javascript:history.back(1)">Geri dönmek için týklayýn</a></center>';

} elseif( strlen($hacker) > 20 ) {

echo "<center>Nickiniz 3 karakterden kýsa olamaz!<br/><br/>";
echo '<a href="javascript:history.back(1)">Geri dönmek için týklayýn</a></center>';

} elseif( ereg("[ÇçÐðÝýÖöÞþÜü ]",$hacker) ) {

echo "<center>Nickinizde türkçe karakter veya boþluk kullanmayýnýz!<br/><br/>";
echo '<a href="javascript:history.back(1)">Geri dönmek için týklayýn</a></center>';

} elseif(empty($_POST['kod']) || empty($_SESSION['guv']) || !$_SESSION['guv']){

echo "<center>Güvenlik kodunu giriniz!<br/><br/>";
echo '<a href="javascript:history.back(1)">Geri dönmek için týklayýn</a></center>';

} elseif($_POST['kod'] != $_SESSION['guv']){

echo "<center>Güvenlik kodunu doðru giriniz!<br/><br/>";
echo '<a href="javascript:history.back(1)">Geri dönmek için týklayýn</a></center>';

} else {

  //Güvenlik Kodunu Temizle
  unset($_SESSION['guv']);

echo '<div align="center" class="title">Çoklu Deface Kaydý Raporu</div><br />';

$bosincele = 0;

for ($i=1;$i<=$d;$i++){ // Her kayýt için inceleme
$a = "site".$i;
$site = $$a;

if ($site != "http://"){ // Deðiþtirilmiþse yani incelenecekse

if (strlen($site) < 11){
echo "<center><b>".$i.". Deface:</b> Deface Siteniz 11 karakterden küçük olamaz! (".$site.")</center>";
} elseif (strlen($site) > 100){
echo "<center><b>".$i.". Deface:</b> Deface Siteniz 100 karakterden büyük olamaz! (".$site.")</center>";
} elseif( substr($site.$i, 0, 7) != "http://")  {
echo "<center><b>".$i.". Deface:</b> Deface Siteniz http:// ile baþlamalý! (".$site.")</center>";
} else {

$altiay = 60 * 60  * 60 * 24 * 30 * 6;
$simdi = time();

// KAYIT KONTROL

if ( strstr($site, "www") ){

$ilk = strpos($site, ".");
$orta = substr($site, $ilk+1);
$ilkson = strpos($orta, "/");
$orta = substr($site, $ilk+1, $ilkson+1);

$uzunluk = strlen($orta);
$son = substr($orta, $uzunluk-1);

if ($son == "/"){
$ara = substr($orta, 0, $uzunluk-1);
} else {
$ara = $orta;
}

} else { // www yoksa

$orta = substr($site, 7);
$ilkson = strpos($orta, "/");
$orta = substr($orta, 0, $ilkson+1);

$uzunluk = strlen($orta);
$son = substr($orta, $uzunluk-1);

if ($son == "/"){
$ara = substr($orta, 0, $uzunluk-1);
} else {
$ara = $orta;
}

} // www var mý kontrol

$kontrol_yap = mysql_query("SELECT * FROM kayitlar WHERE url LIKE '%$ara%' AND $simdi - tarih < $altiay");
$kontrol = mysql_num_rows($kontrol_yap);

if($kontrol > 0){ // eskiden var mý kontrol

echo "<center><b>".$i.". Deface:</b> Bu adres zaten kayýtlý! (".$site.")</center>";

} else { // Eskiden yoksa

///site aç veya yanlýþ adresi göster ////

$crl = curl_init();

curl_setopt($crl, CURLOPT_TIMEOUT, "15");
curl_setopt($crl, CURLOPT_URL, "$site");
curl_setopt($crl, CURLOPT_HEADER, 0);
curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);

$icerik = addslashes(curl_exec($crl));

curl_close($crl);

if ($icerik == "")
echo '<center><b>'.$i.'. Deface:</b> Girdiðiniz Adres\'in doðru olduðuna emin olunuz! ('.$site.')</center>';
else { // içerik varsa

/// EKLEME ////

$tarih = time();
$hacker = addslashes($hacker);

$ekle = @mysql_query("INSERT INTO kayitlar (id, hacker, url, icerik, tarih, onay, tur)
VALUES('', '$hacker', '$site', '$icerik', '$tarih', '0','0') ");

$kayit_bak = mysql_query("SELECT * FROM hackerlar WHERE hacker = '$hacker'");
$kayit_sayisi = mysql_num_rows($kayit_bak);

if ($kayit_sayisi > 0){ // daha önce kayýdý varsa

$ekle2 = mysql_query("UPDATE hackerlar SET onaysiz = onaysiz + 1, deface = deface + 1 WHERE hacker = '$hacker'");

} else { // daha önce kayýdý yoksa

$ekle2 = mysql_query("INSERT INTO hackerlar (id, hacker, onaysiz, onayli, deface) VALUES('', '$hacker', '1', '0', '1') ");

} // daha önce kayýt kontrol kapa

if ($ekle && $ekle2){
echo '<center><b>'.$i.'. Deface:</b> Site onholddadýr. Ýncelenince deface listesine eklenecektir! ('.$site.')</center>';
} else {
echo '<center><b>'.$i.'. Deface:</b> Site eklenirken bir hata oluþtu.! ('.$site.')</center><br />';
} // ekle kontrol

} // Adres doðruluðu kontrol
} // Eskiden var mý kontrol
} // for içi kontroller

} else { // incelenmiyorsa
echo '<center><b>'.$i.'. Deface:</b> Ýncelenmedi.</center>';
$bosincele++;
} // inceleme kontrol
} // her kayýt kontrolü for bitimi

if ($bosincele == $d){ // Eðer hiç biri incelenmediyse
echo '<br /><center><big><b>Hiç bir kayýt incelenmedi lütfen adresleri kontrol ediniz!</b></big></center>';
}

echo '<center><br /><a href="/coklukayit/">Geri dönmek için týklayýn</a></center>';

} // empty kontrol

} else { // submit kontrol gkod kontrolleri

echo "<center>Lütfen doðru adresten kayýt yaptýrýnýz!<br/><br/>";
echo '<a href="javascript:history.back(1)">Geri dönmek için týklayýn</a></center>';

}

?>

</div>

<? include "../alt.php"; ?>