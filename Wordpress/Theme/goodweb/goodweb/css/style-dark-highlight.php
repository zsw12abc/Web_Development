<?php
header("Content-Type: text/css; charset=utf-8");
	
	/* COLORS */
	if (!isset($_GET["highlight"]) || empty($_GET["highlight"])) {

		$highlightcolor = "#ff6760";
	} else {

		$highlightcolor = "#".$_GET["highlight"];
	}
?>

a,a:visited					{	color:<?php echo $highlightcolor;?>; !important;}
code						{	background-color:<?php echo $highlightcolor;?> !important;}
#bo-loadmorebutton:hover	{	background:<?php echo $highlightcolor;?> !important;}
.skill-overlay				{	background: <?php echo $highlightcolor;?> !important; }