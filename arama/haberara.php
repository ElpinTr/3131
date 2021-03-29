<?
$aranacak = htmlspecialchars(trim($_GET['id']));

$s = $_GET['s'];
if ($s == ""){
header ("Location: ?s=1&id=$aranacak");
}

if ($aranacak == "") header("Location: index.php");

include "../cfg/db.php";
$limit = $site_ayar['sayfahabersayisi'];
$ilk = $limit*($s-1);
$toplam_al = mysql_query("SELECT * FROM haberler WHERE baslik LIKE '%$aranacak%' OR icerik LIKE '%$aranacak%'");
$sayi = mysql_num_rows($toplam_al);
mysql_free_result($toplam_al);
$sayfa_sayisi = ceil($sayi/$limit);

if ($sayi != 0 && ($s < 1 || $s > $sayfa_sayisi) ){
header ("Location: ?s=1&id=$aranacak");
}

include "../cfg/sayfala4.php";
include "../ust.php";
include "../sol.php";

$sorgu = mysql_query("SELECT * FROM haberler WHERE baslik LIKE '%$aranacak%' OR icerik LIKE '%$aranacak%' ORDER BY tarih DESC LIMIT $ilk,$limit");
$kontrol = mysql_num_rows($sorgu);

if ($kontrol > 0){

?>
<style type="text/css">
<!--
.style1 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #FF0000;
}
.style9 {color: #999999}
-->
</style>


		<div class="content">
			<div class="item" style="width: 524; height: 585">

		          <center>
		            <h5><span class="style1">Arma Sonu&ccedil;Lar&#305;</span></h5>
		          </center>
			  <div class="descr">
                  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="78%">

<?
while ( $haber = mysql_fetch_array($sorgu) ){

$tarih = $haber["tarih"];
$tarih = date("d/m/Y H:i",$tarih);

echo '<tr><td><img src="/img/vurgu.gif" /><b>'.$haber["baslik"].'</b></td></tr>';
echo '<tr><td>'.$haber["tanitim"].'<br /><br /><br /><br /></td></tr>';
echo '<tr><td align="right"><b>Yazar:</b> '.$haber["yazar"].'&nbsp;&nbsp;<b>Tarih:</b> '.$tarih.'</td></tr>';
echo '<tr><td align="right"><img src="/img/turuncuok.gif" /><a href="/haber/haber.php?id='.$haber["id"].'">Devamý</a>><br /><br /></td></tr>';

} // while bitimi

echo '<tr><td colspan="5" align="center"><br />';
sayfala($s,$sayi,$sayfa_sayisi,$limit,$aranacak);
echo '</td></tr>';

} else { // Haber yoksa
echo '<script language="javascript">
alert ("Sonuç Bulunamadý Tekrar Arama Yapýnýz");
document.location="index.php";
</script>';
}

?>

</table>

<? include "../alt.php"; ?>