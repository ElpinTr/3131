<?
include "guvenlik.php";
include "../cfg/db.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<style type="text/css">
<!--
.style1 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FF0000;
	font-weight: bold;
}
.style2 {color: #999999}
-->
</style>
</head>
<body>
<center>
  <h3><span class="style1">FuKo-H <span class="style2">|</span> Anasayfa </span><br />
    <br />
    <?

$onayli = @mysql_query("SELECT * FROM kayitlar WHERE onay = 1");
$onayli = @mysql_num_rows($onayli);

$onaysiz = @mysql_query("SELECT * FROM kayitlar WHERE onay = 0");
$onaysiz = @mysql_num_rows($onaysiz);

$toplam = $onayli + $onaysiz;

echo 'Sitede <font color="red"><b>'.$onayli.'</b></font> tane onaylı, <font color="red"><b>'.$onaysiz.'</b></font> tane onaysız, toplam <font color="red"><b>'.$toplam.'</b></font> deface bulunmaktadır.';

?>
</h3>
</center>
