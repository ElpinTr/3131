<?

include "cfg/db.php";

$id = $_GET['id'];

$sayfa_al = @mysql_query("SELECT icerik FROM kayitlar WHERE id = '$id' ");
$sayfa = @mysql_result($sayfa_al,0,0);

echo $sayfa;

?>