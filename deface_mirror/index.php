<?
include "../ust.php";

$id = $_GET['id'];

$mirror_al = mysql_query("SELECT * FROM kayitlar WHERE id = '$id'");
$kontrol = mysql_num_rows($mirror_al);

if($kontrol == 0){

echo "<br /><center>Böyle bir kayýt yok!</center><br />";

} else {

$mirror = mysql_fetch_array($mirror_al);

$tarih = $mirror['tarih'];
$tarih = date("d/m/Y H:i ",$tarih);

?>
<style type="text/css">
<!--
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; color: #FF0000; }
-->
</style>

	<div align="center">
                  <center>
                  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="100%">
                    <tr>
                      <td width="17%"><span class="style3">Defacer</span></td>
                      <td width="57%"><span class="style3">HackLenen UrL </span></td>
                      <td width="26%"><span class="style3">HackLenme Tarihi</span></td>
                    </tr>
                    <tr>
                      <td width="17%"><font face="Tahoma" size="2">
<a target="_blank" href="/hacker/?user=<? echo $mirror['hacker']; ?>"><? echo $mirror['hacker']; ?></a></font>&nbsp;</td>
                      <td width="57%"><font face="Tahoma" size="2"><? echo $mirror['url']; ?></font>&nbsp;</td>
                      <td width="26%"><font face="Tahoma" size="2"><? echo $tarih; ?></font>&nbsp;</td>
                    </tr>
                  </table>
                  </center>
                </div>
                <div align="center">
                <table border="1" width="100%" style="border-collapse: collapse">
		<tr>
			<td width="331"><span class="style3">Durum</span></td>
			<td><span class="style3">Statü</span></td>
		</tr>
		<tr>
		  <td width="331"><? if($mirror['onay']) echo "Onaylý"; else echo "Beklemede"; ?></td>
		  <td><? if ($mirror['onay']) { if($mirror['tur']) echo "Special Deface"; else echo "Normal Deface"; } else echo "Beklemede"; ?></td>
		</tr>
		</table>
		</div>
		<p>&nbsp;</p>
                <p align="center">
                <iframe name="mirror" src="/bak.php/?id=<? echo $_GET['id']; ?>" width="790" height="466" style="border-style: solid; border-width: 0">
                Tarayýcýnýz satýr içi çerçeveleri desteklemiyor veya þu anda satýr içi çerçeveleri göstermek için yapýlandýrýlmamýþ.</iframe></p>
        </div>

<? 
} 

include "../alt.php";

?>