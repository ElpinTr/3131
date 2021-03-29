<?
$s = $_GET['s'];
if ($s == ""){
header ("Location: ?s=1");
}

include "../cfg/db.php";

$limit = $site_ayar['sayfadefacesayisi'];
$ilk = $limit*($s-1);
$toplam_al = @mysql_query("SELECT * FROM kayitlar WHERE onay = 1");
$sayi = @mysql_num_rows($toplam_al);
$arsiv_al = @mysql_query("SELECT * FROM kayitlar WHERE onay = 1 ORDER BY tarih DESC LIMIT $ilk,$limit");
$sayfa_sayisi = ceil($sayi/$limit);

if ($s < 1 || $s > $sayfa_sayisi){

}

include "../cfg/sayfala.php";
include "../ust.php";


?>
<style type="text/css">
<!--
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #FF0000; }
.style4 {
	color: #FF0000;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>

	<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="75%" align="center">
<? echo '<tr><td colspan="5" align="center"><font size="3" color="blue">Harbimeydan Deface Arsivi</font></td></tr>'; ?>
                  <tr>
                    <td width="58%"><span class="style3"><br />
                    &nbsp;<b>Site</b></span></td>
                    <td><br /></td>
                    <td><span class="style3"><br />
                      <b>Defacer</b></span></td>
                    <td><span class="style3"><br />
                    </span>                      <center class="style3">
                      <span class="style4">Tarih</span>
                    </center></td>
                    <td><span class="style3"><br />
                    </span>                      <center class="style3">
                      <span class="style4">Mirr0r</span>
                    </center></td>
                  </tr>

<?
while ($arsiv = @mysql_fetch_array($arsiv_al)){

$tarih = $arsiv["tarih"];
$tarih = date("d/m/Y",$tarih);

if($arsiv["tur"]) $resim = '<img src="/img/yildiz.gif">';
else $resim = "";

if ( strlen($arsiv["url"]) > 45 ) $url = substr($arsiv["url"], 0, 45)."...";
else $url = $arsiv["url"];

?>
                    <tr onmouseover="this.style.backgroundColor='#EDF4FC';" onmouseout="this.style.backgroundColor='';">
                    <td><font size="2"><a class="link2" target="_blank" href="<? echo $arsiv["url"]; ?>"><? echo $url; ?></a></font></td>
		    <td><? echo $resim; ?></td>
                    <td><font face="Tahoma" size="2">
                    <a href="/hacker/?user=<? echo $arsiv["hacker"]; ?>"><? echo $arsiv["hacker"]; ?></a></font></td>
		    <td align="center"><? echo $tarih; ?></td>
                    <td><center><a target="_blank" href="/deface_mirror/?id=<? echo $arsiv["id"]; ?>">
                      <img border="0" src="/img/izle.gif" width="15" height="15"></a></center></td>
                  </tr>

<? } 

echo '<tr><td align="center" colspan="5">
<br /><b><font face="Verdana" size="2">Toplam 
<font color="#FF0000">'.$sayi.'</font> Tane Onaylý Deface Kaydý</font></b></td></tr>';

echo '<tr><td colspan="5" align="center"><br />';
sayfala($s,$sayi,$sayfa_sayisi,$limit);

?>

</td></tr></table>

<? include "../alt.php"; 
?>