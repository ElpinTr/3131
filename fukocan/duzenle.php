<? 
include "../cfg/db.php";
include "guvenlik.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
</head>
<body>
<center>
<h3>Deface Düzenle</h3><br /><br />
<?

if ($_GET['islem'] == "duzenle"){ // İşlem Düzenle ise

$kayitid = $_GET['id'];
$url = $_POST['url'];
$hacker = $_POST['hacker'];
$tur = $_POST['tur'];
$onay = $_POST['onay'];
$mirror = $_POST['mirror'];

if ( empty($kayitid) || empty($url) || empty($hacker) || $tur == "" || $onay == "" ){
echo 'Lütfen boş alan bırakmayın!<br /><br /><a href="javascript:history.back(1)">Geri dönmek için tıklayın</a>';
exit;
}

$kontrol = mysql_query("SELECT onay,hacker FROM kayitlar WHERE id = '$kayitid'");
$suankionay = mysql_result($kontrol,0,0);
$suankihacker = mysql_result($kontrol,0,1);

$hackerid_al = mysql_query("SELECT id FROM hackerlar WHERE hacker = '$suankihacker'");
$hackerid = mysql_result($hackerid_al,0,0);

$duzenle = mysql_query("UPDATE kayitlar SET url = '$url', hacker = '$hacker', onay = '$onay', tur = '$tur', icerik = '$mirror' WHERE id = '$kayitid'");

if ($onay){ // onayladıysa

if($onay != $suankionay) // eskiden onaylı değilse
$duzenle2 = mysql_query("UPDATE hackerlar SET hacker = '$suankihacker', onayli = onayli + 1, onaysiz = onaysiz - 1  WHERE id = '$hackerid'");
else $duzenle2 = 1; // eskiden onaylıysa ellemiyoruz
} else { // onayı aldıysa
if($_POST['onay'] != $suankionay) // eskiden onaylıysa
$duzenle2 = mysql_query("UPDATE hackerlar SET hacker = '$suankihacker', onayli = onayli - 1, onaysiz = onaysiz + 1  WHERE id = '$hackerid'");
else $duzenle2 = 1; // eskiden onaylı değilse ellemiyoruz
} // onay kontrol

$duzenle3 = mysql_query("UPDATE hackerlar SET hacker = '$hacker' WHERE id = '$hackerid'");

if ($duzenle && $duzenle2 && $duzenle3){
echo '<h4>Deface başarıyla düzenlendi<br /><br /><a href="deface.php">Geri dönmek için tıklayın</a></h4>';
} else {
echo '<h4>Deface düzenlenirken bir hata oluştu<br /><br /><a href="javascript:history.back(1)">Geri dönmek için tıklayın</a></h4>';
}

} else {  // İşlem Düzenle değilse
$id = $_GET['id'];

$bilgi_al = mysql_query("SELECT * FROM kayitlar WHERE id = '$id'");
$bilgi = mysql_fetch_array($bilgi_al);

echo '<table align="center">';
echo '<form action="' . $PHP_SELF . '?islem=duzenle&id='.$bilgi["id"].'" method="POST">';
echo '<tr><td>Site:</td><td><input type="text" name="url" size="50" value="'.$bilgi["url"].'"></td></tr>';
echo '<tr><td>Hacker:</td><td><input type="text" size="50" name="hacker" value="'.$bilgi["hacker"].'"></td></tr>';
echo '<tr><td>Tür:</td><td><input type="text" name="tur" size="3" value="'.$bilgi["tur"].'">  (Special ise 1, Normal ise 0 yazın)</td></tr>';
echo '<tr><td>Onay:</td><td><input type="text" name="onay" size="3" value="'.$bilgi["onay"].'">  (Onaylı ise 1, Onaysız ise 0 yazın)</td></tr>';
echo '<tr><td>Mirr0r:</td><td><textarea cols="60" rows="10" name="mirror">'.$bilgi["icerik"].'</textarea></td></tr>';
echo '<tr><td align="center" colspan="2"><input type="submit" value="Düzenle"></td></tr>';
echo '</form></table>';

} // İşlem kontrol

?>