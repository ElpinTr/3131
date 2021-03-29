<?

$url = htmlspecialchars(trim($url));

if ($url == "") header("Location: index.php");
elseif (strlen($url) < 13) header("Location: index.php");

include "../ust.php";
include "../sol.php";

$sorgu = mysql_query("SELECT * FROM kayitlar WHERE url = '$url'");
$kontrol = mysql_num_rows($sorgu);

if ($kontrol > 0){

?>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #FF0000;
}
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FF0000;
	font-size: 10;
}
.style9 {color: #999999}
.style11 {font-size: 10}
-->
</style>


		<div class="content">
			<div class="item" style="width: 524; height: 585">

		          <center>
		            <h5 class="style1"><span class="style9">|</span> Arama Sonu&ccedil;Lar&#305; </h5>
		          </center>
			  <div class="descr">
                  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="78%">
                  <tr>
                    <td width="50%"><span class="style2"><br />
                    &nbsp;<b>Site</b></span></td>
                    <td width="3%"><br /></td>
                    <td width="27%"><span class="style11"><br />
                        <span class="style1">Defacer</span></span></td>
                    <td width="15%"><span class="style11"><br />
                    </span>                      <center class="style11">
                      <span class="style1">Tarih</span>
                    </center></td>
                    <td width="5%"><span class="style11"><br />
                    </span>                      <center class="style11">
                      <span class="style1">Mirror</span>
                    </center></td>
                  </tr>

<?
while ( $defacesite = mysql_fetch_array($sorgu) ){

$tarih = $defacesite["tarih"];
$tarih = date("d/m/Y",$tarih);

if($defacesite["tur"]) $resim = '<img src="/img/yildiz.gif">';
else $resim = "";

?>
                    <tr onmouseover="this.style.backgroundColor='#EDF4FC';" onmouseout="this.style.backgroundColor='';">
                    <td><font size="2"><a class="link2" target="_blank" href="<? echo $defacesite["url"]; ?>"><? echo $defacesite["url"]; ?></a></font></td>
		    <td><? echo $resim; ?></td>
                    <td><font face="Tahoma" size="2">
                    <a href="/hacker/?user=<? echo $defacesite["hacker"]; ?>"><? echo $defacesite["hacker"]; ?></a></font></td>
		    <td align="center"><? echo $tarih; ?></td>
                    <td><center><a target="_blank" href="/deface_mirror/?id=<? echo $defacesite["id"]; ?>">
                      <img border="0" src="/img/izle.gif" width="15" height="15"></a></center></td>
                  </tr>
<? } // while bitimi ?>
                  </table>
              </div>
<p align="center"><font face="Tahoma" size="2">
</font></p>
			</div>
	
		</div>

<?

} else { // böyle bir site yoksa

echo '<script language="javascript">
alert ("Sonuç Bulunamadý Tekrar Arama Yapýnýz");
document.location="index.php";
</script>';

} // else bitimi

include "../alt.php";

?>