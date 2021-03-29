<?

$kelime = $_POST['kelime'];
$yer = $_POST['yer'];

if ($kelime == "" || $yer == "Seç" || $yer == "") header("Location: index.php");

else { // eðer bilgi varsa

switch($yer){

	case "Sitelerde": // Sitelerde arama

	if (strlen($kelime) < 13) header("Location: index.php");
	header("Location: defacesite.php?url=$kelime");
	break;

	case "Hackerlarda": // Hackerlarda arama

	if (strlen($kelime) < 4) header("Location: index.php");
	header("Location: /hacker/?user=$kelime");
	break;

	case "Haberlerde": header("Location: haberara.php?id=$kelime");
	break;

	default: header("Location: index.php");
	break;
} // switch bitimi

} // else bitimi

?>