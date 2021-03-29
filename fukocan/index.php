<?
include "guvenlik.php";

if(!$_GET['pane'] == ""){
if($_GET['pane'] == "sol"){

include "menu.php";
exit;

} elseif ($_GET['pane'] == "sag"){

include "sag.php";
exit;

}

} else {
?>
<html dir="">
<head>
<title>Harbimeydan Yönetim PaneLi</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
</head>

<frameset cols="170,*" rows="*" border="2" framespacing="0" frameborder="yes">
  <frame src="index.php?pane=sol" name="nav" marginwidth="3" marginheight="3" scrolling="auto">
  <frame src="index.php?pane=sag" name="main" marginwidth="10" marginheight="10" scrolling="auto">
</frameset>

<noframes>
	<body bgcolor="#FFFFFF" text="#000000">
		<p>Üzgünüm, tarayıcınız çerçeveleri desteklemiyor</p>
	</body>
</noframes>
</html>
<? } 

?>