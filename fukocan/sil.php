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
<h3>Deface Sil</h3><br /><br />
<?

if (isset($_GET['id']) && $_GET['onay'] == 1){ // işlem sil ise ve onaylı ise

$kayitid = $_GET['id'];

$hacker_al = @mysql_query("SELECT hacker FROM kayitlar WHERE id = '$kayitid'");
$hacker = @mysql_result($hacker_al,0,0);

$hackerid_al = @mysql_query("SELECT id FROM hackerlar WHERE hacker = '$hacker'");
$hackerid = @mysql_result($hackerid_al,0,0);

$kactane =  @mysql_query("SELECT deface FROM hackerlar WHERE id = '$hackerid'");
$defacesayi = @mysql_result($kactane,0,0);

$onay_al =  @mysql_query("SELECT onay FROM kayitlar WHERE id = '$kayitid'");
$onay = @mysql_result($onay_al,0,0);

$sil =  @mysql_query("DELETE FROM kayitlar WHERE id = '$kayitid'");

if ($defacesayi == 1){
$sil2 =  @mysql_query("DELETE FROM hackerlar WHERE id = '$hackerid'");
} else {
if ($onay) $sil2 = @mysql_query("UPDATE hackerlar SET onayli = onayli - 1, deface = deface - 1 WHERE id = '$hackerid'");
else $sil2 =  @mysql_query("UPDATE hackerlar SET onaysiz = onaysiz - 1, deface = deface - 1 WHERE id = '$hackerid'");
}

if ($sil && $sil2){
echo '<h4>Deface başarıyla silindi<br /><br /><a href="deface.php">Geri dönmek için tıklayın</a></h4>';
} else {
echo '<h4>Deface silinirken bir hata oluştu<br /><br /><a href="javascript:history.back(1)">Geri dönmek için tıklayın</a></h4>';
}

} else {  // Silme onayı yoksa

$id = $_GET['id'];

echo '<center>Bu defaceyi silmek istediğinizden emin misiniz?<br /><br />
<a href="sil.php?id='.$id.'&onay=1">Evet</a>&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(1)">Hayır</a></center>';

} // İşlem kontrol

?>