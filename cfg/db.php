<?

$host = "localhost";
$k_adi = "root";
$sifre = "4992010";
$db = "mirror";

@mysql_connect("$host","$k_adi","$sifre") or die("Sistemimize SaLdýrý YapýLmaktadýr. Sayfayý YeniLeyiniz !");
@mysql_select_db("$db") or die ("Database Yedek ALýy0r !");

$site_ayar_al = @mysql_query("SELECT * FROM ayarlar");
$site_ayar = @mysql_fetch_array($site_ayar_al);

?>