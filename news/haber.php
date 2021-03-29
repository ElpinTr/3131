<?
include "../ust.php";
include "../sol.php";

$id = $_GET['id'];
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


	<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="70%" align="center"><span class="style1"><center><img src="/img/haberler.gif" /></center> </span><br />
    <br />
    <tr><td colspan="2" align="center">&nbsp;</td>
    </tr>
<?

$haber_al = mysql_query("SELECT * FROM haberler WHERE id = '$id'");
$kontrol = mysql_num_rows($haber_al);

if ($kontrol > 0){

while ($haber = mysql_fetch_array($haber_al)){

$tarih = $haber["tarih"];
$tarih = date("d/m/Y H:i",$tarih);

echo '<tr><td><img src="/img/vurgu.gif" /><b>'.$haber["baslik"].'</b></td></tr>';
echo '<tr><td>'.$haber["icerik"].'<br /><br /><br /><br /></td></tr>';
echo '<tr><td align="right"><img src="/img/yazar.gif" /> '.$haber["yazar"].'&nbsp;&nbsp;<img src="/img/tarih.gif" /> <b><font color=#ff3300>'.$tarih.'</b></font></td></tr>';

} // while bitimi

//echo '<tr><td><br /><a //onclick="window.open(\'yorumlar.php?id='.$id.'\',\'yorumlar\',\'top=20,left=20,width=800,height=420,toolbar=no,scr//ollbars=yes\');" href="#yorumlar">Yorumlar</a>&nbsp; -&nbsp; 
//
//<a //ONCLICK="window.open(\'yorumyap.php?id='.$id.'\',\'yorumekle\',\'top=20,left=20,width=500,height=420,toolbar=no,sc//rollbars=yes\');" href="#yorumekle">Yorum Ekle</a></td></tr>';

echo '<tr><td align="center"><br /><br /><a href=""><font color="#FF0000"><b>Haber Arþivi</b></font></a></td></tr>';
echo '</table>';

} else { // Haber yoksa

echo '<script> document.location="/haber/"; </script>';

}

include "../alt.php";

?>