<? ob_start(); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
</head>
<body>
<?

$kadi = "fukocan";
$sifre = "4992010";

if ($_GET['islem'] == "girisyap"){

if ($_POST['kadi'] == $kadi AND $_POST['sifre'] == $sifre){

session_start();
$_SESSION["imhatimi_admin_sessionu"] = $_POST['kadi'];
$_SESSION["imhatimi_pass_sessionu"] = $_POST['sifre'];

echo '<center>';
echo '<meta http-equiv="refresh" content="3; url=index.php">';
echo '<br /><br /><h4>Başarıyla giriş yaptınız</h4>Yönlendiriliyorsunuz...';

} else {

echo '<center>';
echo '<br /><br />Yanlış bilgi girdiniz<br /><br /><a href="' . $PHP_SELF . '">Tekrar denemek için tıklayın</a>';

}

} else {

echo '<center>';
echo '<br /><br /><h2>ADMIN LOGIN</h2>';
echo '<table align="center">';
echo '<form action="' . $PHP_SELF . '?islem=girisyap" method="POST">';
echo '<tr><td>Kullanıcı Adı:</td><td><input type="text" name="kadi"></td></tr>';
echo '<tr><td>Şifre:</td><td><input type="password" name="sifre"></td></tr>';
echo '<tr><td colspan="2" align="center"><input type="submit" value="Giriş Yap"></td></tr>';
echo '</form></table>';

}

?>
</center>
</body>
</html>
<? ob_end_flush(); ?>