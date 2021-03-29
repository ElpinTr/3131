<?
$s = $_GET['s'];
if ($s == ""){
header ("Location: ?s=1");
}

include "../cfg/db.php";

$limit = $site_ayar['sayfadefacesayisi'];
$ilk = $limit*($s-1);
$toplam_al = @mysql_query("SELECT * FROM kayitlar WHERE onay = 1 AND tur = 1");
$sayi = @mysql_num_rows($toplam_al);
$sayfa_sayisi = ceil($sayi/$limit);

include "../ust.php";
include "../cfg/sayfala.php";


?>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FF0000;
}
-->
</style>

	<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="78%" align="center">
<? echo '<tr><td colspan="4" align="center"><font size="3" color="blue">Special Defaceler</font></td></tr>'; ?>
				<tr>
				  <td width="50%" class="style1"><br />&nbsp;<b>Site</b></td>
 				  <td class="style1"><br /><b>Defacer</b></td>
 				  <td class="style1"><br /><center><b>Tarih</b></center></td>
			 	  <td class="style1"><br /><center>
			 	    <b>Mirr0r</b>
			 	  </center></td>
				</tr>
<?

if ($sayi==0){
echo '<tr><td colspan="5" align="center"><br /><big><b>Hiç special deface yok!</b></big></td></tr>';
} elseif ($s < 1 || $s > $sayfa_sayisi){
echo '<script> document.location="?s=1"; </script>';
} else {
$special_al = @mysql_query("SELECT * FROM kayitlar WHERE onay = 1 AND tur = 1 ORDER BY tarih DESC LIMIT $ilk,$limit");

echo '';

while ($special = @mysql_fetch_array($special_al)){

$tarih = $special["tarih"];
$tarih = date("d/m/Y",$tarih);

if ( strlen($special["url"]) > 40 ) $url = substr($special["url"], 0, 40)."...";
else $url = $special["url"];

?>
                    <tr onmouseover="this.style.backgroundColor='#EDF4FC';" onmouseout="this.style.backgroundColor='';">
                    <td width="42%" class="style1">&nbsp;<font size="2"><a class="link2" target="_blank" href="<? echo $special["url"]; ?>"><? echo $url; ?></a></font></td>
                    <td width="28%" class="style1"><font size="2"><img src="/img/yildiz.gif" />
                    <a href="/hacker/?user=<? echo $special["hacker"]; ?>"><? echo $special["hacker"]; ?></a></font></td>
		    <td width="20%" align="center" class="style1"><? echo $tarih; ?></td>
                    <td width="20%" class="style1"><center><a target="_blank" href="/deface_mirror/?id=<? echo $special["id"]; ?>">
                      <img border="0" src="/img/izle.gif" width="15" height="15"></a></center></td>
                  </tr>

<? } // while bitimi

echo '<tr><td align="center" colspan="5">
<br /><b><font face="Verdana" size="2">Toplam 
<font color="#FF0000">'.$sayi.'</font> Tane Special Deface Kaydý</font></b></td></tr>';

echo '<tr><td colspan="5" align="center"><br />';
sayfala($s,$sayi,$sayfa_sayisi,$limit);

} // Deface var mý kontrol

?>

<td class="style1"></td><td class="style1"></tr></table>

    <span class="style1">
    <? include "../alt.php"; 

?>
    </span>