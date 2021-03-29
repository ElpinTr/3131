<?
$hacker = htmlspecialchars(trim($_GET['user']));

$s = $_GET['s'];
if ($s == ""){
header ("Location: ?s=1&user=$hacker");
}

include "../ust.php";
include "../sol.php";
include "../cfg/sayfala2.php";

if ($hacker == "" || strlen($hacker) < 4) echo '<script> document.location="/onhold/"; </script>';
$kontrol_yap = mysql_query("SELECT * FROM kayitlar WHERE hacker = '$hacker' AND onay = 0");
$kontrol = @mysql_num_rows($kontrol_yap);

if ($kontrol > 0){ // varsa böyle bir hacker

$limit = $site_ayar['sayfadefacesayisi'];
$ilk = $limit*($s-1);
$sayi = mysql_num_rows($kontrol_yap);
$sayfa_sayisi = ceil($sayi/$limit);

if ($s < 1 || $s > $sayfa_sayisi){
echo '<script> document.location="?s=1&user='.$hacker.'"; </script>';
}

$onhold_al = mysql_query("SELECT * FROM kayitlar WHERE hacker = '$hacker' AND onay = 0 ORDER BY tarih DESC LIMIT $ilk,$limit");

?>
				  <font color="#FF0000"><strong><font face="Verdana, Arial, Helvetica, sans-serif">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="78%" align="center">
<? echo '<tr><td colspan="4" align="center"><font size="3" color="blue">'.$hacker.' Toplam (<font color="red">'.$sayi.'</font>) Tane Onay Bekliyor</font></td></tr>'; ?>                  </font> </strong>				  </font>
				  <tr>
                    <td width="60%"><font color="#FF0000"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><br />
&nbsp;Site</font></strong></font></td>
                    <td><font color="#FF0000"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><br />
                    Defacer</font></strong></font></td>
                    <td><font color="#FF0000"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><br />
                    </font> </strong> </font>                      <center>
                        <font color="#FF0000"><strong><font face="Verdana, Arial, Helvetica, sans-serif">Tarih </font> </strong>                        </font>
                    </center></td>
                    <td><font color="#FF0000"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><br />
                    </font> </strong> </font>                      <center>
                        <font color="#FF0000"><strong><font face="Verdana, Arial, Helvetica, sans-serif">Mirr0r </font> </strong>                        </font>
                    </center></td>
                  </tr>

                  <font color="#FF0000"><strong><font face="Verdana, Arial, Helvetica, sans-serif">
                  <?
while ( $onhold = mysql_fetch_array($onhold_al) ){

$tarih = $onhold["tarih"];
$tarih = date("d/m/Y",$tarih);

if ( strlen($onhold["url"]) > 45 ) $url = substr($onhold["url"], 0, 45)."...";
else $url = $onhold["url"];

?>
                  </font> </strong>                  </font>
                  <tr onmouseover="this.style.backgroundColor='#EDF4FC';" onmouseout="this.style.backgroundColor='';">
                    <td width="42%"><font color="#FF0000"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2">
                    <a class="link2" target="_blank" href="<? echo $onhold["url"].'">'.$url; ?></a></font></td>
                    <td width="25%"><font size="2">
                      <? echo $onhold["hacker"]; ?></font></font></strong></font></td>
		    <td width="13%" align="center"><font color="#FF0000"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><? echo $tarih; ?></font></strong></font></td>
                    <td width="10%"><center>
                      <font color="#FF0000"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><a target="_blank" href="/deface_mirror/?id=<? echo $onhold["id"]; ?>">
                      <img border="0" src="/img/izle.gif" width="15" height="15"></a></font> </strong>                      </font>
                    </center></td>
                  </tr>

                  <font color="#FF0000"><strong><font face="Verdana, Arial, Helvetica, sans-serif">
                  <? } // while bitimi

echo '<tr><td colspan="5" align="center"><br />';
sayfala($s,$sayi,$sayfa_sayisi,$limit,$hacker);
echo '</td></tr></table>';

include "../alt.php";

} else { // hacker yoksa

echo '<script> document.location="/onhold/"; </script>';

} // hacker kontrol



?>
                  </font></strong></font>