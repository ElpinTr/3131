<?
ob_start();
include "guvenlik.php"; 
include "baglan.php";
include "../cfg/sayfala3.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
</head>
<body>
<center><h3>DEFACE YÖNETİMİ</h3>
<?

if ($_GET['sayfa'] == "onayla"){ // onaylama sayfası

foreach ($HTTP_POST_VARS as $ad=>$veri){
} // foreach bitim

$say1 = count($_POST['sec_normal']);
$say2 = count($_POST['sec_special']);
$say3 = count($_POST['sec_onaysiz']);

if ($say1 == 0 && $say2 == 0 && $say3 > 0){ // onaylanmışların onayını al

for ($i=0;$i<$say3;$i++){ // onayları al
$id = $_POST['sec_onaysiz']["$i"];
$hackeral = @mysql_query("SELECT hacker FROM kayitlar WHERE id = '$id'");
$hacker = @mysql_result($hackeral,0,0);
$kontrol = @mysql_query("SELECT onay FROM kayitlar WHERE id = '$id'");

$onay = @mysql_result($kontrol,0,0);

if ($onay){

$sql1 = @mysql_query("UPDATE kayitlar SET onay = 0, tur = 0 WHERE id = '$id'");
$sql2 = @mysql_query("UPDATE hackerlar SET onayli = onayli - 1, onaysiz = onaysiz + 1 WHERE hacker = '$hacker'");

} // onay kontrol

} // for bitimi

echo 'Defacelerin onayı başarıyla alındı!<br /><br /><a href="'.$PHP_SELF.'?sayfa=onayli">Onaylanmışların sayfasına dönmek için tıklayın</a>';

} elseif ($say3 == 0 && ($say1 != 0 || $say2 != 0) ){ // onaylanmamışlarınkini onayla

for ($i=0;$i<$say1;$i++){
for ($j=0;$j<$say2;$j++){

if ($_POST['sec_normal["$i"]'] == $_POST['sec_special["$j"]']){
echo 'Aynı kayıtta iki seçeneği de işaretleyemezsiniz!<br />
Unutmayın ilk seçenek <b>Normal</b>, ikincisi <b>Special</b> deface yapar.<br /><br />
<a href="javascript:history.back(1)">Geri dönmek için tıklayın</a>';
exit;
} // if bitimi

} // ilk for bitimi
} // ikinci for bitimi

for ($i=0;$i<$say1;$i++){ // normalleri onayla
$id = $_POST['sec_normal']["$i"];
$hackeral = @mysql_query("SELECT hacker FROM kayitlar WHERE id = '$id'");
$hacker = @mysql_result($hackeral,0,0);

$kontrol = @mysql_query("SELECT onay FROM kayitlar WHERE id = '$id'");
$onay = @mysql_result($kontrol,0,0);

if (!$onay){

$sql1 = @mysql_query("UPDATE kayitlar SET onay = 1, tur = 0 WHERE id = '$id'");
$sql2 = @mysql_query("UPDATE hackerlar SET onayli = onayli + 1, onaysiz = onaysiz - 1 WHERE hacker = '$hacker'");

} // onay kontrol

} // for bitimi

for ($i=0;$i<$say2;$i++){ // specialleri onayla
$id = $_POST['sec_special']["$i"];
$hackeral = @mysql_query("SELECT hacker FROM kayitlar WHERE id = '$id'");
$hacker = @mysql_result($hackeral,0,0);

$kontrol = @mysql_query("SELECT onay FROM kayitlar WHERE id = '$id'");
$onay = @mysql_result($kontrol,0,0);

if (!$onay){

$sql1 = @mysql_query("UPDATE kayitlar SET onay = 1, tur = 1 WHERE id = '$id'");
$sql2 = @mysql_query("UPDATE hackerlar SET onayli = onayli + 1, onaysiz = onaysiz - 1 WHERE hacker = '$hacker'");

} // onay kontrol

} // for bitimi

echo 'Defaceler başarıyla onaylandı!<br /><br /><a href="'.$PHP_SELF.'?sayfa=onaysiz">Onaylanmamışların sayfasına dönmek için tıklayın</a>';

} else { // hiç bir sayfa değilse

echo 'Hiç kayıt seçmediniz!<br /><br /><a href="'.$PHP_SELF.'">Defaceler sayfasına dönmek için tıklayın</a>';

}  // hangi sayfadan geldiğini kontrol et


} elseif ($_GET['sayfa'] == "onayli"){ // onaylanmışların sayfası

$s = $_GET['s'];
if ($s == ""){
header ("Location: ?s=1&sayfa=onayli");
}

$limit = 20;
$ilk = $limit*($s-1);
$toplam_al = @mysql_query("SELECT * FROM kayitlar WHERE onay = 1");
$sayi = @mysql_num_rows($toplam_al);
$sayfa_sayisi = ceil($sayi/$limit);

$deface_al = @mysql_query("SELECT * FROM kayitlar WHERE onay = 1 ORDER BY tarih ASC LIMIT $ilk,$limit");
$kontrol = @mysql_num_rows($deface_al);

if ($kontrol > 0){

if ($s < 1 || $s > $sayfa_sayisi){
header ("Location: ?s=1&sayfa=onayli");
}

echo '<big>Onaylanmış Defaceler</big><br /><br />';
echo '<table align="center" width="100%"><form action="'.$PHP_SELF.'?sayfa=onayla" method="POST"><tr>';
echo '<td width="10%"><b>Onay Al</b></td>';
echo '<td width="5%"><b>No</b></td>';
echo '<td width="27%"><b>Deface Site</b></td>';
echo '<td width="20%"><b>Hacker</b></td>';
echo '<td width="5%"><b>Mirr0r</b></td>';
echo '<td width="10%"><b>Tür</b></td>';
echo '<td width="10%"><b>Tarih</b></td>';
echo '<td width="8%"></td>';
echo '<td width="5%"></td>';
echo '</tr>';

$i=1;
while ( $deface = @mysql_fetch_array($deface_al) ){ // while

if ($deface["tur"]) $tur = "Special";
else $tur = "Normal";

$tarih = $deface["tarih"];
$tarih = date("d/m/Y",$tarih);

if ( strlen($deface["url"]) > 40 ) $url = substr($deface["url"], 0, 40)."...";
else $url = $deface["url"];

echo '<tr><td><input type="checkbox" name="sec_onaysiz[]" value="'.$deface["id"].'"></td>';
echo '<td>'.$i.'</td>';
echo '<td>'.$url.'</td>';
echo '<td>'.$deface["hacker"].'</td>';
echo '<td><a target="_blank" href="/defacements/?id='.$deface["id"].'"><img border="0" src="/img/izle.gif" /></a></td>';
echo '<td>'.$tur.'</td>';
echo '<td>'.$tarih.'</td>';
echo '<td><a href="duzenle.php?id='.$deface["id"].'">Düzenle</a></td>';
echo '<td><a href="sil.php?id='.$deface["id"].'">Sil</a></td></tr>';

$i++;
} // while bitim

echo '<tr><td colspan="3"><input type="submit" value="Onay Al"></td></tr>';
echo '<tr><td colspan="9" align="center"><br />';
sayfala($s,$sayi,$sayfa_sayisi,$limit,"onayli");

echo '</td></tr></form></table>';

} else { // Eğer yoksa

echo '<b>Hiç Onaylı Deface Yok!</b>';

} // Var yok kontrol

echo '<br /><br /><a href="'.$PHP_SELF.'">Deface Yönetimi Ana sayfası için tıklayın</a>';

} elseif ($_GET['sayfa'] == "onaysiz") { // Onaylanmamışların sayfası

$s = $_GET['s'];
if ($s == ""){
header ("Location: ?s=1&sayfa=onaysiz");
}

$limit = 500;
$ilk = $limit*($s-1);
$toplam_al = @mysql_query("SELECT * FROM kayitlar WHERE onay = 0");
$sayi = @mysql_num_rows($toplam_al);
$sayfa_sayisi = ceil($sayi/$limit);

$deface_al = @mysql_query("SELECT * FROM kayitlar WHERE onay = 0 ORDER BY tarih ASC LIMIT $ilk,$limit");
$kontrol = @mysql_num_rows($deface_al);

if ($kontrol > 0){

if ($s < 1 || $s > $sayfa_sayisi){
header ("Location: ?s=1&sayfa=onaysiz");
}

echo '<big>Onaylanmamış Defaceler</big><br /><br />';
echo '<table align="center" width="100%"><form action="'.$PHP_SELF.'?sayfa=onayla" method="POST"><tr>';
echo '<td width="10%"><b>Onayla</b></td>';
echo '<td width="5%"><b>No</b></td>';
echo '<td width="27%"><b>Deface Site</b></td>';
echo '<td width="20%"><b>Hacker</b></td>';
echo '<td width="5%"><b>Mirr0r</b></td>';
echo '<td width="10%"><b>Tür</b></td>';
echo '<td width="10%"><b>Tarih</b></td>';
echo '<td width="8%"></td>';
echo '<td width="5%"></td>';
echo '</tr>';

$i=1;
while ( $deface = mysql_fetch_array($deface_al) ){ // while

if ($deface["tur"]) $tur = "Special";
else $tur = "Normal";

$tarih = $deface["tarih"];
$tarih = date("d/m/Y",$tarih);

if ( strlen($deface["url"]) > 40 ) $url = substr($deface["url"], 0, 40)."...";
else $url = $deface["url"];

echo '<tr><td><input type="checkbox" checked name="sec_normal[]" value="'.$deface["id"].'">&nbsp;&nbsp;<input type="checkbox" name="sec_special[]" value="'.$deface["id"].'"></td>';
echo '<td>'.$i.'</td>';
echo '<td>'.$url.'</td>';
echo '<td>'.$deface["hacker"].'</td>';
echo '<td><a target="_blank" href="/defacements/?id='.$deface["id"].'"><img border="0" src="/img/izle.gif" /></a></td>';
echo '<td>'.$tur.'</td>';
echo '<td>'.$tarih.'</td>';
echo '<td><a href="duzenle.php?id='.$deface["id"].'">Düzenle</a></td>';
echo '<td><a href="sil.php?id='.$deface["id"].'">Sil</a></td></tr>';

$i++;
} // while bitim

echo '<tr><td colspan="3"><input type="submit" value="Onayla"></td></tr>';
echo '<tr><td colspan="9" align="center"><br />';
sayfala($s,$sayi,$sayfa_sayisi,$limit,"onaysiz");

echo '</td></tr></table>';

echo '</table>';

} else { // Eğer yoksa

echo '<b>Hiç Onaysız Deface Yok!</b>';

} // Var yok kontrol

echo '<br /><br /><a href="'.$PHP_SELF.'">Deface Yönetimi Ana sayfası için tıklayın</a>';

} else { // hiçbiri

echo '<a href="'.$PHP_SELF.'?sayfa=onayli">Onaylı Defaceler için tıklayın</a><br /><br />';
echo '<a href="'.$PHP_SELF.'?sayfa=onaysiz">Onaysız Defaceler için tıklayın</a><br />';

} // sayfa kontrol

?>
</center>
<? ob_end_flush(); ?>