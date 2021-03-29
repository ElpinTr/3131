<?
$s = $_GET['s'];
if ($s == ""){
header ("Location: ?s=1");
}

include "../cfg/db.php";

$limit = $site_ayar['sayfahabersayisi'];
$ilk = $limit*($s-1);
$toplam_al = mysql_query("SELECT * FROM haberler");
$sayi = mysql_num_rows($toplam_al);
mysql_free_result($toplam_al);
$sayfa_sayisi = ceil($sayi/$limit);

if ($s < 1 || $s > $sayfa_sayisi){
header ("Location: ?s=1");
}

include "../cfg/sayfala.php";
include "../ust.php";
include "../sol.php";

?>
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>


	<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="70%" align="center">
<tr>
  <td colspan="2" align="center"><span class="style1"><font size="3"><center><img src="/img/haberler.gif" /></center> </font><br />
      <br />
  </span></td>
</tr>
<?

$haber_al = @mysql_query("SELECT * FROM haberler ORDER BY tarih DESC LIMIT $ilk,$limit");
$bos_kontrol = @mysql_num_rows($haber_al);

if ($bos_kontrol > 0){

while ($haber = mysql_fetch_array($haber_al)){

$tarih = $haber["tarih"];
$tarih = date("d/m/Y H:i",$tarih);

echo '<tr><td><img src="/img/vurgu.gif" /><b>'.$haber["baslik"].'</b></td></tr>';
echo '<tr><td>'.$haber["tanitim"].'<br /><br /><br /><br /></td></tr>';
echo '<tr><td align="right"><img src="/img/yazar.gif" /> '.$haber["yazar"].'&nbsp;&nbsp;<img src="/img/tarih.gif" /> <b><font color=#ff3300>'.$tarih.'</b></font></td></tr>';
echo '<tr><td align="right"><img src="/img/turuncuok.gif" /><a href="/haber/haber.php?id='.$haber["id"].'">Devamý</a>><br /><br /></td></tr>';

} // while bitimi

echo '<tr><td colspan="5" align="center"><br />';
sayfala($s,$sayi,$sayfa_sayisi,$limit);
echo '</td></tr>';

} else { // Haber yoksa
echo '<tr><td align="center"><br />Henüz hiç haber eklenmemiþ!</td></tr>';
}

?>

</table>

<? include "../alt.php"; 

?>