<?
$s = $_GET['s'];
if ($s == ""){
header ("Location: ?s=1");
}

include "../cfg/db.php";

$limit = $site_ayar['sayfadefacesayisi'];
$ilk = $limit*($s-1);
$toplam_al = mysql_query("SELECT * FROM kayitlar WHERE onay = 0");
$sayi = mysql_num_rows($toplam_al);
$onhold_al = mysql_query("SELECT * FROM kayitlar WHERE onay = 0 ORDER BY tarih DESC LIMIT $ilk,$limit");
$sayfa_sayisi = ceil($sayi/$limit);

include "../cfg/sayfala.php";
include "../ust.php";


if ($sayi > 0){

if ($s < 1 || $s > $sayfa_sayisi){
echo '<script> document.location="?s=1"; </script>';
}

?>
				  <font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif"><strong>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="78%" align="center">
<? echo '<tr><td colspan="4" align="center"><font size="3" color="blue">OnHold (Onay Bekleyen Defaceler)  Toplam (<font color="red">'.$sayi.'</font>) Tane</font></td></tr>'; ?>                  </strong> </font>
				  <tr>
                    <td width="57%"><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif"><strong><br />
&nbsp;Site</strong></font></td>
                    <td><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif"><strong><br />
                    Defacer</strong></font></td>
                    <td><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif"><strong><br />
                    </strong> </font>                      <center>
                        <font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif"><strong>Tarih</strong> </font>
                    </center></td>
                    <td><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif"><strong><br />
                    </strong> </font>                      <center>
                        <font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif"><strong>Mirror</strong> </font>
                    </center></td>
                  </tr>

                  <font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif"><strong>
                  <?
while ($onhold = mysql_fetch_array($onhold_al)){

$tarih = $onhold["tarih"];
$tarih = date("d/m/Y",$tarih);

if ( strlen($onhold["url"]) > 45 ) $url = substr($onhold["url"], 0, 45)."...";
else $url = $onhold["url"];

?>
                  </strong> </font>
                  <tr onmouseover="this.style.backgroundColor='#EDF4FC';" onmouseout="this.style.backgroundColor='';">
                    <td><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif"><strong>&nbsp;<font size="2"><a class="link2" target="_blank" href="<? echo $onhold["url"]; ?>"><? echo $url; ?></a></font></strong></font></td>
                    <td><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif"><strong><font size="2">
                    <a href="/useronhold/?user=<? echo $onhold["hacker"]; ?>"><? echo $onhold["hacker"]; ?></a></font></strong></font></td>
		    <td align="center"><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif"><strong><? echo $tarih; ?></strong></font></td>
                    <td><center>
                      <font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif"><strong><a target="_blank" href="/deface_mirror/?id=<? echo $onhold["id"]; ?>">
                      <img border="0" src="/img/izle.gif" width="15" height="15"></a></strong> </font>
                    </center></td>
                  </tr>

                  <font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif"><strong>
                  <? } // while bitimi

echo '<tr><td colspan="5" align="center"><br />';
sayfala($s,$sayi,$sayfa_sayisi,$limit);

echo '</td></tr></table>';

} else {

echo "<br /><br /><center><big><b>Þu an onaysýz deface yok!</b></big></center>";

}

include "../alt.php";



?>
                  </strong></font>