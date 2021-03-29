<?
include "../ust.php";


$top_al = mysql_query("SELECT * FROM hackerlar WHERE onayli > 0");
$toplam = @mysql_num_rows($top_al);
$top20_al = mysql_query("SELECT * FROM hackerlar WHERE onayli > 0 ORDER BY onayli DESC LIMIT 50");

?>
<style type="text/css">
<!--
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #FF0000; }
.style4 {
	color: #FF0000;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style6 {
	font-size: 9px;
	font-weight: bold;
}
.style8 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FF0000;
	font-size: 9px;
	font-weight: bold;
}
-->
</style>

   <div class="item" style="width: 524; height: 585">
	<center>
	  <span class="style4"><font size="3">Top50 Defacer </font> </span>
	</center><br /><br />

	<div class="descr" style="width: 369; height: 44">

            <table align="center" border="0" cellpadding="0" cellspacing="5" style="border-collapse: collapse" bordercolor="#111111" width="75%">
             <tr>
		<td width="7%"><span class="style3">&nbsp;&nbsp;&nbsp;<span class="style6">S&#305;ra</span></span></td>
                <td width="60%" height="20"><span class="style3">&nbsp;&nbsp;<span class="style6">Defacer</span></span></td>
                <td width="33%" height="20"><span class="style8">Deface Say&#305;s&#305;</span></td>
             </tr>

<?
$i=1;
while ($top20 = @mysql_fetch_array($top20_al)){
?>

	   <tr>
	     <td width="7%">&nbsp;&nbsp;&nbsp;<font color="maroon"><b><? echo $i; ?></b></font></td>	
 	     <td width="60%">&nbsp;&nbsp;&nbsp;<font size="2"><a href="/hacker/?user=<? echo $top20["hacker"]; ?>"><b><? echo $top20["hacker"]; ?></b></a></font></td>
	     <td width="33%"><font size="2" color="blue"><b><? echo $top20["onayli"]; ?></b></font></td>
	   </tr>

<? $i++; } ?>
	     </table>
	</div>
   </div>

<? include "../alt.php"; 
?>